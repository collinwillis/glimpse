<?php 
// Glimpse 1.1 / CLC Milestone 2
// Profile
// Collin Willis and Derek Lundy
// 2/7/21
// This is the user profile page.

    use App\Services\Business\SecurityService;

    $securityservice = new SecurityService();
    $currentUser = $securityservice->findByUsername(Session::get('currentUser'));
?>
@extends('layouts.appmaster_loggedin')
@section('title', 'Profile Page')
@section('content')
	<div align="center">
		<form action="{{route('updateProfile')}}" method="post">
			{{ csrf_field() }}
			<label for="email">Email:</label> <input type="email"
				id="email" name="email" value="<?php echo $currentUser->getEmail()?>"> <br>
			<label for="phoneNum">Phone Number:</label> <input type="text"
				id="phoneNum" name="phoneNum" value="<?php echo $currentUser->getPhoneNum()?>"> <br>
			<br> <label for="gender">Gender:</label> <input type="text" id="gender"
				required name="gender" value="<?php echo $currentUser->getGender()?>"> <br>
			<br> <label for="country">Country:</label> <input type="text"
				id="country" name="country" value="<?php echo $currentUser->getCountry()?>"> <br>
							<br> <label for="state">State:</label> <input type="text"
				id="state" name="state" value="<?php echo $currentUser->getState()?>"> <br>
							<br> <label for="city">City:</label> <input type="text"
				id="city" name="city" value="<?php echo $currentUser->getCity()?>"> <br>
							<br> <label for="zip">Zip Code:</label> <input type="text"
				id="zip" name="zip" value="<?php echo $currentUser->getZip()?>"> <br>
			<br> <input type="submit" value="Update">
		</form>
	</div>
@endsection