<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => 'show']);
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $data = $request->all();

        if ($request->avatar) {
            $handler = new ImageUploadHandler();
            $result = $handler->save($request->avatar, 'avatar', $user->id);
            if ($result)  {
                $data['avatar'] = $result['path'];
            } else{
                $data['avatar'] = '';
            }
        }

        // 使用model的fillable，model->update(request->all)，这种更新方式，如果值为空就重置为空了
        // 表单中允许为空的值，客户即可以设置，也可以不设置。
        // 所以我们后端的更新是依赖于前端的，前端如果不传递这个值就设置为空。
        foreach ($data as $key => $value) {
            if (empty($value) && $user->isFillable($key)) {
                $data[$key] = $user->$key;
            }
        }

        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功');
    }
}
