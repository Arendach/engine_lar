<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Session;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Entities\CategoryEntity;
use Tests\Entities\InventoryEntity;
use Tests\Entities\ManufacturerEntity;
use Tests\Entities\ProductAssetEntity;
use Tests\Entities\ProductEntity;
use Tests\Entities\StorageEntity;
use Tests\Entities\UserEntity;
use function GuzzleHttp\Psr7\str;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseMigrations;
    use WithFaker;

    use ProductEntity;
    use StorageEntity;
    use CategoryEntity;
    use ManufacturerEntity;
    use UserEntity;
    use InventoryEntity;
    use ProductAssetEntity;

    public $user;

    public function authenticate()
    {
        if (is_null($this->user)) {
            $this->user = factory(User::class)->create([
                'login'            => 'Arendach',
                'user_position_id' => null,
                'password'         => md5(md5('qwerty'))
            ]);

            Session::put('login', 'Arendach');
            Session::put('password', 'qwerty');
        }
    }

    public function convertValuesToString(array $data): array
    {
        foreach ($data as $key => $item) {
            try {
                $data[$key] = (string)$data[$key];
            } catch (\Exception $exception) {

            }
        }

        return $data;
    }
}
