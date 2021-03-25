<?php

namespace App\Services;

use App\Models\Order;
use DiDom\Document;
use LisDev\Delivery\NovaPoshtaApi2;

class NewPost
{
    /**
     * @var NovaPoshtaApi2
     */
    public $nova;

    /**
     * NewPost constructor.
     */
    public function __construct()
    {
        $this->nova = new NovaPoshtaApi2(config('api.new_post'), 'ua');
    }

    /**
     * @param $name
     */
    public function getCity($name)
    {
        $result = $this->nova
            ->model('Address')
            ->method('getCities')
            ->params([
                'FindByString' => $name,
                'Limit'        => '500',
            ])
            ->execute();

        if (count($result['errors']) > 0) {
            $str = '';
            foreach ($result['errors'] as $error) {
                if ($error == 'API key expired')
                    $str .= 'Прострочений API-ключ НовоїПошти!';
            }

            response(500, $str);
        }


        $str = '';
        foreach ($result['data'] as $item) {
            $type = $this->settElementType($item['SettlementTypeDescription']);
            $str .= '<option value="' . $item['Ref'] . '">' . $type . $item['Description'] . '</option>';
        }
        echo $str;
    }

    /**
     * @param $element
     * @return string
     */
    public function settElementType($element)
    {
        if ($element == 'село') {
            return 'с. ';
        } elseif ($element == 'селище міського типу') {
            return 'смт. ';
        } elseif ($element == 'місто') {
            return 'м. ';
        } else {
            return '?. ';
        }
    }

    /**
     * @param $ref
     * @return mixed
     */
    public function getCityByRef($ref)
    {
        $result = $this->nova
            ->model('Address')
            ->method('getCities')
            ->params([
                'Ref' => $ref,
            ])
            ->execute();

        return ($result);

    }

    /**
     * @param $ref
     * @return string
     */
    public function getNameCityByRef($ref)
    {
        $search = $this->getCityByRef($ref);

        if (isset($search['data'][0])) {
            $city = $search['data'][0];
            $type = $this->settElementType($city['SettlementTypeDescription']);
            return (
                $type
                . $city['Description']
            );
        } else {
            return ('not_found');
        }
    }

    /**
     * @return mixed
     */
    public function get_cards()
    {
        $result = $this->nova
            ->model('Payment')
            ->method('getCards')
            ->execute();

        return ($result['data']);
    }

    /**
     * @param $city
     * @return array
     */
    public function search_warehouses($city)
    {
        $data = [];

        $result = $this->nova
            ->model('AddressGeneral')
            ->method('getWarehouses')
            ->params([
                'CityRef' => $city
            ])
            ->execute();

        if (count($result['data']) > 0) {
            $data['disabled'] = false;
            $data['data'] = $result['data'];
        } else {
            $data['disabled'] = true;
            $data['data'] = [];
        }

        return $data;
    }

    /**
     * @param $city
     * @param $warehouse
     * @return array
     */
    public function get_address($city, $warehouse)
    {
        $warehouses = $this->search_warehouses($city);

        foreach ($warehouses['data'] as $item) {
            if ($item['Ref'] == $warehouse) {
                $war = $item['Description'];
                break;
            }
        }

        if (!isset($war))
            $war = 'not_found';

        $data = [
            'city'      => $this->getNameCityByRef($city),
            'warehouse' => $war
        ];

        return $data;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function getStatusDocuments($data)
    {
        $documents = [];
        foreach ($data as $item) {
            if (preg_match('/[0-9]{14}/', $item['street'])) {
                $temp = [];
                $temp['DocumentNumber'] = trim($item['street']);
                $temp['Phone'] = '';
                $documents[] = $temp;
            }
        }

        $result = $this->nova
            ->model('TrackingDocument')
            ->method('getStatusDocuments')
            ->params([
                'Documents' => $documents
            ])
            ->execute();

        return $result;
    }

    public function getCities($page)
    {
        $result = $this->nova
            ->model('Address')
            ->method('getCities')
            ->params([
                'Page'  => $page,
                'Limit' => 500
            ])
            ->execute();

        return $result['data'];
//        return count($result['data']) == 0 ? false : $result['data'];
    }


    public function getWarehouses($page)
    {
        $result = $this->nova
            ->model('AddressGeneral')
            ->method('getWarehouses')
            ->params([
                'Page'  => $page,
                'Limit' => 500
            ])
            ->execute();

        return $result['data'];
//        return count($result['data']) == 0 ? false : $result['data'];
    }

    public function getMarker(Order $order): ?string
    {
        if ($order->type == 'sending' && $order->street) {
            return null;
        }

        $address = "https://my.novaposhta.ua/orders/printMarkings/orders[]/{$order->street}/type/html/apiKey/" . config('api.new_post');

        $dom = new Document($address, true);

        $body = $dom->first('body');

        $imgs = $body->findInDocument('img');

        foreach ($imgs as $k => $img) {
            $attr = $img->attr('src');
            $body->findInDocument('img')[$k]->attr('src', "http://my.novaposhta.ua{$attr}");
        }

        $markers = $body->findInDocument('.page-100-100');

        $result = '';
        foreach ($markers as $marker) {
            $result .= $marker->html();
        }

        return $result;
    }
}