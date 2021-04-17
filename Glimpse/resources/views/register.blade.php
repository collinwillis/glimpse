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
<h1 align="center" style="color: white;"><b>REGISTER</b></h1>
	<div align="center">
		<form action="{{route('doRegister')}}" method="post">
			{{ csrf_field() }}
			<label for="user_name">Username:</label> <input type="text"
				id="user_name" name="user_name" required> <br>
				<?php echo "<br><div style='color: red;'>" . $errors->first('user_name') . "</div>"?>
			<br> <label for="email">Email:</label> <input type="email" id="email"
				required name="email"> <br>
			<br> <label for="password">Password:</label> <input type="text"
				id="password" name="password" required> <br>
				<?php echo "<br><div style='color: red;'>" . $errors->first('password') . "</div>"?>
			<br> <input type="submit" value="Register">
		</form>
	</div>
@endsection