<?php

namespace Tests\Entities;

use App\Models\User;

trait UserEntity
{
    public $user;

    public function getUser(): User
    {
        if (!$this->user) {
            $this->user = factory(User::class)->create();
        }

        return $this->user;
    }
}