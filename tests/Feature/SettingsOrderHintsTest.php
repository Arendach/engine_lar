<?php

namespace Tests\Feature;

use App\Models\OrderHint;
use Tests\TestCase;

class SettingsOrderHintsTest extends TestCase
{
    public function testMainPage()
    {
        $this->authenticate();

        $hint = OrderHint::factory()->create();

        $this->get('/setting/hints')
            ->assertStatus(200)
            ->assertSee($hint->description)
            ->assertSee($hint->color);
    }
}
