@extends('layouts.app')
@section('title', '登录')

@section('content')
    <div class="offset-md-2 col-md-8">
        <div class="card ">
            <div class="card-header">
                <h5>登录</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login.store') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="email">邮箱：</label>
                        <input type="text" name="email" class="form-control {{$errors->has("email") ? 'is-invalid' : ''}}" value="{{ old('email') }}">
                        @if($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password">密码（<a href="{{route("login.forgotPassword")}}">忘记密码</a>）：</label>
                        <input type="password" name="password" class="form-control  {{$errors->has("password") ? 'is-invalid' : ''}}" value="{{ old('password') }}">
                        @if($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="remember" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">记住我</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">登录</button>
                </form>

                <hr>

                <p>还没账号？<a href="{{ route('register.index') }}">现在注册！</a></p>
            </div>
        </div>
    </div>
@stop
