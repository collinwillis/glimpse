<?php 
// Glimpse 1.1 / CLC Milestone 2
// Login
// Collin Willis and Derek Lundy
// 2/7/21
// This is the login page.
?>

@extends('layouts.appmaster_loggedin')
@section('title', 'Login Page')
@section('content')

	<h1 align="center" style="color: white;"><b>Job Details</b></h1>
<div style="color: white; background-color: grey; border: solid 2px black; width: 85%; border-radius: 20px">
	<h1>{{$job->getCompany()}}</h1>
	<h3>{{$job->getTitle()}}</h3>
		<p>{{$job->getDescription()}}</p>
		</br>
	<h3>Requirements</h3>
		<p>{{$job->getRequirements()}}</p>
		@if(!$hasApplied)
		<a class="linktobutton"  href="{!! route('applyJob', ['jobID'=>$job->getJobID()]) !!}" style="display: inline-block;">Apply</a>
		@else
		<button style="display: inline-block; background-color: #85c385; border-radius: 7px; color: #383838; font-size: large;" disabled>Applied!</button>
		@endif
		</br></br>
		<a class="linktobutton"  href="{!! route('jobs') !!}" style="display: block; width: 60px; height: auto;">Back</a>
		</br></br>
</div>


@endsection