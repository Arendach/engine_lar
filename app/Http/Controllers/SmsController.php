<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sms\SendOrderRequest;
use App\Http\Requests\Sms\UniversalRequest;
use App\Models\SmsMessage;
use App\Models\SmsTemplate;
use Illuminate\Http\Request;
use App\Models\Order;

class SmsController extends Controller
{
    public function sectionTemplates()
    {
        $items = SmsTemplate::all();

        return view('sms.templates', compact('items'));
    }

    public function actionUpdate(UniversalRequest $request)
    {
        SmsTemplate::findOrFail($request->id)->update($request->all());
    }

    public function actionDelete(Request $request)
    {
        SmsTemplate::findOrFail($request->id)->delete();
    }

    public function actionCreateForm()
    {
        return view('sms.create_form');
    }

    public function actionCreate(UniversalRequest $request)
    {
        SmsTemplate::create($request->all());
    }

    public function actionPrepareTemplate(int $order_id, int $template_id)
    {
        $order = Order::findOrFail($order_id);
        $template = SmsTemplate::findOrFail($template_id);

        $patterns = [
            ['@date@', date('d.m.Y')],
            ['@date2@', date('Y-m-d')],
            ['@datetime@', date('Y-m-d H:i:s')],
            ['@ttn@', $order->street],
            ['@delivery_cost@', $order->delivery_cost],
            ['@discount@', $order->discount],
            ['@sum@', $order->full_sum],
            ['@time_with@', string_to_time($order->time_with)],
            ['@time_to@', string_to_time($order->time_to)],
            ['@id@', $order->id],
            ['@date_delivery@', $order->date_delivery],
            ['@full_sum@', $order->full_sum],
            ['@site_name@', $order->site->name ?? ''],
            ['@site_url@', $order->site->url ?? '']
        ];

        $result = $template->text;
        foreach ($patterns as $pattern) {
            $result = preg_replace("/{$pattern[0]}/", $pattern[1], $result);
        }

        return response()->json([
            'text' => $result
        ]);
    }

    public function actionSendMessage(SendOrderRequest $request)
    {
        $message = sms_send(get_number_world_format($request->phone), $request->text);

        if ($message) {
            SmsMessage::create([
                'order_id'   => $request->order_id,
                'phone'      => get_number_world_format($request->phone),
                'message_id' => $message->messageId,
                'text'       => $request->text
            ]);

            return response()->json(['message' => 'SMS повідомлення надіслано!']);
        } else {
            return response()->json(['message' => 'SMS повідомлення не надіслано! <br> ' . $message->getMessage()], 500);
        }
    }
}