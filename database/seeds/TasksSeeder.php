<?php

use Illuminate\Database\Seeder;
use App\Models\Task;

class TasksSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('tasks')->get()->each(function (stdClass $item) {
            Task::create([
                'user_id'    => $item->user,
                'author_id'  => $item->author,
                'content'    => htmlspecialchars_decode($item->content),
                'type'       => $item->type,
                'is_success' => $item->success,
                'comment'    => htmlspecialchars_decode($item->comment),
                'price'      => $item->price,
                'is_approve' => $item->approve,
                'created_at' => $item->date,
                'updated_at' => $item->date
            ]);
        });
    }
}
