<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\CreateUpdateTaskRequest;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    public function sectionMain(int $user = 0)
    {
        $user = user($user);

        return view('task.main', [
            'user'  => $user,
            'tasks' => Task::my()->orderByDesc('id')->get()
        ]);
    }

    public function actionCreateForm(int $user_id)
    {
        $data = [
            'users'   => User::all(),
            'user_id' => $user_id
        ];

        return view('task.create_form', $data);
    }

    public function actionCreate(CreateUpdateTaskRequest $request)
    {
        $data = $request->all();
        $data['author_id'] = user()->id;

        Task::create($data);
    }

    public function actionUpdate(CreateUpdateTaskRequest $request)
    {
        Task::findOrFail($request->id)->update($request->all());
    }

    public function actionUpdateForm(int $id)
    {
        return view('task.update_form', ['task' => Task::findOrFail($id)]);
    }

    // todo
    public function action_close($post)
    {
        Task::update(['comment' => $post->comment, 'success' => $post->type == 'success' ? '1' : '2'], $post->id);

        response(200, 'Задача вдало закрита!');
    }

    // todo
    public function action_close_form($post)
    {
        echo $this->view->render('task.close_form', ['id' => $post->id, 'type' => $post->type]);
    }

    public function actionDelete(int $id)
    {
        Task::findOrFail($id)->delete();
    }

    // todo
    public function actionApprove($post)
    {
        // Task::approve_task($post);
    }
}