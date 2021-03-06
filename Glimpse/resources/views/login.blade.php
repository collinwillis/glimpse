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

<h1 align="center" style="color: white;"><b>LOGIN</b></h1>
	<div class="center">
		<img alt="Glimpse" src="images/logo.png" height="60px"><br><br>
		<form action="{{route('doLogin')}}" method="post">
		{{ csrf_field() }}
			<label for="username">Username:</label> <input type="text"
				id="user_name" name="user_name" required> <br>
				<?php echo "<br><div style='color: red;'>" . $errors->first('user_name') . "</div>"?>
			<br> <label for="username">Password:</label> <input type="text"
				id="password" name="password" required> <br>
				<?php echo "<br><div style='color: red;'>" . $errors->first('password') . "</div>"?>
			<br> <input type="submit" value="Login">
		</form>
		
		@if (Session::get('login') === false)
			<p style="color: red;">Login Failed!</p>	
		@endif
		
		@if (Session::get('suspended') === true)
			<p style="color: red;">User Suspended!</p>	
		@endif
	</div>

</body>
@endsection