<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;
class UsersController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }


    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $userRequest,User $user,ImageUploadHandler $uploader){
        $data =  $userRequest->validated();
        if ($userRequest->avatar) {
            $result = $uploader->save($userRequest->avatar, 'avatars', $user->id,416);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }
       $user->update($data);
       session()->flash("success","更新成功");
       return redirect()->route("users.show",[$user]);
    }
}
