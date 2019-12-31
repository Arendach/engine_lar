<?php

namespace App\Http\Controllers;

use App\Models\ClientOrder;
use App\Models\Order;
use App\Models\Task;

class NormController extends Controller
{
    public function sectionClients()
    {
        $orders = ClientOrder::all();

        foreach ($orders as $item) {
            $order = Order::find($item->order_id);
            $order->client_id = $item->client_id;
            $order->save();
        }
    }

    public function sectionTasks()
    {
        $tasks = Task::all();

        foreach ($tasks as $task) {
            $task->content = htmlspecialchars_decode($task->content);

            $task->save();
        }
    }
}