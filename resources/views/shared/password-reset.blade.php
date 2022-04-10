@extends('main')
@section('title', 'Forgot Password')

@section('content')
<div class="forgot d-flex align-items-center justify-content-center" style="width: 100%; height:100%">
    <form action="/password-reset" method="post" style="width: 400px;" class="card card-body col-md-3">
        @csrf
        <div class="h3">Password reset</div>
        <div class="form-group">
            <label for="email">Token</label>
            <input type="text" name="code" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="password_confirmation" id="confirm_password" class="form-control" required>
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
            <button class="btn-block btn btn-primary">Reset password</button>
        </div>
    </form>
</div>
@endsection
