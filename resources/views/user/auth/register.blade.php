@extends('user.layout')
@section('title', 'Register')

@section('user-page')
<div class="form-page mt-5 mb-5">
    <form action="/register" method="post" class="form card card-body  container">
        @csrf
        <div class="h3">Register</div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="" class="@error('password') is-invalid @enderror form-control" id="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="" class="@error('password') is-invalid @enderror form-control" id="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="" class="@error('password') is-invalid @enderror form-control" id="password" required>
        </div>
        <div class="form-group">
            <label for="confirm">Confirm Password</label>
            <input type="password" name="password_confirmation" placeholder="" class="@error('password') is-invalid @enderror form-control" id="confirm" required>
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
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </div>
        <div class="options d-flex align-items-center justify-content-between">
            <a href="/login">Already have an account ? Login</a>
        </div>
    </form>
</div>

@endsection
