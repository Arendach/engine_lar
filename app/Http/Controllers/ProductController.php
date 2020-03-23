<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\UniversalAssetsRequest;
use App\Http\Requests\Products\UpdateInfoRequest;
use App\Http\Requests\Products\UpdateStorageRequest;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\ProductAsset;
use App\Models\ProductImage;
use App\Models\ProductStorage;
use App\Models\Storage;
use App\Models\StorageId;
use App\Services\CategoryTree;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $access = 'products';

    public function sectionMain(CategoryTree $categoryTree, bool $archive = false)
    {
        $products = Product::with([
            'category',
            'manufacturer',
            'storage_list'
        ]);

        if ($archive) {
            $products = $products->onlyTrashed()->paginate(25);
        } else {
            $products = $products->paginate(25);
        }

        $productsSum = $products->sum(function (Product $item) {
            return $item->procurement_costs * $item->storage_list->sum('count');
        });

        $data = [
            'products'      => $products,
            'storage'       => Storage::all(),
            'manufacturers' => Manufacturer::all(),
            'categories'    => $categoryTree->option(),
            'productsSum'   => $productsSum
        ];

        return view('product.main', $data);
    }

    public function sectionCreate()
    {
        $data = [
            'title'         => 'Товари :: Новий товар',
            'scripts'       => ['text_change.js', 'products/product.js', 'products/add.js', 'ckeditor/ckeditor.js'],
            'manufacturers' => Manufacturers::getAll(),
            'categories'    => Categories::get(),
            'breadcrumbs'   => [
                ['Товари', uri('product')],
                ['Новий товар']
            ],
            'ids'           => Storage::getIds()
        ];

        $this->view->display('product.create', $data);
    }

    public function sectionUpdate(int $id, CategoryTree $categoryTree)
    {
        $product = Product::with([
            'storage_list',
            'images'
        ])
            ->findOrFail($id);

        $data = [
            'product'       => $product,
            'manufacturers' => Manufacturer::all(),
            'categories'    => $categoryTree->option(),
            'storage'       => Storage::accounted()->get(),
            'ids'           => StorageId::tree()
        ];

        return view('product.update.main', $data);
    }

    public function action_update_accounted($post)
    {
        Products::update($post, $post->id);

        response(200, DATA_SUCCESS_UPDATED);
    }

    public function actionUpdateStorage(UpdateStorageRequest $request)
    {
        ProductStorage::all();
        foreach ($request->storage as $storage) {

        }
    }

    public function action_update_combine($post)
    {
        if (my_count($post->ids) < 2) response(400, 'Виберіть хоча б два товари!');

        // Видаляємо всі компоненти
        R::exec('DELETE FROM `combine_product` WHERE `product_id` = ?', [$post->id]);

        // перебираємо всі товари з форми
        foreach ($post->ids as $i => $id) {

            // якщо немає кількості або ціни то пропускаємо
            if (!isset($post->amounts->{$i})) break;
            if (!isset($post->prices->{$i})) break;

            // Добавляємо компонент до товару
            Products::update_combine_product($post->id, [
                'amount' => $post->amounts->{$i}, 'price' => $post->prices->{$i}, 'id' => $id
            ]);
        }

        // обновляємо ціну товару
        Products::update(['costs' => $post->costs], $post->id);

        response(200, DATA_SUCCESS_UPDATED);
    }

    public function actionUpdateInfo(UpdateInfoRequest $request)
    {
        $data = $request->except('level1', 'level2');
        $data['identefire_storage'] = $request->get('level1') . '-' . $request->get('level2');
        $data['volume'] = json_encode($request->get('volume'));

        Product::findOrFail($request->get('id'))->update($data);

        return response(null, 200);
    }

    public function actionUpdateSeo(Request $request)
    {
        Product::findOrFail($request->id)->update($request->all());
    }

    public function section_to_archive()
    {
        R::exec('UPDATE `products` SET `archive` = 1 WHERE `id` = ?', [get('id')]);
        redirect(uri('product', ['section' => 'update', 'id' => get('id')]));
    }

    public function section_un_archive()
    {
        R::exec('UPDATE `products` SET `archive` = 0 WHERE `id` = ?', [get('id')]);
        redirect(uri('product', ['section' => 'update', 'id' => get('id')]));
    }

    public function action_search_products_to_combine($post)
    {
        if (!isset($post->not)) $post->not = [];
        $this->view->display('product.part.combine_search', [
            'products' => Products::search_products_to_combine($post->value, $post->not)
        ]);
    }

    public function action_search_attribute($post)
    {
        $result = '';

        foreach (Products::search_attributes($post->value) as $item) {
            $link = '<span data-id="%1" class="list-group-item pointer get_searched_attribute">%2</span>';
            $link = str_replace('%1', $item->id, $link);
            $link = str_replace('%2', $item->name, $link);
            $result .= $link;
        }

        echo $result;
    }

    public function action_get_searched_attribute($post)
    {
        $this->view->display('product.part.searched_attribute', [
            'attribute' => Attributes::getOne($post->id)
        ]);
    }

    public function action_update_attribute($post)
    {
        Products::update_attribute($post);

        response(200, DATA_SUCCESS_UPDATED);
    }


    // Images
    public function actionUploadImages(Request $request)
    {
        $product = Product::findOrFail($request->id);

        foreach ($request->file('images') as $image) {
            $name = $image->getClientOriginalName();
            $path = "images/products/{$product->id}/";

            $image->move(public_path($path), $name);

            ProductImage::create([
                'path'       => $path . $name,
                'alt'        => $request->alt,
                'product_id' => $request->id
            ]);
        }
    }

    public function actionChangeMainImage(int $product_id, int $image_id)
    {
        ProductImage::where('product_id', $product_id)->update(['is_main' => 0]);
        ProductImage::findOrFail($image_id)->update(['is_main' => 1]);
    }

    public function actionDeleteImage(int $id)
    {
        ProductImage::findOrFail($id)->delete();
    }

    public function actionUpdateImageForm(int $id)
    {
        return view('product.update.forms.image', [
            'image' => ProductImage::findOrFail($id)
        ]);
    }

    public function actionUpdateImage(Request $request)
    {
        ProductImage::findOrFail($request->id)->update($request->all());
    }


    public function actionCreate($post)
    {
        $post->identefire_storage = $post->level1 . '-' . $post->level2;
        unset($post->level1, $post->level2);

        if (empty($post->name)) response(400, 'Заповніть назву!');
        if (empty($post->articul)) response(400, 'Заповніть артикул!');
        if (empty($post->model)) response(400, 'Заповніть модель!');
        if (empty($post->procurement_costs)) response(400, 'Заповніть закупівельну вартість!');
        if (empty($post->costs)) response(400, 'Заповніть ціну!');

        $id = Products::save($post);

        response(200, [
            'action'  => 'redirect',
            'uri'     => uri('product', ['section' => 'update', 'id' => $id]),
            'message' => 'Товар вдало створено'
        ]);
    }

    public function action_copy($post)
    {
        $amount = preg_match('/^[1-9]$/', $post->amount) ? $post->amount : 1;

        Products::copy($post->id, $amount);

        response(200, "Товар вдало скопійовано $amount раз(ів)");
    }

    public function action_get_service_code($post)
    {
        if (!isset($post->id) || empty($post->id)) response(200, '0');

        $result = Products::get_service_code($post->id);

        if ($result === false) response(400, 'Неправильні вхідні параметри!');
        elseif (is_numeric($result)) response(200, (string)$result);
        else response(500, 'Невідома помилка!');
    }

    public function section_print()
    {
        $this->view->display('product.print', ['items' => Products::getAll(0)]);
    }

    public function section_history()
    {
        if (!get('id')) $this->display_404();

        $data = [
            'title'       => 'Товари :: Історія товару',
            'items'       => Products::getHistory(get('id')),
            'breadcrumbs' => [
                ['Товари', uri('product')],
                ['Історія товару']
            ]
        ];

        $this->view->display('product.history', $data);
    }

    public function action_get_product_to_combine($post)
    {
        $data = [
            'combine_products' => Products::findAll('products', '`id` = ?', [$post->id]),
            'type'             => 'add'
        ];

        $this->view->display('product.part.combine_products', $data);
    }

    public function sectionAssets()
    {
        $assets = ProductAsset::whereIsArchive(request()->has('archive'))
            ->latest()
            ->paginate(config('app.items'));

        return view('product.assets.main', compact('assets'));
    }

    public function actionCreateAssetsForm()
    {
        $storage = Storage::where('is_accounted', 0)->get();

        return view('product.assets.form_create', compact('storage'));
    }

    public function actionUpdateAssetsForm(int $id)
    {
        $storage = Storage::where('is_accounted', 0)->get();
        $assets = ProductAsset::findOrFail($id);

        return view('product.assets.form_update', compact('storage', 'assets'));
    }

    public function actionCreateAssets(UniversalAssetsRequest $request)
    {
        ProductAsset::create($request->all());
    }

    public function actionUpdateAssets(UniversalAssetsRequest $request)
    {
        ProductAsset::findOrFail($request->id)->update($request->all());
    }

    public function actionAssetsToArchive(int $id)
    {
        ProductAsset::findOrFail($id)->update(['is_archive' => 1]);
    }

    public function actionAssetsUnArchive(int $id)
    {
        ProductAsset::findOrFail($id)->update(['is_archive' => 0]);
    }

    public function section_moving()
    {
        $data = [
            'title'       => 'Товари :: Переміщення',
            'breadcrumbs' => [
                ['Товари', uri('product')],
                ['Переміщення']
            ],
            'components'  => ['modal'],
            'moving'      => Products::getAllMoving()
        ];

        $this->view->display('product.moving.main', $data);
    }

    public function section_print_moving()
    {
        if (!get('id')) $this->display_404();

        $data = [
            'moving'   => Products::getMoving(get('id')),
            'products' => Products::getProductsByMoving(get('id'))
        ];

        $this->view->display('product.moving.print', $data);
    }

    public function action_create_moving_form()
    {
        $data = [
            'title'   => 'Нове переміщення',
            'storage' => Storage::findAll('storage', 'accounted = 1'),
            'users'   => User::findAll('user', 'archive = 0')
        ];

        $this->view->display('product.moving.create_form', $data);
    }

    public function action_search_products_to_moving($post)
    {
        $result = Products::searchProductsToMoving($post->storage, $post->name);

        $str = '';
        foreach ($result as $item) {
            $str .= "<li data-storage='$post->storage' data-id='$item->id' class=\"list-group-item product_item_s\"><span class=\"badge\">{$item->count}</span>{$item->name}</li>";
        }

        echo $str;
    }

    public function action_get_product($post)
    {
        $product = Products::getProductByMoving($post->id, $post->storage);

        echo '<div>' . $product->name . '<button type="button" class="btn btn-danger btn-xs" onclick="delete_item(this)"><i class="fa fa-remove"></i></button><input name="product_' . $product->id . '" data-max="' . $product->count . '" value="0" data-id="' . $product->id . '" class="form-control"></div>';
    }

    public function action_create_moving($post)
    {
        if ($post->storage_from == $post->storage_to)
            response(400, 'Виберіть інший склад!');

        $products = [];
        foreach ($post as $key => $count) {
            if (preg_match('/product_[0-9]+/', $key)) {
                unset($post->{$key});
                $key = preg_replace('/product_([0-9]+)/', '$1', $key);
                $products[$key] = $count;
            }
        }

        if (count($products) == 0) response(400, 'Виберіть хоча-б один товар!');

        Products::createMoving($post, $products);

        response(200, DATA_SUCCESS_CREATED);
    }

    public function action_close_moving($post)
    {
        Products::close_moving($post);

        response(200, 'Переміщення прийняте!');
    }

    public function action_pts_more($post)
    {
        $pts = Products::findAll('product_to_storage', 'product_id = ?', [$post->id]);

        $result = '';
        foreach ($pts as $item) {
            $storage = Storage::getOne($item->storage_id);

            $result .= '<span style="color: green">%1</span>: %2 <br>';
            $result = str_replace('%1', $storage->name, $result);
            $result = str_replace('%2', $item->count, $result);
        }

        echo $result;
    }

    public function section_print_tick()
    {
        if (!get('ids')) $this->display_404();

        $data = [
            'title'    => 'Бірки товарів',
            'products' => Products::findAll('products', '`id` IN(' . get('ids') . ')')
        ];

        $this->view->display('product.print_tick', $data);
    }

    public function section_print_stickers()
    {
        if (!get('ids')) $this->display_404();

        $products = Products::findAll('products', '`id` IN(' . get('ids') . ')');

        $i = 0;
        $temp = [0 => []];
        foreach ($products as $product) {
            $images = ImageUpload::get_product_photos($product->id);
            $product->image = is_array($images) && count($images) ? $images[0] : '/public/images/nophoto.png';

            if (count($temp[$i]) == 2) $i++;

            $temp[$i][] = $product;
        }

        $data = [
            'title'    => 'Наклейки товарів',
            'products' => $temp
        ];

        $this->view->display('product.print_stickers', $data);
    }

    public function action_search_characteristics($post)
    {
        $not = isset($post->not) ? "`id` NOT IN (" . implode(',', get_array($post->not)) . ") AND " : '';
        $characteristics = Products::findAll('characteristics', "$not `name_uk` LIKE ?", ["%{$post->name}%",]);
        $this->view->display('product.update.characteristics.search', ['characteristics' => $characteristics]);
    }

    public function action_get_searched_characteristic($post)
    {
        $characteristic = Products::getOne($post->id, 'characteristics');

        $this->view->display('product.update.characteristics.result', ['characteristic' => $characteristic]);
    }

    public function action_update_characteristics($post)
    {
        R::exec('DELETE FROM product_characteristics WHERE product_id = ?', [$post->id]);
        foreach ($post as $id => $item) {
            if (is_object($item))
                Products::insert([
                    'characteristic_id' => $id,
                    'product_id'        => $post->id,
                    'value_uk'          => $item->value_uk,
                    'value_ru'          => $item->value_ru,
                ], 'product_characteristics');
        }

        response(200, DATA_SUCCESS_UPDATED);
    }

    public function api_search($post)
    {
        echo \GuzzleHttp\json_encode(Products::findAll('products', '(name LIKE ? OR articul LIKE ?) AND archive = 0 LIMIT 20', [
            "%{$post->search_string}%",
            "%{$post->search_string}%"
        ]));
    }

    public function api_export($request)
    {
        $ids = implode(',', (array)$request->ids);
        $products = R::findAll('products', "`id` IN($ids) AND `archive` = 0");

        $temp = [];

        foreach ($products as $product) {

            /**
             * Характеристики
             */
            $characteristics = Products::getCharacteristics($product->id);

            $characteristics_temp = [];
            foreach ($characteristics as $characteristic) {
                $characteristics_temp[] = [
                    'characteristic_id' => $characteristic->characteristic_id,
                    'value_uk'          => $characteristic->value_uk,
                    'value_ru'          => $characteristic->value_ru
                ];
            }

            /**
             * Атрибути
             */
            $attributes = Products::findAll('product_attributes', 'product_id = ?', [$product->id]);
            foreach ($attributes as $i => $attribute) {
                $variants = Products::findAll('product_attribute_variants', 'product_attribute_id = ?', [$attribute->id]);

                $v = [];
                foreach ($variants as $i2 => $variant) {
                    $v[$i2]['value_uk'] = $variant->value;
                    $v[$i2]['value_ru'] = $variant->value_ru;
                }

                $attributes[$i]->variants = $v;
            }

            /**
             * Фото товару
             */
            $images = ImageUpload::get_product_photos($product->id);

            if ($images == false)
                $images = [];

            /**
             * Всі дані товару
             */
            $temp[$product['id']] = [
                'article'             => $product->articul,
                'price'               => $product->costs,
                'on_storage'          => $product->count_on_storage > 0 ? 1 : 0,
                'name_uk'             => $product->name,
                'description_uk'      => $product->description,
                'name_ru'             => $product->name_ru,
                'description_ru'      => $product->description_ru,
                'product_key'         => $product->product_key,
                'meta_title_uk'       => $product->meta_title_uk,
                'meta_title_ru'       => $product->meta_title_ru,
                'meta_keywords_uk'    => $product->meta_keywords_uk,
                'meta_keywords_ru'    => $product->meta_keywords_ru,
                'meta_description_ru' => $product->meta_description_ru,
                'meta_description_uk' => $product->meta_description_uk,
                'manufacturer_id'     => $product->manufacturer,
                'characteristics'     => (array)$characteristics_temp,
                'attributes'          => $attributes,
                'images'              => $images
            ];
        }

        echo json($temp);
    }

    public function api_on_storage()
    {
        $products = Products::api_on_storage();

        $result = [];
        foreach ($products as $product) $result[$product['product_key']] = $product['count'];

        response(200, $result);
    }


    public function section_keys()
    {
        $count = R::count('products');

        for ($i = 0; $i <= $count; $i += 100) {
            $products = R::findAll('products', "LIMIT $i, 100");

            foreach ($products as $product) {
                $product->product_key = md5($product->id . date('Y-m-d H:i:s'));

                R::store($product);
            }

            echo number_format($i / $count * 100, 2) . '% <br>';
        }

        echo '100% <br>';
        echo 'good';
    }
}