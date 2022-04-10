@extends('main')
@section('title', 'Forgot Password')

@section('content')
<div class="forgot d-flex align-items-center justify-content-center" style="width: 100%; height:100%">
    <form action="/forgot-password" method="post" style="width: 400px;" class="card card-body col-md-3">
        @csrf
        <div class="h3">Forgot Password</div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
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
        <div class="options d-flex align-items-center justify-content-between">
            <a href="/register">Register</a>
            <a href="/login">I remember my password</a>
        </div>
        <div class="form-group">
            <button class="btn-block btn btn-primary">Send Reset Code</button>
        </div>
    </form>
</div>
@endsection
