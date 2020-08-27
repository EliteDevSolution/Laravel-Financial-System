@extends('layouts.app')
@section('content')
@php
if (Auth::user()->role->name == "admin") {
echo '<script>window.location = "/admin";</script>';
}
@endphp
<style>
    footer {
        position: absolute;
        bottom: 0px;
        width: 100%;
    }
</style>
<div id="change-password-page">
    
    <div id="profile">
        <div class="container">

            <div class="row">
                <div class="col-md-12 mb-5 mt-5">
                    @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class="user-details mt-5 mb-5">
                        <div class="text-center">
                            
                        </div>
                        <div class="accordion user-pass-change" id="accordionExample">
                            <div class="card">
                                <div class="card-header border-0" id="headingOne">
                                    <h5 class="main-heading mb-0 d-inline-block btn-info p-0 text-white">
                                    <button class="btn btn-link text-white" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Change Password
                                    </button>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        
                                        <form method="POST" action="/user/{{ Auth::user()->id }}">
                                            @csrf
                                            @method('PATCH')
                                            
                                            <div class="form-group row">
                                                <label for="adminPass" class="col-4 col-form-label u-p">Old Password</label>
                                                <div class="col-8">
                                                    <input id="adminPass" required="" name="userPass" placeholder="Old Password" class="form-control here" type="Password">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="newPass" class="col-4 col-form-label u-p">New Password</label>
                                                <div class="col-8">
                                                    <input id="newPass" name="newPass" placeholder="New Password" class="form-control here" required="" type="Password">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-4 col-8">
                                                    <button name="submit" type="submit" class="btn btn-primary adminBtn">Update Password</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
