<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\models\password_reset;
class LoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['index',"forgotPassword"]
        ]);
    }

    public function destroy(User $user){
        Auth::logout($user);
        return redirect()->route("root");
   }
   public function index(){
       return view("login.index");
   }
   public function store(Request $request){
       $request->validate([
           'email' => 'required|email|max:255',
           'password' => 'required|min:6'
       ]);
       $data = [
           "password" => $request->password,
           "email" => $request->email
       ];
       if(Auth::attempt($data)){
           if(!Auth::user()->activated){
               Auth::logout();
               session()->flash("info","请激活邮件");
               return redirect()->back()->withInput();
           }else{
               session()->flash("info","欢迎回来");
               return redirect()->intended("/");
           }
       }else{
           session()->flash("warning","登录失败");
           return redirect()->back()->withInput();
       }
   }

   public function forgotPassword(){
        return view("login.forgotPassword");
   }
   public function sendForgotEmail(Request $request,password_reset $reset){
       $email = $request->input("email");
       $user = User::where('email', $email)->firstOrFail();
       $model = password_reset::where('email', $email)->first();
       if($model){
           $model->token = str_random(30);
           $model->save();
       }else{
           $model = password_reset::create([
               "email" => $email,
               "token" => str_random(30)
           ]);
       }

       $view = 'emails.forgot';
       $data = compact('model');
       $from = '15172512038@163.com';
       $name = 'Summer';
       $to = $user->email;
       $subject = "感谢注册 Weibo 应用！请确认你的邮箱。";

       Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
           $message->from($from, $name)->to($to)->subject($subject);
       });
       session()->flash('success', '邮件已发送成功 ');
       return redirect()->route("login.index");
   }
   public function resetEmail($token){

       $model = password_reset::where('token', $token)->firstOrFail();
       return view("login.reset",compact("model"));
   }
   public function updatePassword(){
       $password = \request()->input("password");
       $token = \request()->input("token");
       $model = password_reset::where('token', $token)->firstOrFail();
       $email = $model->email;
       $user = User::where("email",$email)->first();
       $user->password = bcrypt($password);
       $user->save();
       Auth::login($user);
       session()->flash("succsee","密码更新成功");
       return redirect()->route("root");
   }
}
