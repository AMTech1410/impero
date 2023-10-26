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
                <h1>BranchDetail: View</h1>

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
                            <a class="nav-link" href="{{ route('branch') }}">Branch</a>
                        </li>

                    </ul>
                </div>
            </nav>

            Branch Name : @if ($branch)
                <h3>{{ $branch->name }}</h3>
            @endif
            Business Name: @php
                $business = $branch->business ? $branch->business : [];
                echo $business['name'];
            @endphp

            @php

                $branchTime = $branch->branchtime ? $branch->branchtime : [];
                $branchImage = $branch->branchtime ? $branch->branchimage : [];

                // echo "<pre>";print_r($branchTime);

            @endphp

            <ul class="list-group">

                @if (count($branchTime))
                    @foreach ($branchTime as $key => $value)
                        @php
                            $begin = new DateTime($value->startDate);
                            $end = new DateTime($value->endDate);

                            $interval = DateInterval::createFromDateString('1 day');
                            $period = new DatePeriod($begin, $interval, $end);

                        @endphp
                        @foreach ($period as $dt)
                            <li class="list-group-item">
                                @php
                                echo "<label><h5>"; echo $dt->format("l Y-m-d\n");  echo "</h5></label>";
                                @endphp
                                @if($value->closed))
                                 @php echo "Closed";  @endphp
                                @else 
                                    @php echo $value->startTime;
                                echo ' - ';
                                echo $value->endTime;  @endphp
                                @endif
                               
                           </li>
                        @endforeach
                    @endforeach
                @endif

                @if (count($branchImage))
                    @foreach ($branchImage as $key => $value)
                        <li class="list-group-item">Image : <img
                                src="{{ URL::to('/') }}/public/uploads/{{ $value->image }}"
                                style="height: 10%;width:10%; !important" /></th>
                        </li>
                    @endforeach
                @endif

            </ul>

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
