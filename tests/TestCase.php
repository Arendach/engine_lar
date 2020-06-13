<?php

namespace Tests;

use App\Models\User;
use Session;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseMigrations;

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
