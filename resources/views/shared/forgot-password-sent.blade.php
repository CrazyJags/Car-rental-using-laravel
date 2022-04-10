@extends('main')
@section('title', 'Forgot Password')

@section('content')
<div class="forgot d-flex align-items-center justify-content-center" style="width: 100%; height:100%">
    <div style="width: 400px;" class="alert alert-success col-md-3 ">
        <div class="h3">Email has been sent</div>
        <div class="p">An email with reset your password link has been sent to your mailbox </div>
        <div class="p">The reset token has a lifetime of 30 min</div>
        <div class="p"><a href="/password-reset">Enter the code on this page</a></div>
    </div>
</div>
@endsection
