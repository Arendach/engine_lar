<?php

namespace App\Http\Controllers;

use App\Models\Street;
use Illuminate\Http\Request;
use Web\Model\Api\Location;
use Web\Model\Coupon;
use Web\Model\Api\NewPost;

class APIController extends Controller
{
    /**
     * @param $post
     */
    public function search_village($post)
    {
        $result = Location::search_village($post->name);

        echo $result != false ? $result : '';
    }

    /**
     * @param $post
     */
    public function search_coupon($post)
    {
        if ($post->key == $this->api_key) {
            echo json_encode(Coupon::search_coupon($post->str));
        } else {
            echo json_encode(['status' => '0']);
        }
    }


    public function actionSearchStreets(Request $request)
    {
        $result = Street::where('name', 'like', "%$request->street%")
            ->get()
            ->map(function (Street $street) {
                return "$street->street_type $street->name ($street->district)";
            });

        return response()->json($result);
    }

    /**
     * @param $post
     */
    public function search_city($post)
    {
        $result = Location::search_city($post->name);

        echo $result != false ? $result : '';
    }

    public function get_city($post)
    {
        $new_post = new NewPost();

        $new_post->getCity($post->str);
    }

    public function search_warehouses($post)
    {
        $new_post = new NewPost();

        $warehouses = $new_post->search_warehouses($post->city);

        $str = '';

        foreach ($warehouses['data'] as $item) {
            $str .= '<option value="' . $item['Ref'] . '">' . $item['Description'] . '</option>';
        }

        echo $str;
    }

}