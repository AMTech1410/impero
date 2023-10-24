@extends('layout')
@section('content')
    </style>
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    </head>

    <body>
        <div class="container mt-5">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="">
                <h1>Branch: View</h1>

            </div>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        {{-- <li class="nav-item active">
                  <a class="nav-link" href="{{ route('business') }}">Home <span class="sr-only">(current)</span></a>
                </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('business') }}">Business</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('branch.form') }}">Branch</a>
                        </li>

                    </ul>
                </div>
            </nav>

            <div class="table-responsive">
                <table class="table table-striped table-hover table-condensed">
                    <thead>
                        <tr>
                            <th><strong>No</strong></th>
                            <th><strong>Branch</strong></th>
                            <th><strong>Business Name</strong></th>
                            {{-- <th><strong>Phone</strong></th>
                  <th><strong>Logo</strong></th> --}}

                            <th><strong>Action</strong></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($branch as $key => $value)
                            <tr>
                                <th>{{ $value->id }}</th>
                                <th>{{ $value->name }}</th>
                                <th>
                                    @php
                                        $business = $value->business ? $value->business : [];
                                    @endphp


                                    {{ $business['name'] }}

                                </th>


                                <th>
                                    <a href="{{ route('branch.view', [$value->id]) }}">View</a> |
                                    <a href="{{ route('branch.delete', [$value->id]) }}">Delete</a>
                                </th>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </body>

    </html>
@endsection
@section('styles')
    <style>
        .card {
            align-items: center;
            width: 50%;
            margin: auto;
        }
    </style>
@endsection
