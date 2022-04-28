@component('mail::message')
# Hi there

Someone has contacted you with this message:
"{{ $message }}"

Maybe, you want to get in touch with them, using this shared email: "{{ $email }}}"

Thanks,<br>
{{ config('app.name') }}
@endcomponent