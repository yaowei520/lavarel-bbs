@extends("layouts.app")
@section("title","忘记密码")
@section("content")
    <form method="POST" action="{{ route('login.sendForgotEmail') }}">
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
        <button type="submit" class="btn btn-primary">重置密码</button>
    </form>
@stop
