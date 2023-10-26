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
            <form method="post" action="{{ route('branch.store') }}" name="branchForm" enctype="multipart/form-data">
                <!-- CROSS Site Request Forgery Protection -->
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" id="name">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
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
                    @error('business')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror


                </div>

                <div class="form-group">
                    <label>Start Date - End Date</label>
                    {{-- <input type="date" class="form-control" name="startDate[]" id="startDate"> --}}
                    <input type="text" class="form-control" name="datefilter" id="datefilter" value="" />
                    <input type="hidden" class="date start" name="startDate" id="startDate" />
                    <input type="hidden" class="date start" name="endDate" id="endDate" />

                    @error('datefilter')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <ul class="form-group" id="calenderDateRange">

                </ul>


                OR

                <div class="form-group">
                    <input type="checkbox" name="closed" id="closed" value="closed" /> Closed
                </div>

                <div class="form-group">
                    <label>Images</label>
                    <input type="file" class="form-control" name="bimage[]" id="bimage" multiple="multiple">
                </div>
                <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
            </form>
        </div>
        <script type="text/javascript">
            $(function() {

                // $('input[name="datefilter"]').daterangepicker({
                //     autoUpdateInput: false,
                //     minDate:new Date(),
                //     locale: {
                //         cancelLabel: 'Clear'
                //     }
                // });


                let startDateArray = [];
                let endDateArray = [];
                /* $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {

                     startDateArray.push(picker.startDate.format('YYYY-MM-DD'));
                     endDateArray.push(picker.endDate.format('YYYY-MM-DD'));

                     var calenderHtml =  $("#calenderDateRange").text();
                     var div = document.getElementById('calenderDateRange');


                     $("#startDate").val(startDateArray.join());
                     $("#endDate").val(endDateArray.join());

                     div.innerHTML +="<li>Date Range - : " +  picker.startDate.format('YYYY-MM-DD') + "</label><label>  -  "+picker.endDate.format(
                         'YYYY-MM-DD')+"</label> <input type='button' value='Remove' onClick='$(this).parent().remove()' /></li>";

                     $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                         'YYYY-MM-DD'));
                         
                 });*/


                $('input[name="datefilter"]').daterangepicker({
                    timePicker: true,
                    minDate: new Date(),
                    startDate: moment().startOf('hour'),
                    endDate: moment().startOf('hour').add(32, 'hour'),
                    locale: {
                        format: 'M/DD/Y hh:mm A'
                    }
                });


                $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {

                    startDateArray.push(picker.startDate.format('YYYY-MM-DD hh:mm A'));
                    endDateArray.push(picker.endDate.format('YYYY-MM-DD hh:mm A'));

                    var calenderHtml = $("#calenderDateRange").text();
                    var div = document.getElementById('calenderDateRange');


                    $("#startDate").val(startDateArray.join());
                    $("#endDate").val(endDateArray.join());

                    div.innerHTML += "<li>Date Range - : " + picker.startDate.format('YYYY-MM-DD hh:mm A') +
                        "</label><label>  -  " + picker.endDate.format(
                            'YYYY-MM-DD hh:mm A') +
                        "</label> <input type='button' value='Remove' onClick='$(this).parent().remove()' /></li>";

                    $(this).val(picker.startDate.format('YYYY-MM-DD hh:mm A') + ' - ' + picker.endDate.format(
                        'YYYY-MM-DD hh:mm A'));

                });




                $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');

                    $("#startDate").val('');
                    $("#endDate").val('');
                });


                function removefn(obj) {
                    $(obj).remove();
                }
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
