<?php

namespace Tests\Feature\Sms;

use App\Models\Order;
use App\Models\SmsTemplate;
use Tests\TestCase;

class PrepareTemplateTest extends TestCase
{
    public function testPrepareTemplate()
    {
        $this->authenticate();

        $template = factory(SmsTemplate::class)->create([
            'text' => '@date@ @id@',
            'type' => 'sending'
        ]);

        $order = factory(Order::class)->create([
            'type' => $template->type
        ]);

        $this->post('/sms/prepare_template', [
            'order_id'    => $order->id,
            'template_id' => $template->id
        ])->assertStatus(200)
            ->assertJsonFragment([
                'text' => (string)(date('d.m.Y') . ' ' . $order->id)
            ]);
    }
}
