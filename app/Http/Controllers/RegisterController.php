<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
class RegisterController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index(){
        return view("register.index");
    }

    public function store(UserPost $validate){
        $validate->validated();
        $data = [
            "name" => request()->input("name"),
            "password" => bcrypt(request()->input("password")),
            "email" => request()->input("email")
        ];
        $user = User::create($data);
        $this->sendConfirmEmail($user);
        session()->flash("success","邮件已发送请激活");
        return redirect()->route("root");
    }

    public function sendConfirmEmail($user){
        $view = 'emails.confirm';
        $data = compact('user');
        $from = '15172512038@163.com';
        $name = 'Summer';
        $to = $user->email;
        $subject = "感谢注册 Weibo 应用！请确认你的邮箱。";

        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }
    public function confirmEmail($token){
        $user = User::where('activation_token', $token)->firstOrFail();
        $user->activated = true;
        $user->activation_token = null;
        $user->save();
        Auth::login($user);
        session()->flash('success', '恭喜你，激活成功！');
        return redirect()->route("root");
    }
}
