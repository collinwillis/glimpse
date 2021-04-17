<?php
// Glimpse 1.1 / CLC Milestone 2
// Admin
// Collin Willis and Derek Lundy
// 2/7/21
// This is the edit User page.
    use App\Services\Business\SecurityService;

    $securityservice = new SecurityService();
    $userToEdit = $securityservice->findByUsername(Session::get('userToEdit'));
?>
@extends('layouts.appmaster_admin')
@section('title', 'Profile Page')
@section('content')
	<div align="center">
		<form action="{{route('onEditUser')}}" method="post">
			{{ csrf_field() }}
			<label for="email">Email:</label> <input type="email"
				id="email" name="email" value="<?php echo $userToEdit->getEmail()?>"> <br>
			<label for="phoneNum">Phone Number:</label> <input type="text"
				id="phoneNum" name="phoneNum" value="<?php echo $userToEdit->getPhoneNum()?>"> <br>
			<br> <label for="gender">Gender:</label> <input type="text" id="gender"
				required name="gender" value="<?php echo $userToEdit->getGender()?>"> <br>
			<br> <label for="country">Country:</label> <input type="text"
				id="country" name="country" value="<?php echo $userToEdit->getCountry()?>"> <br>
							<br> <label for="state">State:</label> <input type="text"
				id="state" name="state" value="<?php echo $userToEdit->getState()?>"> <br>
							<br> <label for="city">City:</label> <input type="text"
				id="city" name="city" value="<?php echo $userToEdit->getCity()?>"> <br>
							<br> <label for="zip">Zip Code:</label> <input type="text"
				id="zip" name="zip" value="<?php echo $userToEdit->getZip()?>"> <br>
			<br> <input class="linktobutton" type="submit" value="Update">
		</form>
		<br/>
		<a class="linktobutton"  href="{!! route('adminUser') !!}" style="display: block; width: 60px; height: auto;">Back</a>
	</div>
@endsection