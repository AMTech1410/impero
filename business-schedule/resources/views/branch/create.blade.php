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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js">
        </script>
        {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="Stylesheet" type="text/css" /> --}}
    </head>

    <body>
        <div class="container mt-5">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="">
                <h1>Branch: Create</h1>
            </div>
            <form method="post" action="{{ route('branch.store') }}" name="branchForm" enctype="multipart/form-data">
                <!-- CROSS Site Request Forgery Protection -->
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>

                <div class="form-group">
                    <label>Business</label>
                    @if (count($business))
                        <select name="business" id="business" class="form-control">
                            @foreach ($business as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
                <div class="form-group">
                    <label>WeekDay</label>
                    @if (count($weekDay))
                        <select name="weekday" id="weekday" class="form-control">
                            @foreach ($weekDay as $key => $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
                <div class="form-group">
                    <label>Start Time</label>
                    <input type="date" class="form-control" name="startDate[]" id="startDate">
                </div>
                <div class="form-group">
                    <label>End Time</label>
                    <input type="date" class="form-control" name="endDate[]" id="endDate">
                </div>

                <div class="form-group">
                    <label>Images</label>
                    <input type="file" class="form-control" name="bimage[]" id="bimage" multiple="multiple">
                </div>
                <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
            </form>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#startDate').datepicker({
                    format: 'dd/mm/yyyy',
                    multidate: true
                });
            });
        </script>
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
