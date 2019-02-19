@extends("layouts.app")
@section("title","忘记密码")
@section("content")
    <form method="POST" action="{{ route('login.updatePassword') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="email">密码：</label>
            <input type="text" name="password" class="form-control {{$errors->has("password") ? 'is-invalid' : ''}}" value="{{ old('password') }}">
            <input type="hidden" value="{{$model->token}}" name="token">
            @if($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('email') }}</strong>
                            </span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">重置密码</button>
    </form>
@stop
