<?php

namespace App\Console\Commands;

use App\Models\NewPostCity;
use App\Models\NewPostWarehouse;
use Illuminate\Console\Command;
use App\Services\NewPost;
use Throwable;

class ReloadNewPostWarehouses extends Command
{
    protected $signature = 'np:sync';

    protected $description = 'Перезавантаження міст та відділень нової пошти!';

    private NewPost $service;

    final public function handle(): void
    {
        $this->service = new NewPost();

        $this->loadCity();

        $this->loadWarehouse();

        $this->info('Loading successful!');
    }

    final private function loadCity(): void
    {
        $i = 1;
        while ($cities = $this->service->getCities($i)) {
            foreach ($cities as $city) {
                if (isset($city['Ref']) && $city['Ref'] != '') {
                    if (NewPostCity::where('ref', $city['Ref'])->count()) {
                        NewPostCity::where('ref', $city['Ref'])->update([
                            'name'   => $city['Description'],
                            'prefix' => $city['SettlementTypeDescription'] ?? '',
                        ]);
                    } else {
                        NewPostCity::create([
                            'name'   => $city['Description'],
                            'ref'    => $city['Ref'],
                            'prefix' => $city['SettlementTypeDescription'] ?? '',
                        ]);
                    }
                }
            }

            $this->info("City: {$i}");
            $i++;
        }
    }

    final private function loadWarehouse(): void
    {
        $i = 1;
        while ($warehouses = $this->service->getWarehouses($i)) {
            foreach ($warehouses as $warehouse) {
                if (isset($warehouse['Ref']) && $warehouse['Ref'] != '') {
                    if (NewPostWarehouse::where('ref', $warehouse['Ref'])->count()) {
                        NewPostWarehouse::where('ref', $warehouse['Ref'])->update([
                            'name'             => $warehouse['Description'],
                            'number'           => $warehouse['Number'],
                            'max_weight_place' => $warehouse['PlaceMaxWeightAllowed'],
                            'max_weight_all'   => $warehouse['TotalMaxWeightAllowed'],
                            'phone'            => $warehouse['Phone'],
                        ]);
                    } else {
                        try {
                            $city = NewPostCity::where('ref', $warehouse['CityRef'])->first();

                            NewPostWarehouse::create([
                                'name'             => $warehouse['Description'],
                                'ref'              => $warehouse['Ref'],
                                'city_ref'         => $warehouse['CityRef'],
                                'number'           => $warehouse['Number'],
                                'max_weight_place' => $warehouse['PlaceMaxWeightAllowed'],
                                'max_weight_all'   => $warehouse['TotalMaxWeightAllowed'],
                                'phone'            => $warehouse['Phone'],
                                'city_id'          => $city->id
                            ]);
                        } catch (Throwable $exception) {
                            $this->error($exception->getMessage());
                        }
                    }
                }
            }

            $this->info("Warehouse: {$i}");
            $i++;
        }
    }
}
