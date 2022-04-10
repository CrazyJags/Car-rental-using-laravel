@extends('user.layout')
@section('title', 'Login')

@section('user-page')
<div class="form-page mt-5 mb-5">
    <form action="/login" method="post" class="form card card-body  container">
        @csrf
        <div class="h3">Login</div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="" class="form-control" id="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="" class="@error('password') is-invalid @enderror form-control" id="password" required>
        </div>
        <div class="custom-control custom-checkbox mb-3">
            <input type="checkbox" class="custom-control-input" name="remember-me" id="customCheck1">
            <label class="custom-control-label" for="customCheck1">Remember Me</label>
        </div>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        </div>
        <div class="options d-flex align-items-center justify-content-between">
            <a href="/register">No account yet ? Register me</a>
            <a href="/forgot-password">Forgot password ?</a>
        </div>
    </form>
</div>

@endsection
