@extends('layouts.app')
@section('content')
@php
if (Auth::user()->role->name == "admin" || Auth::user()->role->name == "superadmin") {

    echo '<script>window.location = "/admin";</script>';

}

@endphp

<style>
    .mainfooter {
        position: fixed;
        width: 100%;
        bottom: 0;
    }
</style>

    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-success">Your Payment Has been Processed. Thank You!</div>
            </div>
            <div class="col-md-12">
                <a href="/" class="btn btn-info btn-sm">Return Home</a>
            </div>
        </div>
    </div>


@endsection