<?php
// Glimpse 1.1 / CLC Milestone 2
// Admin
// Collin Willis and Derek Lundy
// 2/7/21
// This is the main page for admin controls.
use App\Models\UserModel;
use App\Services\Business\SecurityService;
use App\Models\AffinityGroupModel;

?>
@extends('layouts.appmaster_loggedin')
@section('title', 'Profile Page')
@section('content')

<div align="center">

	<div class="border-table" style="float: left; margin-left: 5%; margin-right: 1%; margin-top: 5%; width: 43%; height: 60%;">
		<h3>Affinity Groups</h3>

		<table style="color: white; width: 90%;">
			<tr>
				<th>Group Name</th>
				<th>Group Description</th>
			</tr>
			@if(is_array($affinityGroups))
			@forelse($affinityGroups as $result)
			<tr style="color: white">
				<td>{{$result->getName()}}</td>
				<td>{{$result->getDescription()}}</td>
				<td><a class="linktobutton" href="{!! route('joinAffinityGroup', ['affinityGroupID'=>$result->getAffinityGroupID()]) !!}">Join</a></td>
			</tr>
			@empty
				<h3>No Jobs</h3>
			@endforelse 
			@endif
		</table>
	</div>

	<div class="border-table" style="float: right; margin-right: 5%; margin-left: 1%; margin-top: 5%; width: 43%; height: 60%;">
		<h3>My Affinity Groups</h3>
		
		<table style="color: white; width: 90%;">
			<tr>
				<th>Group Name</th>
				<th>Group Description</th>
			</tr>
			@if(is_array($userAffinityGroups)) 
    			@forelse($userAffinityGroups as $result)
    			<tr style="color: white">
    				<td>{{$result->getName()}}</td>
    				<td>{{$result->getDescription()}}</td>
    				<td><a class="linktobutton" href="{!! route('leaveAffinityGroup', ['affinityGroupID'=>$result->getAffinityGroupID()]) !!}">Leave</a></td>
				</tr>
				@empty
				<h3>No Jobs</h3>
    			@endforelse 
			@endif
		</table>
	</div>

</div>
@endsection
