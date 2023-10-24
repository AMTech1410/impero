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
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif
        <div class="">
            <h1>Business: Create</h1>
        </div>
        <form method="post" action="{{ route('business.store') }}" name="businessForm" enctype="multipart/form-data">
            <!-- CROSS Site Request Forgery Protection -->
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" class="form-control" name="phone" id="phone">
            </div>
            <div class="form-group">
                <label>Logo</label>
                <input type="file" class="form-control" name="logo" id="logo">
            </div>
            <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
        </form>
    </div>
</body>
</html>
@endsection
@section('styles')
<style>
	.card{
		align-items: center;
    width: 50%;
    margin: auto;
	}
</style>
@endsection