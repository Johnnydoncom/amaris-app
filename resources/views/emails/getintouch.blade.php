@component('mail::message')
# {{$data['subject']}}

<strong>Name:</strong> {{$data['name']}}<br>
<strong>Email:</strong> {{$data['email']}}<br>
<strong>Phone:</strong> {{$data['phone']}}<br>

<strong>Message:</strong><br>
{{$data['message']}}

<br>
<strong>Page URL:</strong> {{$data['page_url']}}

@component('mail::button', ['url' => $data['page_url']])
View Page
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
