<?php

namespace Tests\Feature;

use App\Models\Logistic;
use Tests\TestCase;

class SettingsLogisticsTest extends TestCase
{
    public function testMainPage()
    {
        $this->authenticate();

        $hint = Logistic::factory()->create();

        $this->get('/setting/logistic')
            ->assertStatus(200)
            ->assertSee($hint->name);
    }
}
