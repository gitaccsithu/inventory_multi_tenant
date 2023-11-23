@extends('layout')

@section("content")

<h1>
    This is home page of {{ Auth::user()->email }} admin
</h1>

@endsection