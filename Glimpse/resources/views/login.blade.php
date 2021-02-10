<?php 
// Glimpse 1.1 / CLC Milestone 2
// Login
// Collin Willis and Derek Lundy
// 2/7/21
// This is the login page.
?>

@extends('layouts.appmaster')
@section('title', 'Login Page')
@section('content')
	<div align="center">
		<form action="{{route('doLogin')}}" method="post">
		{{ csrf_field() }}
			<label for="username">Username:</label> <input type="text"
				id="user_name" name="user_name" required> <br>
			<br> <label for="username">Password:</label> <input type="text"
				id="password" name="password" required> <br>
			<br> <input type="submit" value="Login">
		</form>
	</div>
</body>
@endsection