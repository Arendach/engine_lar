<?php

namespace Web\Model;

use Web\App\NewPaginate;
use Web\App\Model;
use RedBeanPHP\R;

class Purchases extends Model
{
    const table = 'purchases';

    // закупки для списку
    public static function getAllPurchases()
    {
        $str = '';

        // відкриті/закриті/всі
        if (get('view') == 'close') $str .= "purchases.status = 2 AND purchases.type = 1";
        elseif (get('view') == 'all') $str .= "purchases.status IN(0,1,2) AND purchases.type IN(0,1)";
        else $str .= "((purchases.status IN(0,1,2) AND purchases.type = 0) OR (purchases.status IN(0,1) AND purchases.type = 1))";

        // виробник, статус оплати, тип предзамовлення, склад
        $arr = ['manufacturer', 'status', 'type', 'storage_id'];
        foreach ($arr as $key) if (isset($_GET[$key])) $str .= " AND purchases.$key = '$_GET[$key]'";

        // дата від, дата до
        if (get('date_with')) $str .= "  AND purchases.date >= '{$_GET['date_with']}'";
        if (get('date_to')) $str .= " AND purchases.date <= '{$_GET['date_to']}'";

        // пагінація
        $p = (new NewPaginate('purchases'))
            ->setSQLFilter($str)
            ->setGroupBy('purchases.id')
            ->setOrderBy('purchases.id')
            ->get();

        // запит
        return object(R::getAll("SELECT `purchases`.*,
                `manufacturers`.`name` AS `manufacturer_name`,
                `storage`.`name` AS `storage_name`,
                SUM(`pp`.`amount` * `pp`.`price`) AS `full_sum`,
                IF(`purchases`.`type` = 1 AND `purchases`.`status` = 2 , 1, 0) AS `close` 
            FROM `purchases`
            LEFT JOIN `storage` ON (`storage`.`id` = `purchases`.`storage_id`)
            LEFT JOIN `manufacturers` ON (`manufacturers`.`id` = `purchases`.`manufacturer`)
            LEFT JOIN `purchases_products` AS `pp` ON (`pp`.`purchases_id` = `purchases`.`id`)
            {$p->query_string}"));
    }

    // пошук товарів для додавання в закупку
    public static function searchProducts($post)
    {
        $not = isset($post->not) && my_count($post->not) > 0 ? ' AND `products`.`id` NOT IN(' . implode(',', get_array($post->not)) . ') ' : '';

        if ($post->field == 'category') $sql = "`category` = {$post->data} $not";
        elseif ($post->field == 'name') $sql = "`name` LIKE '%{$post->data}%' $not";
        else $sql = "`services_code` LIKE '%{$post->data}%' $not";

        return get_object(R::getAll("SELECT 
                `products`.*,
                `pts`.`count` AS `count_on_storage`
            FROM `products` 
            LEFT JOIN `product_to_storage` AS `pts` ON (`pts`.`product_id` = `products`.`id` AND `pts`.`storage_id` = {$post->storage})
            WHERE $sql AND 
                `products`.`archive` = 0 AND 
                `products`.`manufacturer` = {$post->manufacturer} AND
                `products`.`combine` = 0 AND 
                `products`.`accounted` = 1
            GROUP BY `products`.`id`"));
    }

    // получити вибрані товари при пошуку з бази даних
    public static function getProducts($products, $storage)
    {
        $products = implode(',', $products);
        return object(R::getAll("SELECT `products`.*, `pts`.`count` AS `count_on_storage`
            FROM `products` 
            LEFT JOIN `product_to_storage` AS `pts` ON (`pts`.`product_id` = `products`.`id` AND `pts`.`storage_id` = $storage)
            WHERE `products`.`id` IN($products) GROUP BY `products`.`id`"));
    }

    // товари закупки
    public static function getProductsByPurchasesID($id)
    {
        $products = R::getAll("SELECT purchases_products.*, products.name, pts.count AS count_on_storage
            FROM purchases_products
            LEFT JOIN products ON (products.id = purchases_products.product_id)
            LEFT JOIN purchases ON (purchases.id = purchases_products.purchases_id)
            LEFT JOIN product_to_storage AS pts ON (pts.storage_id = purchases.storage_id AND pts.product_id = purchases_products.product_id)
            WHERE purchases_products.purchases_id = ?
            ORDER BY purchases_products.id", [$id]);

        return object($products);
    }

    // Відкриті закупки (ті що мають тип - необхідно закупити)
    public static function getOpenPurchases()
    {
        $all = R::getAll('SELECT DISTINCT `manufacturer` FROM `purchases` WHERE `type` = 0');

        $array = [];
        foreach ($all as $item) $array[] = $item['manufacturer'];

        return $array;
    }

    // Приходування товарів на склад
    public static function close($id)
    {
        // міняємо ти предзакупки на прийнято на облік
        $bean = R::load('purchases', $id);
        $bean->type = 1;
        R::store($bean);

        // назва складу для історії
        $storage = R::load('storage', $bean->storage_id);
        $storage = $storage->name;

        // товари з закупки
        $products = self::getProductsByPurchasesID($id);


        // перебираємо всі товари в закупці
        foreach ($products as $product) {

            // Додаємо товар на склад
            $pts = Orders::create_pts_if_not_exists($product->product_id, $bean->storage_id);
            $pts->count += $product->amount;
            R::store($pts);


            // додаємо запис в історію товару
            $hp = R::xdispense('history_product');
            $hp->product = $product->product_id;
            $hp->type = 'purchases';
            $hp->data = "На склад <b>$storage</b> оприходувано <b>{$product->amount}</b> од. по ціні <b>{$product->price}$</b>";
            $hp->date = date('Y-m-d H:i:s');
            $hp->author = user()->id;
            R::store($hp);
        }
    }

    // Створення проплати
    public static function createPayment($post, $payed)
    {
        $bean = R::xdispense('purchase_payment');

        $bean->purchase_id = $post->id;
        $bean->user_id = user()->id;
        $bean->sum = $post->sum;
        $bean->date = date('Y-m-d H:i:s');
        $bean->course = $post->course;

        R::store($bean);

        // якщо проплата рівна сумі закупки то ставимо статус оплачено повність інакше оплачено частково
        $bean = R::load('purchases', $post->id);
        $bean->status = $payed == 0 ? 2 : 1;
        R::store($bean);
    }
}