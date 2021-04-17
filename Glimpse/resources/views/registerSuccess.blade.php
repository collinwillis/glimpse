@extends('layouts.appmaster_admin')
@section('title', 'Profile Page')
@section('content')
<h1 align="center">Register Success!</h1>

<?php header( "refresh:3;url=login.blade.php" ); ?>
@endsection