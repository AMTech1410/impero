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

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

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
            <form method="post" action="{{ route('branch.update') }}" name="branchForm" enctype="multipart/form-data">
                <!-- CROSS Site Request Forgery Protection -->
                @csrf
                <input type="hidden" name="branchId" id="branchId" value="{{ $branch->id }}" />
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $branch->name }}" / >
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>

                <div class="form-group">
                    <label>Business</label>
                    @if (count($business))
                        <select name="business" id="business" class="form-control">
                             @foreach ($business as $key => $value)
                                <option value="{{ $value->id }}" @if($value->id == $branch->business_id) selected="selected" @endif>{{ $value->name }}</option>
                            @endforeach
                        </select>
                    @endif
                    @error('business')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                   
                </div>

                <div class="form-group">
                    <label>Start Date - End Date</label>
                    @php
                        $branchTime = $branch->branchtime ? $branch->branchtime : [];
                        //echo "<pre>";print_r( $branchTime);exit;

                        $startDate = date('m/d/y',strtotime($branchTime[0]->startDate));
                        $endDate = date('m/d/y',strtotime($branchTime[0]->endDate));
                    @endphp
                    <input type="text" class="form-control" name="datefilter" id="datefilter" value="{{ $startDate }} - {{$endDate}}" />
                    <input type="hidden" class="date start" name="startDate" id="startDate" value="{{ $branchTime[0]->startDate }}" />
                    <input type="hidden" class="date start" name="endDate" id="endDate" value="{{ $branchTime[0]->endDate }}" />

                    @error('datefilter')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>


                <p id="datepairExample" class="form-group">
                    <label>Start Time - End Time</label>

                    <input type="text" class="timepicker" name="startTime" id="startTime" value="{{ $branchTime[0]->startTime }}" /> to
                    <input type="text" class="timepicker" name="endTime" id="endTime" value="{{ $branchTime[0]->endTime }}"/>

                </p>

                OR
                <div class="form-group">
                    <input type="checkbox" name="closed" id="closed" value="closed" /> Closed
                </div>

                <div class="form-group">
                    <label>Images</label>
                    <input type="file" class="form-control" name="bimage[]" id="bimage" multiple="multiple">
                </div>

                <div class="form-group">
                    @php
                        $branchImage = $branch->branchtime ? $branch->branchimage : [];
                        $imgArray = [];
                    @endphp
                        @if (count($branchImage))
                            @foreach ($branchImage as $key => $value)
                            <li class="list-group-item">Image : <img
                                    src="{{ URL::to('/') }}/public/uploads/{{ $value->image }}"
                                    style="height: 10%;width:10%; !important" /></th>
                            </li>
                            @php
                                $imgArray[]=$value->image ;
                            @endphp
                            @endforeach

                            
                        @endif
                        <input type="hidden" name="oldImg[]" id="oldImg" value={{ implode(",",$imgArray) }}  />

                </div>
                <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
            </form>
        </div>
        <script type="text/javascript">
            

            $(function() {

                $('input[name="datefilter"]').daterangepicker({
                    autoUpdateInput: false,
                    locale: {
                        cancelLabel: 'Clear'
                    }
                });

                $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {

                    $("#startDate").val(picker.startDate.format('YYYY-MM-DD'));
                    $("#endDate").val(picker.endDate.format('YYYY-MM-DD'));
                    $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                        'YYYY-MM-DD'));
                });

                $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');

                    $("#startDate").val('');
                    $("#endDate").val('');
                });


                $('#startTime').timepicker({
                    timeFormat: 'h:mm p',
                    interval: 60,
                    minTime: '10',
                    maxTime: '6:00pm',
                    defaultTime: '11',
                    startTime: '10:00',
                    dynamic: false,
                    dropdown: true,
                    scrollbar: true
                });

                $('#endTime').timepicker({
                    timeFormat: 'h:mm p',
                    interval: 60,
                    minTime: '10',
                    maxTime: '6:00pm',
                    defaultTime: '11',
                    startTime: '10:00',
                    dynamic: false,
                    dropdown: true,
                    scrollbar: true
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
