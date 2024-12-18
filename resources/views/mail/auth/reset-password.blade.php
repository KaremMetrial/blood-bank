<x-mail::message>
# Password Reset Request

Dear {{ $client->name }},

You've requested to reset your password for your Blood Bank account. Use the verification code below to complete the process:

<x-mail::panel>
<h1 style="text-align: center; font-size: 32px; color: #e53e3e;">{{ $client->pin_code }}</h1>
</x-mail::panel>



If you didn't request this password reset, please ignore this email or contact our support team.

Best regards,<br>
{{ config('app.name') }} Team

</x-mail::message>
