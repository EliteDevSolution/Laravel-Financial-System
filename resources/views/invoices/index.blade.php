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
                <h1 class="d-inline-block mt-5 text-capitalize main-heading">Your Invoices</h1>
            </div>
            <div class="row">
                <div class="col-md-12 mb-5">
                    
                    <div class="user-details mt-5 mb-5">
                        <table id="user-invoice" class="display border p-2">
                            <thead>
                                <tr>
                                    <th>Invoice#</th>
                                    <th>Policy#</th>
                                    <th>View/Download</th>
                                    <th>Status</th>
                                    <th>Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>0{{ $invoice->id }}</td>
                                        <td>{{ $user->policy_number }}</td>
                                        <td>
                                            <a href="{{ asset('storage/'.$invoice->invoice.'') }}" target="_blank">
                                                Invoice
                                            </a>
                                        </td>
                                        <td>
                                            <button class="btn {{ $invoice->paid == 0 ? 'btn-outline-danger' : 'btn-outline-success' }}">
                                                {{ $invoice->paid == 0 ? 'UnPaid' : 'Paid' }}
                                            </button>
                                        </td>
                                        <td>
                                            {{ date('d-m-Y', strtotime($invoice->updated_at)) }}
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