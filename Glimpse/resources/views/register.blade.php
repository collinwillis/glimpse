<?php 
// Glimpse 1.1 / CLC Milestone 2
// Register
// Collin Willis and Derek Lundy
// 2/7/21
// This is the register page.

?>
@extends('layouts.appmaster')
@section('title', 'Login Page')
@section('content')
	<div align="center">
		<form action="{{route('doRegister')}}" method="post">
			{{ csrf_field() }}
			<label for="user_name">Username:</label> <input type="text"
				id="user_name" name="user_name" required> <br>
			<br> <label for="email">Email:</label> <input type="text" id="email"
				required name="email"> <br>
			<br> <label for="password">Password:</label> <input type="text"
				id="password" name="password" required> <br>
			<br> <input type="submit" value="Register">
		</form>
	</div>
@endsection