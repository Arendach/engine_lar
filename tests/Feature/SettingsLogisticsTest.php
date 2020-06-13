<?php

namespace Tests\Feature;

use App\Models\Logistic;
use Tests\TestCase;

class SettingsLogisticsTest extends TestCase
{
    public function testMainPage()
    {
        $this->authenticate();

        $hint = factory(Logistic::class)->create();

        $this->get('/setting/logistic')
            ->assertStatus(200)
            ->assertSee($hint->name);
    }
}
