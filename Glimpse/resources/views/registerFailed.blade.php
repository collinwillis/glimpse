<?php 
// Glimpse 1.1 / CLC Milestone 2
// Register
// Collin Willis and Derek Lundy
// 2/7/21
// This is the register failed page.

?>
@extends('layouts.appmaster')
@section('title', 'Login Page')
@section('content')
<h1 align="center">Register Failed!</h1>

<?php header( "refresh:3;url=login.blade.php" ); ?>
@endsection