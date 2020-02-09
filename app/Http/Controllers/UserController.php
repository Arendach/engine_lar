<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Requests\User\UpdateInfoRequest;
use App\Http\Requests\User\UpdateMoreRequest;
use App\Http\Requests\User\UpdatePasswordRequest;
use App\Models\UserAccess;
use App\Models\UserPosition;
use Illuminate\Http\Request;
use UserAuth;
use App\Models\User;

class UserController extends Controller
{
    public $access = 'users';

    public $allowed_methods = ['section_instruction'];

    public $main_section = 'section_list';

    public function sectionLogin()
    {
        return view('login');
    }

    public function sectionList()
    {
        return view('user.list', ['users' => User::all()]);
    }

    public function sectionArchive()
    {
        return view('user.list', ['users' => User::onlyTrashed()->get()]);
    }

    public function section_view()
    {
        if (!get('id')) $this->display_404();

        $manager = User::getOne(get('id'));
        if ($manager->id == 0) $this->display_404();

        $manager = $this->get_access($manager);

        $data = [
            'title'       => 'Менеджери :: ' . $manager->login,
            'components'  => ['sweet_alert'],
            'manager'     => $manager,
            'breadcrumbs' => [
                ['Менеджери', uri('user', ['section' => 'list'])],
                [$manager->first_name . ' ' . $manager->last_name]
            ],
        ];

        $this->view->display('users.view', $data);
    }

    public function sectionUpdate(int $id)
    {
        $data = [
            'user'      => User::withTrashed()->findOrFail($id),
            'access'    => UserAccess::all(),
            'positions' => UserPosition::all()
        ];

        return view('user.update', $data);
    }

    public function sectionRegister()
    {
        $accessGroups = UserAccess::all();
        $positions = UserPosition::all();

        return view('user.register', compact('accessGroups', 'positions'));
    }

    public function sectionInstruction()
    {
        return view('user.instruction');
    }

    public function sectionProfile()
    {
        return view('user.profile.main');
    }

    public function sectionUpdatePassword()
    {
        return view('user.profile.update_password');
    }

    public function actionAuthorize(LoginRequest $request)
    {
        if (UserAuth::authorize($request->login, $request->password)) {
            return response(null, 200);
        } else {
            return response()->json(['message' => 'Не вдалось авторизуватись!'], 400);
        }
    }

    public function sectionUnAuthorize()
    {
        UserAuth::unAuthorize();

        return redirect()->route('home');
    }

    public function actionUpdateInfo(UpdateInfoRequest $request)
    {
        User::withTrashed()->findOrFail($request->id)->update($request->all());
    }

    public function actionUpdateMore(UpdateMoreRequest $request)
    {
        User::withTrashed()->findOrFail($request->id)->update($request->all());
    }

    public function actionRegister(RegisterRequest $request)
    {
        User::create($request->all());
    }

    public function actionUpdatePassword(UpdatePasswordRequest $request)
    {
        User::findOrFail($request->id)->update($request->only('password'));
    }

    public function actionUpdatePin(Request $request)
    {
        User::findOrFail($request->id)->update($request->only('pin'));
    }

    public function apiAllUsers()
    {
        return response()->json(User::all());
    }
}