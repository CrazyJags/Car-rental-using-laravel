@extends('main')
@section('title', 'Admin Login')

@section('content')
<div class="login">
    <form class="form shadow p-3 mb-5 bg-white rounded" action="/admin/login" method="POST">
        @csrf
        <div class="h4">Login</div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="@error('email') is-invalid @enderror form-control" required name="email" id="email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="@error('password') is-invalid @enderror form-control" name="password" minlength="6" required id="password">
            @error('error')
            <p class="text-danger mt-1 text-center error">{{$errors->first('error')}}</p>
            @enderror
        </div>
        <div class="custom-control custom-checkbox mb-3">
            <input type="checkbox" class="custom-control-input" name="remember-me" id="customCheck1">
            <label class="custom-control-label" for="customCheck1">Remember Me</label>
        </div>
        <button class="btn btn-primary btn-block" type="submit">Login</button>
    </form>
</div>
@endsection
