@extends('layouts.adminNav')
@section('content')
@php
    if (Auth::user()->role->name == "admin") {
        echo '<script>window.location = "/admin";</script>';
    }
@endphp

<h3>Admin Panel</h3>

@endsection