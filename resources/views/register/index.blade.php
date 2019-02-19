@extends('layouts.app')
@section('title', '注册')
@section('content')
    <div class="offset-md-2 col-md-8">
        <div class="card ">
            <div class="card-header">
                <h5>注册</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('register.store') }}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="name">名称：</label>
                        <input type="text" name="name" class="form-control {{$errors->has('name') ? 'name' : ''}}" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email">邮箱：</label>
                        <input type="text" name="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" value="{{ old('email') }}">
                        @if($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password">密码：</label>
                        <input type="password" name="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}"  value="{{ old('password') }}">
                        @if($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">确认密码：</label>
                        <input type="password" name="password_confirmation" class="form-control {{$errors->has('password_confirmation') ? 'is-invalid' : ''}}" value="{{ old('password_confirmation') }}">
                        @if($errors->has('password_confirmation'))
                            <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="captcha" class="col-md-4 col-form-label text-md-right">验证码</label>

                        <div class="col-md-6">
                            <input id="captcha" class="form-control{{ $errors->has('captcha') ? ' is-invalid' : '' }}"
                                   name="captcha" required>

                            <img class="thumbnail captcha mt-3 mb-2" src="{{ captcha_src('flat') }}"
                                 onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">

                            @if ($errors->has('captcha'))
                                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('captcha') }}</strong>
                  </span>
                            @endif
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">注册</button>
                </form>
            </div>
        </div>
    </div>
@stop
