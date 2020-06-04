<?php

use Illuminate\Database\Seeder;
use App\Models\SmsMessage;
use App\Models\SmsTemplate;

class SmsSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('sms_messages')->get()->each(function (stdClass $item) {
            SmsMessage::create([
                'id'         => $item->id,
                'order_id'   => $item->order_id,
                'text'       => htmlspecialchars_decode($item->text),
                'message_id' => $item->message_id,
                'phone'      => $item->phone,
                'status'     => $item->status,
                'created_at' => $item->date,
                'updated_at' => $item->date,
            ]);
        });

        DB::connection('old')->table('sms_templates')->get()->each(function (stdClass $item) {
            SmsTemplate::create([
                'id'   => $item->id,
                'name' => $item->name,
                'type' => $item->type,
                'text' => htmlspecialchars_decode($item->text)
            ]);
        });
    }
}
