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

<input type="button" class="crudbutton" id="addJobPostingButton" onclick="showAddJobPostingForm()" value="Add Job"><br><br>
			
    <div class="form-container" id="addJobPostingForm" style="display: none">
        <form class="floating-form" action="{{route('onAddJobPosting')}}" method="post">
        	{{ csrf_field() }} 
        	<label for="title">Title</label>
        	<input type="text" name="title" id="title" placeholder="title"><br>
        	<label for="company">Company</label>
        	<input type="text" name="company" id="company" placeholder="company"><br>
        	<label for="description">Description</label>
        	<input type="text" name="description" id="description" placeholder="description"><br>
        	<label for="requirements">Requirements</label>
        	<input type="text" name="requirements" id="requirements" placeholder="requirements"><br>
        	<br> <input type="submit" value="Add Job">
        </form>
    	<input type="button" onclick="hideAddJobPostingForm()" value="Cancel">
    </div>
    
    <div class="form-container" id="editJobPostingForm" style="display: none">
			<form class="floating-form" action="{{route('onEditJobPosting')}}" method="post">
				{{ csrf_field() }} 
				<input type="hidden" name="editJobID" id="editJobID"><br>
				<label for="editTitle">Title</label>
            	<input type="text" name="editTitle" id="editTitle" placeholder="title"><br>
            	<label for="editCompany">Company</label>
            	<input type="text" name="editCompany" id="editCompany" placeholder="company"><br>
            	<label for="editDescription">Description</label>
            	<input type="text" name="editDescription" id="editDescription" placeholder="description"><br>
            	<label for="editRequirements">Requirements</label>
            	<input type="text" name="editRequirements" id="editRequirements" placeholder="requirements"><br>
        		<br>
        		<input type="submit" value="Edit Job">
			</form>
			<input type="button" onclick="hideEditJobPostingForm()" value="Cancel">
		</div>
    @if(is_array($jobs)) 
		@forelse ($jobs as $job)
	<div style="text-align: left; border: solid black 3px; border-radius: 20px; width: 70%; color: white; padding: 10px; background-color: grey;">
		<div style="float: right; display: inline-block;">
			<button class="crudbutton" style="display: inline-block;" onclick="showEditJobPostingForm('{{$job->getJobID()}}', '{{$job->getTitle()}}', '{{$job->getCompany()}}', '{{$job->getDescription()}}', '{{$job->getRequirements()}}')">Edit</button>
			<a class="crudlink" href="{!! route('onDeleteJobPosting', ['jobID'=>$job->getJobID()]) !!}" style="display: inline-block;">Delete</a>
			
		</div>
		<h3>{{$job->getTitle()}}</h3>
		<h4>For: {{$job->getCompany()}}</h4>
		<br>
		<h3><b>Description</b></h3>
		<p>{{$job->getDescription()}}</p>
		<h3>Requirements</h3>
		<p>{{$job->getRequirements()}}</p>
	</div>
	<br>
	@empty
	<h3>No Jobs</h3>
@endforelse
@endif

</div>

<script>
	function showAddJobPostingForm() {
      var x = document.getElementById("addJobPostingForm");
      var y = document.getElementById("addJobPostingButton");
      if (x.style.display === "none") {
        x.style.display = "block";
        y.style.display = "none"
      }
    }
    
    function hideAddJobPostingForm() {
        var x = document.getElementById("addJobPostingForm");
        var y = document.getElementById("addJobPostingButton");
        if (x.style.display === "block") {
        x.style.display = "none";
        y.style.display = "block"
        }
    }
    
    function showEditJobPostingForm(jobID, title, company, description, requirements) {
        var x = document.getElementById("editJobPostingForm");
        var a = document.getElementById("editTitle");
        var b = document.getElementById("editCompany");
        var c = document.getElementById("editDescription");
        var d = document.getElementById("editRequirements");
        var e = document.getElementById("editJobID");
        if (x.style.display === "none") {
        	x.style.display = "block";
            a.value = title;
            b.value = company;
            c.value = description;
            d.value = requirements;
            e.value = jobID;
        }
    }
    
    function hideEditJobPostingForm() {
    	var x = document.getElementById("editJobPostingForm");
        if (x.style.display === "block") {
        x.style.display = "none";
        }
    }
    
</script>
@endsection