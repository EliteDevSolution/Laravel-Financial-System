@extends('layouts.app')
@section('content')
@php
    if (Auth::user()->role->name == "admin") {
        echo '<script>window.location = "/admin";</script>';
    }
@endphp

<div id="profile-page">
    
    <div id="profile">
        <div class="container">
            <div class="row text-center">
                <h1 class="d-inline-block mt-5 text-capitalize main-heading">Your contracts</h1>
            </div>
            {{-- <div class="row">
                <object data="{{ asset('storage/invoices/17V7XELxFnXXnRpGdan560ZkJDsAShuvbFTuV9Zn.pdf') }}" type=”application/pdf” width=”100%” height=”100%”>
            </div> --}}
            <div class="row">
                <div class="col-md-12 mb-5">
                    
                    <div class="user-details mt-5 mb-5">
                        <table id="user-contract" class="display border p-2">
                            <thead>
                                <tr>
                                    <th>Contract#</th>
                                    <th>Policy#</th>
                                    <th>View/Download</th>
                                    <th>Status</th>
                                    <th>Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contracts as $contract)
                                    <tr>
                                        <td>0{{ $contract->id }}</td>
                                        <td>{{ $user->policy_number }}</td>
                                        <td>
                                            <a href="https://docs.google.com/viewerng/viewer?url={{ asset('storage/'.$contract->contract.'') }}&embedded=true" type="application/pdf" target="_blank">
                                                Contract
                                            </a>
                                        </td>
                                        <td>
                                            @if ($contract->signed == 0)
                                                Not Signed,<a href="{{route('signContract', $contract->id)}}" class="btn btn-info">Sign Now</a>
                                            @else
                                                <button class="btn disabled btn-success">
                                                    ✓
                                                </button>
                                            @endif
                                        </td>
                                        <td>
                                            {{ date('d-m-Y', strtotime($contract->updated_at)) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            
        </div>
    </div>

</div>

@endsection