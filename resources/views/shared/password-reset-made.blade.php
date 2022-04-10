@extends('main')
@section('title', 'Forgot Password')

@section('content')
<div class="forgot d-flex align-items-center justify-content-center" style="width: 100%; height:100%">
    <div style="width: 400px;" class=" col-md-3 alert alert-success">
        <div class="h3">Your password have been reset</div>
        <a href="/login" class="btn ">Login</a>
    </div>
</div>
@endsection
