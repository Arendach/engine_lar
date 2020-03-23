<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Attribute
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $name_ru
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attribute whereNameRu($value)
 * @mixin \Eloquent
 */
	class Attribute extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Article
 *
 * @property int $id
 * @property string $title
 * @property string $type
 * @property string $short_content
 * @property string $content
 * @property int $author_id
 * @property int $is_comment
 * @property int $priority
 * @property int $is_fixed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $author
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article articles()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article news()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereIsComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereIsFixed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereShortContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $created_date_human
 * @property-read mixed $updated_date_human
 * @property-read mixed $type_name
 */
	class Article extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ArticleComment
 *
 * @property int $id
 * @property int $author_id
 * @property int $article_id
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Article $article
 * @property-read \App\Models\User $author
 * @property-read string $created_date_human
 * @property-read string $updated_date_human
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ArticleComment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ArticleView
 *
 * @property int $id
 * @property int $user_id
 * @property int $article_id
 * @property int $is_viewed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleView newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleView newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleView query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleView whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleView whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleView whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleView whereIsViewed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleView whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleView whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Article $article
 * @property-read \App\Models\User $user
 */
	class ArticleView extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Attribute
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $name_ru
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute whereNameRu($value)
 * @mixin \Eloquent
 */
	class Attribute extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BlackDate
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $date
 * @property string|null $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlackDate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlackDate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlackDate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlackDate whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlackDate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlackDate whereName($value)
 * @mixin \Eloquent
 */
	class BlackDate extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Bonus
 *
 * @property int $id
 * @property string $data
 * @property mixed $type
 * @property float $sum
 * @property int $user_id
 * @property string $date
 * @property string $source
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus whereSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus whereUserId($value)
 * @mixin \Eloquent
 * @property-read mixed $color
 * @property-read mixed $type_text
 * @property-read mixed $date_human
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus fromMonth($year, $month, $user_id = 0)
 * @property-read mixed $source_link
 * @property-read mixed $source_text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus whereUpdatedAt($value)
 */
	class Bonus extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property int $parent
 * @property int $sort
 * @property int $service_code
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereServiceCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereSort($value)
 * @mixin \Eloquent
 * @property int $parent_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereParentId($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Characteristic
 *
 * @property int $id
 * @property string $name
 * @property string|null $prefix
 * @property string|null $postfix
 * @property string|null $value
 * @property string $name_ru
 * @property string|null $prefix_ru
 * @property string|null $postfix_ru
 * @property string|null $value_ru
 * @property string $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic wherePostfix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic wherePostfixRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic wherePrefixRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic whereValueRu($value)
 * @mixin \Eloquent
 */
	class Characteristic extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Client
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $info
 * @property \App\Models\ClientGroup $group
 * @property int $percentage
 * @property int $manager_id
 * @property-read \App\Models\User $manager
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client wherePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client wherePhone($value)
 * @mixin \Eloquent
 * @property int|null $group_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereUpdatedAt($value)
 * @property-read string $created_date_human
 * @property-read string $updated_date_human
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client filter($filters)
 */
	class Client extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClientGroup
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientGroup whereName($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Client[] $clients
 * @property-read int|null $clients_count
 */
	class ClientGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClientOrder
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientOrder query()
 * @mixin \Eloquent
 */
	class ClientOrder extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Image
 *
 * @property int $id
 * @property string $path
 * @property string|null $original_name
 * @property string|null $alt
 * @property string|null $tags
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereOriginalName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Image extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Inventory
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property int $user_id
 * @property string $comment
 * @property int $manufacturer_id
 * @property int $storage_id
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory whereManufacturerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory whereStorageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory whereUserId($value)
 * @mixin \Eloquent
 * @property-read string $created_date_human
 * @property-read string $updated_date_human
 * @property-read \App\Models\Manufacturer $manufacturer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\Storage $storage
 * @property-read \App\Models\User $user
 */
	class Inventory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\InventoryProduct
 *
 * @property int $id
 * @property int $inventory_id
 * @property int $product_id
 * @property int $amount
 * @property int $old_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InventoryProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InventoryProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InventoryProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InventoryProduct whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InventoryProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InventoryProduct whereInventoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InventoryProduct whereOldCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InventoryProduct whereProductId($value)
 * @mixin \Eloquent
 */
	class InventoryProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Logistic
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic whereName($value)
 * @mixin \Eloquent
 */
	class Logistic extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Manufacturer
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property int $sort
 * @property string $address
 * @property string $info
 * @property int $groupe
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer whereGroupe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer whereSort($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $name_ru
 * @property int|null $image_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer whereUpdatedAt($value)
 */
	class Manufacturer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Merchant
 *
 * @property int $id
 * @property string $name
 * @property string $password
 * @property int $merchant_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant wherePassword($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MerchantCard[] $cards
 * @property-read int|null $cards_count
 */
	class Merchant extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MerchantCard
 *
 * @property int $id
 * @property string $number
 * @property int $merchant_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantCard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantCard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantCard query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantCard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantCard whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantCard whereNumber($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Merchant $merchant
 */
	class MerchantCard extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\NewPostCity
 *
 * @property int $id
 * @property string $name
 * @property string $ref
 * @property string $prefix
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostCity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostCity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostCity query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostCity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostCity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostCity whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostCity wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostCity whereRef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostCity whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class NewPostCity extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\NewPostWarehouse
 *
 * @property int $id
 * @property string $name
 * @property string $ref
 * @property string $city_ref
 * @property int $number
 * @property int|null $max_weight_place
 * @property int|null $max_weight_all
 * @property string|null $phone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostWarehouse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostWarehouse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostWarehouse query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostWarehouse whereCityRef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostWarehouse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostWarehouse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostWarehouse whereMaxWeightAll($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostWarehouse whereMaxWeightPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostWarehouse whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostWarehouse whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostWarehouse wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostWarehouse whereRef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostWarehouse whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class NewPostWarehouse extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Notification
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property string $date
 * @property string $content
 * @property int $see
 * @property string $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereSee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereUserId($value)
 */
	class Notification extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $author_id Автор замовлення
 * @property mixed $type Тип замовлення
 * @property string|null $fio ПІБ
 * @property string|null $phone Телефон
 * @property string|null $phone2 Додатковий телефон
 * @property string|null $email Електронка
 * @property \Illuminate\Support\Carbon|null $created_at Дата створення замовлення
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $date_delivery Дата доставки
 * @property string|null $time_with ГПЧД Від
 * @property string|null $time_to ГПЧД До
 * @property string|null $city Місто або ід міста
 * @property string|null $address Адреса
 * @property string|null $comment_address Коментар до адреси
 * @property int|null $pay_id Ідентифікатор способу оплати
 * @property int|null $courier_id ІД курєра (users)
 * @property string|null $comment Коментар до замовлення
 * @property string|null $warehouse Склад
 * @property int|null $logistic_id Ідентифікатор транспортної компанії
 * @property mixed|null $pay_delivery Оплата доставки
 * @property mixed|null $imposed Хто оплачує наложений платіж
 * @property int|null $status Статус замовлення
 * @property int|null $discount Знижка
 * @property int|null $delivery_cost Ціна доставки
 * @property int|null $hint_id ІД підказки
 * @property int|null $payment_status Статус оплати
 * @property float|null $prepayment Сума предоплати
 * @property string|null $street Вулиця
 * @property float|null $full_sum Сума замовлення
 * @property int|null $order_professional_id Тип професійного замовлення
 * @property int|null $liable_id Відповідальний менеджер(users)
 * @property \App\Models\Site $site
 * @property int|null $sending_variant
 * @property int|null $client_id
 * @property-read \App\Models\User $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Bonus[] $bonuses
 * @property-read int|null $bonuses_count
 * @property-read \App\Models\Client|null $client
 * @property-read \App\Models\User|null $courier
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderFile[] $files
 * @property-read int|null $files_count
 * @property-read mixed $created_date_human
 * @property-read mixed $date_delivery_human
 * @property-read mixed $is_c_lose
 * @property-read mixed $is_open
 * @property-read mixed $phone_format
 * @property-read mixed $sending_status_color
 * @property-read mixed $sending_status_name
 * @property-read mixed $status_color
 * @property-read mixed $status_name
 * @property-read mixed $sum
 * @property-read mixed $time
 * @property-read mixed $type_name
 * @property-read mixed $updated_date_human
 * @property-read \App\Models\OrderHint|null $hint
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderHistory[] $history
 * @property-read int|null $history_count
 * @property-read \App\Models\User|null $liable
 * @property-read \App\Models\Logistic|null $logistic
 * @property-read \App\Models\Pay|null $pay
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\OrderProfessional|null $professional
 * @property-read \App\Models\NewPostCity|null $sending_city
 * @property-read \App\Models\NewPostWarehouse|null $sending_warehouse
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SmsMessage[] $sms_messages
 * @property-read int|null $sms_messages_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderTransaction[] $transactions
 * @property-read int|null $transactions_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order closed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order delivery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order filter($filters)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order iAuthor()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order iCourier()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order iLiable()
 * @method static \AjCastro\EagerLoadPivotRelations\EagerLoadPivotBuilder|\App\Models\Order newModelQuery()
 * @method static \AjCastro\EagerLoadPivotRelations\EagerLoadPivotBuilder|\App\Models\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order opened()
 * @method static \AjCastro\EagerLoadPivotRelations\EagerLoadPivotBuilder|\App\Models\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order self()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order sending()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCommentAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCourierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDateDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDeliveryCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereFio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereFullSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereHintId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereImposed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereLiableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereLogisticId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderProfessionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePayDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePhone2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePrepayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereSendingVariant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTimeTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTimeWith($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereWarehouse($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderFile
 *
 * @property int $id
 * @property string $path
 * @property int $order_id
 * @property-read mixed $base_name
 * @property-read mixed $create_date
 * @property-read mixed $icon
 * @property-read mixed $size
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderFile whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderFile wherePath($value)
 * @mixin \Eloquent
 * @property-read mixed $image_size
 * @property-read mixed $public_path
 */
	class OrderFile extends \Eloquent {}
}

namespace App\Models{
/**
 * Web\Eloquent\OrderHint
 *
 * @property int $id
 * @property string|null $color
 * @property string|null $description
 * @property mixed $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHint query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHint whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHint whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHint whereType($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHint type($type)
 * @property-read mixed $type_name
 */
	class OrderHint extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderHistory
 *
 * @property int $id
 * @property string|null $data
 * @property int|null $order_id
 * @property string|null $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property int $author_id
 * @property-read \App\Models\User $author
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory whereType($value)
 * @mixin \Eloquent
 */
	class OrderHistory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderProduct
 *
 * @property int $id
 * @property int|null $order_id
 * @property int|null $product_id
 * @property \App\Casts\CollectionCast|null $attributes
 * @property int|null $amount
 * @property string|null $price
 * @property string $place
 * @property int $storage_id
 * @property-read \App\Models\Order|null $order
 * @property-read \App\Models\Product|null $product
 * @property-read \App\Models\Storage $storage
 * @property-read \App\Models\Storage $test
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereAttributes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct wherePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereStorageId($value)
 */
	class OrderProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderProfessional
 *
 * @property int $id
 * @property string $name
 * @property string $color
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProfessional newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProfessional newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProfessional query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProfessional whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProfessional whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProfessional whereName($value)
 * @mixin \Eloquent
 */
	class OrderProfessional extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderTransaction
 *
 * @property int $id
 * @property int $order_id
 * @property int $transaction_id
 * @property float $sum
 * @property string $date
 * @property string|null $description
 * @property string $card
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderTransaction whereCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderTransaction whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderTransaction whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderTransaction whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderTransaction whereSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderTransaction whereTransactionId($value)
 * @mixin \Eloquent
 */
	class OrderTransaction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Pay
 *
 * @property int $id
 * @property string $name
 * @property int|null $merchant_id
 * @property string|null $provider
 * @property string|null $address
 * @property string|null $ipn
 * @property string|null $account
 * @property string|null $bank
 * @property string|null $mfo
 * @property string|null $phone
 * @property string|null $director
 * @property int|null $is_cashless
 * @property int $is_pdv
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay whereBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay whereDirector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay whereIpn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay whereIsCashless($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay whereIsPdv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay whereMfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay whereProvider($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Merchant|null $merchant
 */
	class Pay extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Payout
 *
 * @property int $id
 * @property float $sum
 * @property int $user
 * @property int $author
 * @property string $date_payout
 * @property int $year
 * @property int $month
 * @property string $comment
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout fromMonth($year, $month, $user_id = 0)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout whereDatePayout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout whereMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout whereSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout whereYear($value)
 * @mixin \Eloquent
 * @property int $user_id
 * @property int $author_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout whereUserId($value)
 */
	class Payout extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property string|null $name_ru
 * @property string $articul
 * @property string $model
 * @property string|null $model_ru
 * @property string $identefire_storage
 * @property string $service_code
 * @property float $procurement_costs
 * @property int $is_combine
 * @property float $costs
 * @property string $storage
 * @property int $archive
 * @property \App\Casts\ProductAttributesCast $attributes
 * @property int|null $manufacturer_id
 * @property int|null $category_id
 * @property float|null $weight
 * @property string|null $volume
 * @property int $author_id
 * @property string $date
 * @property int $is_accounted
 * @property string|null $description
 * @property string|null $description_ru
 * @property string|null $meta_title_uk
 * @property string|null $meta_title_ru
 * @property string|null $meta_keywords_uk
 * @property string|null $meta_keywords_ru
 * @property string|null $meta_description_uk
 * @property string|null $meta_description_ru
 * @property string $product_key
 * @property-read \App\Models\Category|null $category
 * @property-read mixed $level1
 * @property-read mixed $level2
 * @property-read mixed $volume_array
 * @property-read mixed $volume_general
 * @property-read \App\Models\ProductImage $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $linked
 * @property-read int|null $linked_count
 * @property-read \App\Models\Manufacturer|null $manufacturer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductStorage[] $storage_list
 * @property-read int|null $storage_list_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Storage[] $storages
 * @property-read int|null $storages_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product filter($filters)
 * @method static \AjCastro\EagerLoadPivotRelations\EagerLoadPivotBuilder|\App\Models\Product newModelQuery()
 * @method static \AjCastro\EagerLoadPivotRelations\EagerLoadPivotBuilder|\App\Models\Product newQuery()
 * @method static \AjCastro\EagerLoadPivotRelations\EagerLoadPivotBuilder|\App\Models\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereArchive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereArticul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereAttributes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCosts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereIdentefireStorage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereIsAccounted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereIsCombine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereManufacturerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereMetaDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereMetaDescriptionUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereMetaKeywordsRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereMetaKeywordsUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereMetaTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereMetaTitleUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereModelRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProcurementCosts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereServiceCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereStorage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereVolume($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereWeight($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductAsset
 *
 * @property int $id
 * @property string $name
 * @property int $storage_id
 * @property float $price
 * @property \Illuminate\Support\Carbon $created_at
 * @property float $course
 * @property int $is_archive
 * @property string $id_in_storage
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Storage $storage
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAsset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAsset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAsset query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAsset whereCourse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAsset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAsset whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAsset whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAsset whereIdInStorage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAsset whereIsArchive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAsset whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAsset wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAsset whereStorageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAsset whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read string $created_date_human
 * @property-read string $updated_date_human
 */
	class ProductAsset extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductHistory
 *
 * @property int $id
 * @property int|null $product
 * @property string|null $type
 * @property string|null $data
 * @property string|null $date
 * @property int $author
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductHistory whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductHistory whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductHistory whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductHistory whereProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductHistory whereType($value)
 */
	class ProductHistory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductImage
 *
 * @property int $id
 * @property int $product_id
 * @property string $path
 * @property string|null $alt
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $is_main
 * @property-read mixed $base_name
 * @property-read mixed $create_date
 * @property-read mixed $icon
 * @property-read mixed $image_size
 * @property-read mixed $public_path
 * @property-read mixed $size
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereIsMain($value)
 */
	class ProductImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductLinked
 *
 * @property int $id
 * @property int $product_id
 * @property int $linked_id
 * @property float|null $combine_price
 * @property int|null $combine_minus
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductLinked newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductLinked newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductLinked query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductLinked whereCombineMinus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductLinked whereCombinePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductLinked whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductLinked whereLinkedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductLinked whereProductId($value)
 * @mixin \Eloquent
 */
	class ProductLinked extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductStorage
 *
 * @property int $id
 * @property int $product_id
 * @property int $storage_id
 * @property int $count
 * @property-read \App\Models\Storage $storage
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductStorage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductStorage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductStorage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductStorage whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductStorage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductStorage whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductStorage whereStorageId($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductStorage onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductStorage whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductStorage withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductStorage withoutTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductStorage filter($storage_id, $product_id)
 */
	class ProductStorage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Purchase
 *
 * @property int $id
 * @property int $manufacturer_id
 * @property int $status
 * @property int $type
 * @property float $prepayment
 * @property float $sum
 * @property string $comment
 * @property int $storage_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereManufacturerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase wherePrepayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereStorageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read string $created_date_human
 * @property-read mixed $status_name
 * @property-read mixed $type_name
 * @property-read string $updated_date_human
 * @property-read \App\Models\Manufacturer $manufacturer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\Storage $storage
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase filter($filters)
 * @property-read mixed $is_closed
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PurchasePayment[] $payments
 * @property-read int|null $payments_count
 */
	class Purchase extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PurchasePayment
 *
 * @property int $id
 * @property int $purchase_id
 * @property int $user_id
 * @property float $sum
 * @property \Illuminate\Support\Carbon $created_at
 * @property float $course
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PurchasePayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PurchasePayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PurchasePayment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PurchasePayment whereCourse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PurchasePayment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PurchasePayment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PurchasePayment wherePurchaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PurchasePayment whereSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PurchasePayment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PurchasePayment whereUserId($value)
 */
	class PurchasePayment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Report
 *
 * @property int $id
 * @property string $name_operation
 * @property string $date
 * @property string $data
 * @property float $sum
 * @property string $comment
 * @property int $user
 * @property string $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report whereNameOperation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report whereSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report whereUser($value)
 * @mixin \Eloquent
 * @property-read mixed $type_color
 * @property-read mixed $type_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report type($type)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report my()
 * @property int $user_id
 * @property-read mixed $moving_status
 * @property-read mixed $moving_user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report whereUserId($value)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property int|null $report_item_id
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $day
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report whereReportItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report whereUpdatedAt($value)
 */
	class Report extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ReportItem
 *
 * @property int $id
 * @property int $user_id
 * @property float $just_now
 * @property float $start_month
 * @property string $year
 * @property string $month
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportItem concrete($year, $month, $user_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportItem whereJustNow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportItem whereMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportItem whereStartMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportItem whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportItem whereYear($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Report[] $items
 * @property-read int|null $items_count
 */
	class ReportItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Schedule
 *
 * @property int $id
 * @property string $date
 * @property int $type
 * @property int $turn_up
 * @property int $went_away
 * @property int $work_day
 * @property int $dinner_break
 * @property int $user_id
 * @property-read mixed $type_name
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereDinnerBreak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereTurnUp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereWentAway($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereWorkDay($value)
 * @mixin \Eloquent
 * @property int|null $schedule_month_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereScheduleMonthId($value)
 * @property-read mixed $day
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule isHoliday()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule isHospital()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule isVacation()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule isWorking()
 * @property-read mixed $type_color
 * @property-read mixed $worked
 * @property-read mixed $worked_color
 * @property string|null $updated_at
 * @property string|null $created_at
 * @property-read mixed $recycling
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereUpdatedAt($value)
 */
	class Schedule extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ScheduleMonth
 *
 * @property int $id
 * @property float $price_month
 * @property float $for_car
 * @property float|null $bonus
 * @property int $user_id
 * @property int $year
 * @property int $month
 * @property string $date
 * @property float|null $fine
 * @property float|null $coefficient
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth whereBonus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth whereCoefficient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth whereFine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth whereForCar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth whereMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth wherePriceMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth whereYear($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth my()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Schedule[] $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth concrete($year = null, $month = null, $user = null)
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth whereUpdatedAt($value)
 * @property-read mixed $hospital_hours
 * @property-read mixed $hour_price
 * @property-read mixed $up_working_hours
 * @property-read mixed $vacation_hours
 * @property-read mixed $working_hours
 */
	class ScheduleMonth extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Shop
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string|null $name_ru
 * @property string|null $address_ru
 * @property string|null $url_path
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereAddressRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereUrlPath($value)
 * @mixin \Eloquent
 */
	class Shop extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Site
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Site newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Site newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Site query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Site whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Site whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Site whereUrl($value)
 * @mixin \Eloquent
 */
	class Site extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SmsMessage
 *
 * @property int $id
 * @property int $order_id
 * @property string $text
 * @property string $date
 * @property int $message_id
 * @property string $phone
 * @property string $status
 * @property-read mixed $status_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsMessage whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsMessage whereMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsMessage whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsMessage wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsMessage whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsMessage whereText($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsMessage whereUpdatedAt($value)
 */
	class SmsMessage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SmsTemplate
 *
 * @property int $id
 * @property string $name
 * @property string $text
 * @property string $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsTemplate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsTemplate whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsTemplate whereType($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsTemplate type($type)
 */
	class SmsTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Storage
 *
 * @property int $id
 * @property string $name
 * @property int $accounted
 * @property string $info
 * @property int $sort
 * @property int $self
 * @property int $delivery
 * @property int $shop
 * @property int $sending
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereAccounted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereSelf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereSending($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereShop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereSort($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage accounted($isAccounted = true)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage sort($order = 'asc')
 * @property int $is_accounted
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereIsAccounted($value)
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Storage onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Storage withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Storage withoutTrashed()
 */
	class Storage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StorageId
 *
 * @property int $id
 * @property string $level1
 * @property string $level2
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageId newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageId newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageId query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageId whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageId whereLevel1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageId whereLevel2($value)
 * @mixin \Eloquent
 */
	class StorageId extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Street
 *
 * @property int $id
 * @property string $city
 * @property string $district
 * @property string $street_type
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Street newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Street newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Street query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Street whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Street whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Street whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Street whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Street whereStreetType($value)
 * @mixin \Eloquent
 */
	class Street extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Task
 *
 * @property int $id
 * @property int $user
 * @property int $author
 * @property string $date
 * @property string $content
 * @property string $type
 * @property int $success
 * @property string $comment
 * @property float $price
 * @property int $approve
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereApprove($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereSuccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereUser($value)
 * @mixin \Eloquent
 * @property int $user_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property int $is_success
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereIsSuccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereUserId($value)
 * @property int $author_id
 * @property int $is_approve
 * @property-read string $created_date_human
 * @property-read mixed $status_name
 * @property-read string $updated_date_human
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task my()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereIsApprove($value)
 */
	class Task extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $access
 * @property string $pin
 * @property string $name
 * @property string $instruction
 * @property float $reserve_funds
 * @property float $rate
 * @property int $archive
 * @property int $schedule_notice
 * @property int $position
 * @property int $is_courier
 * @property string|null $theme
 * @property-read mixed $is_online
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User couriers()
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereArchive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereInstruction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereIsCourier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereReserveFunds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereScheduleNotice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withoutTrashed()
 * @mixin \Eloquent
 * @property-read mixed $theme_path
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Notification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $tasks
 * @property-read int|null $tasks_count
 * @property string $user_access_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserAccessId($value)
 * @property-read \App\Models\UserAccess $user_access
 * @property-read mixed $full_name
 * @property-read mixed $online_color
 * @property-read mixed $online_text
 * @property int $user_position_id
 * @property-read \App\Models\UserPosition $userPosition
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserPositionId($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserAccess
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $description
 * @property string $name
 * @property string $params
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess whereParams($value)
 * @property-read mixed $array_params
 */
	class UserAccess extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserPosition
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPosition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPosition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPosition query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPosition whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPosition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPosition whereName($value)
 * @mixin \Eloquent
 */
	class UserPosition extends \Eloquent {}
}

