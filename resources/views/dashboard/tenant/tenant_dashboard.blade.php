@extends('layout')

@section("content")

<form action="{{ route('logout_user') }}" method="POST">
    @csrf
    <input type="submit" value="Logout">
</form>

<h1>
    This is home page of {{ Auth::user()->email }} tenant
</h1>

@endsection