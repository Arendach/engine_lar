<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\CreateUpdateTaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

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
        $data = $request->merge([
            'author_id' => user()->id
        ]);

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

    public function actionClose(Request $request)
    {
        Task::findOrFail($request->id)->update($request->all());
    }

    public function actionCloseForm(Request $request)
    {
        $task = Task::findOrFail($request->id);
        $type = $request->get('type', 'success');

        return view('task.close_form', compact('task', 'type'));
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