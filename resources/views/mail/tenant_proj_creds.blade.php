<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Credentials</title>
    <style>
        body{
            font-family: sans-serif
        }
    </style>
</head>
<body>
    <h2>
        Hello! Thanks for using our services. 
    </h2>
    <p>The following are the credentails for your requested project.</p>
    <ul>
        <li>Email: <b>{{ $tenant->user->email }}</b></li>
        <li>Subdomain: <b>{{ $tenant->subdomain }}</b></li>
        <li>Full URL: 
            <a href="http://{{ $tenant->subdomain.'.'.config('app.url') }}" target="_blank" rel="noopener noreferrer">
                {{ $tenant->subdomain.'.'.config('app.url') }}
            </a>
        </li>
        <li>Password: <b>12345678</b></li>
    </ul>
    <p>
        Best wishes,<br>
        Eantory team
    </p>
</body>
</html>