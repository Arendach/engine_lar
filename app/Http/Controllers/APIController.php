<?php

namespace App\Http\Controllers;


use Web\App\Request;
use Web\Model\Api\Location;
use Web\Model\Coupon;
use Web\Model\Api\NewPost;

class APIController extends Controller
{
    /**
     * @var string
     */
    private $api_key;

    /**
     * APIController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->api_key = '123';
    }

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
        $result = Location::searchStreets($request->street, 'Kyiv');

        response()->json($result);
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