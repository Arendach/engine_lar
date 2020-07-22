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
use Tests\Entities\ProductEntity;
use Tests\Entities\StorageEntity;
use Tests\Entities\UserEntity;

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
}
