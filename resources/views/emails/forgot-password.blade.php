@component('mail::message')
# Forgot password

Hello. You are receiving this email because you started the password reset process on our website.
You can use the following code to reset your password during the next 30 minutes.
@component('mail::panel')
    {{ $token }}
@endcomponent
If it was not you, ignore this email.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
