<?php
// Glimpse 1.1 / CLC Milestone 2
// Admin
// Collin Willis and Derek Lundy
// 2/7/21
// This is the main page for admin controls.

use App\Models\UserModel;
use App\Services\Business\SecurityService;
?>
@extends('layouts.appmaster_admin')
@section('title', 'Profile Page')
@section('content')


<div align="center">


    <table style="color: white" width="90%">
        <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Password</th>
        <th>Gender</th>
        <th>Country</th>
        <th>State</th>
        <th>City</th>
        <th>Zip</th>
        <th>Phone</th>
        <th></th>
        <th></th>
        <th></th>
        </tr>
        

			@foreach($users as $result)
				<tr style="color: white">
				 	<td>{{$result->getUsername()}}</td>
                	<td>{{$result->getPassword()}}</td>
                	<td>{{$result->getEmail()}}</td>
               		<td>{{$result->getGender()}}</td>
               		<td>{{$result->getCountry()}}</td>
                	<td>{{$result->getState()}}</td>
               		<td>{{$result->getCity()}}</td>
                 	<td>{{$result->getZip()}}</td>
               		 <td>{{$result->getPhoneNum()}}</td>
                	@if(Session::get('currentUser') == $result->getUsername())

                	 @else
                	@if($result->getRole() == -1)
                			<td><a href="{!! route('unsuspendUser', ['username'=>$result->getUsername()]) !!}" style="color: red">Unsuspend</a></td>
                	 		<td><a href="{!! route('editUser', ['username'=>$result->getUsername()]) !!}">Edit</a></td>
                	 		<td><a href="{!! route('deleteUser', ['username'=>$result->getUsername()]) !!}">Delete</a></td>
                		@else
                			<td><a href="{!! route('suspendUser', ['username'=>$result->getUsername()]) !!}"  style="color: lightgreen">Suspend</a></td>
                	 		<td><a href="{!! route('editUser', ['username'=>$result->getUsername()]) !!}">Edit</a></td>
                			<td><a href="{!! route('deleteUser', ['username'=>$result->getUsername()]) !!}">Delete</a></td>
                	 	@endif
                	 @endif


                 </tr>
			@endforeach
    </table>
</div>
@endsection