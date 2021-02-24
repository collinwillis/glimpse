<?php
// Glimpse 1.2 / CLC Milestone 3
// Admin
// Collin Willis and Derek Lundy
// 2/7/21
// This is the main page for viewing Jobs.

use App\Models\JobModel;
use App\Services\Business\SecurityService;

?>
@extends('layouts.appmaster_admin')
@section('title', 'Job Postings Page')
@section('content')

<div align="center">
    
@foreach ($jobs as $job)
	<div style="text-align: left; border: solid black 3px; border-radius: 20px; width: 70%; color: white; padding: 10px; background-color: grey;">
		<h3>{{$job->getTitle()}}</h3>
		<h4>For: {{$job->getCompany()}}</h4>
		<br>
		<h3><b>Description</b></h3>
		<p>{{$job->getDescription()}}</p>
		<h3>Requirements</h3>
		<p>{{$job->getRequirements()}}</p>
	</div>
	<br>
@endforeach

</div>
@endsection