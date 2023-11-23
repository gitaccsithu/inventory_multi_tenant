<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Forbidden</title>
        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body>
        <div>
            YOU ARE NOT AUTHORIZED TO ACCESS THIS RESOURCE.
            <form action="{{ route('get_login_page') }}" method="GET">
                <input type="submit" value="Login with another account">
            </form>
        </div>
    </body>
</html>
