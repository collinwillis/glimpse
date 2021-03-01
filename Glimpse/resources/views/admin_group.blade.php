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
@extends('layouts.appmaster_admin')
@section('title', 'Admin Group Controls')
@section('content')

<div align="center">

	<div class="border-table">
		<h3>Affinity Groups</h3>

		<input type="button" id="addGroupButton" onclick="showAddGroupForm()" value="Add Group">

		<div class="form-container" id="addGroupForm" style="display: none">
			<form class="floating-form" action="{{route('onAddAffinityGroup')}}" method="post">
				{{ csrf_field() }} 
				<label for="groupName">Group Name</label> 
				<input type="text" name="groupName" id="groupName" placeholder="Group Name"><br>
				<label for="groupDescription">Group Description</label>
				<input type="text" name="groupDescription" id="groupDescription" placeholder="Group Description"><br> 
				<br>
				<input type="submit" value="Add Group">
			</form>
			<input type="button" onclick="hideAddGroupForm()" value="Cancel">
		</div>
		
		
		<table style="color: white; width: 90%;">
			<tr>
				<th>Group Name</th>
				<th>Group Description</th>
				<th> </th>
			</tr>
			@if(is_array($affinityGroups))
			@forelse($affinityGroups as $result)
			<tr style="color: white">
				<td>{{$result->getName()}}</td>
				<td>{{$result->getDescription()}}</td>
				<td style="width: 2%;"><a class="linktobutton" href="{!! route('onDeleteAffinityGroup', ['affinityGroupID'=>$result->getAffinityGroupID()]) !!}">Delete</a></td>
			</tr>
			@empty
				<h3>No Groups</h3>
			@endforelse 
			@endif
		</table>
	</div>

</div>
<script>
	function showAddGroupForm() {
      var x = document.getElementById("addGroupForm");
      var y = document.getElementById("addGroupButton");
      if (x.style.display === "none") {
        x.style.display = "block";
        y.style.display = "none"
      }
    }
    
    function hideAddGroupForm() {
        var x = document.getElementById("addGroupForm");
        var y = document.getElementById("addGroupButton");
        if (x.style.display === "block") {
        x.style.display = "none";
        y.style.display = "block"
        }
    }
</script>
@endsection
