<?php
// Glimpse 1.1 / CLC Milestone 2
// Admin
// Collin Willis and Derek Lundy
// 2/7/21
// This is the main page for admin controls.
use App\Models\UserModel;
use App\Services\Business\SecurityService;
use App\Models\JobHistoryModel;
use App\Models\SkillModel;
use App\Models\EducationModel;

?>
@extends('layouts.appmaster_loggedin')
@section('title', 'Profile Page')
@section('content')

<div align="center">

	<div class="border-table">
		<h3>Job History</h3>

		<input type="button" id="addJobButton" onclick="showAddJobForm()"
			value="Add Job">

		<div class="form-container" id="addJobForm" style="display: none">
			<form class="floating-form" action="{{route('onAddJob')}}" method="post">
				{{ csrf_field() }} <label for="jobTitle">Title</label> <input
					type="text" name="jobTitle" id="jobTitle" placeholder="Title"><br>
				<label for="jobCompany">Company</label> <input type="text"
					name="jobCompany" id="jobCompany" placeholder="Company"><br> <label
					for="jobDescription">Job Description</label> <input type="text"
					name="jobDescription" id="jobDescription" placeholder="Description"><br>
				<br> <input type="submit" value="Add Job">
			</form>
			<input type="button" onclick="hideAddJobForm()" value="Cancel">
		</div>

		<div class="form-container" id="editJobForm" style="display: none">
			<form class="floating-form" action="{{route('onEditJob')}}" method="post">
				{{ csrf_field() }} <input type="hidden" name="editJobHistoryID"
					id="editJobHistoryID"><br> <label for="editJobTitle">Title</label>
				<input type="text" name="editJobTitle" id="editJobTitle"
					placeholder="Title"><br> <label for="editJobCompany">Company</label>
				<input type="text" name="editJobCompany" id="editJobCompany"
					placeholder="Company"><br> <label for="editJobDescription">Job
					Description</label> <input type="text" name="editJobDescription"
					id="editJobDescription" placeholder="Description"><br>
				<br> <input type="submit" value="Edit Job">
			</form>
			<input type="button" onclick="hideEditJobForm()" value="Cancel">
		</div>

		<table style="color: white" width="90%">
			<tr>
				<th>Title</th>
				<th>Company</th>
				<th>Description</th>
			</tr>
			@if(is_array($jobs)) @forelse($jobs as $result)
			<tr style="color: white">
				<td>{{$result->getTitle()}}</td>
				<td>{{$result->getCompany()}}</td>
				<td>{{$result->getDescription()}}</td>
				<td><button
						onclick="showEditJobForm('{{$result->getJobID()}}', '{{$result->getTitle()}}', '{{$result->getCompany()}}', '{{$result->getDescription()}}')">Edit</button></td>
				<td><a
					href="{!! route('onDeleteJob', ['jobHistoryID'=>$result->getJobID()]) !!}">Delete</a></td>
			</tr>
			@empty
			<h3>No Jobs</h3>
			@endforelse @endif
		</table>
	</div>

	<div class="border-table">
		<h3>Skills</h3>

		<input type="button" id="addSkillButton" onclick="showAddSkillForm()"
			value="Add Skill">

		<div class="form-container" id="addSkillForm" style="display: none">
			<form class="floating-form" action="{{route('onAddSkill')}}" method="post">
				{{ csrf_field() }} <label for="skill">Skill</label> <input
					type="text" name="skill" id="skill" placeholder="skill"><br>
				<br> <input type="submit" value="Add Skill">
			</form>
			<input type="button" onclick="hideAddSkillForm()" value="Cancel">
		</div>

		<div class="form-container" id="editSkillForm" style="display: none">
			<form class="floating-form" action="{{route('onEditSkill')}}" method="post">
				{{ csrf_field() }} <input type="hidden" name="editSkillID"
					id="editSkillID"><br> <label for="editSkill">Skill</label> <input
					type="text" name="editSkill" id="editSkill" placeholder="Skill"><br>
				<br> <input type="submit" value="Edit Skill">
			</form>
			<input type="button" onclick="hideEditSkillForm()" value="Cancel">
		</div>

		<table style="color: white" width="90%">
			<tr>
				<th>Skill</th>
			</tr>
			@if(is_array($skills)) @forelse($skills as $result)
			<tr style="color: white">
				<td>{{$result->getSkill()}}</td>
				<td><button
						onclick="showEditSkillForm('{{$result->getSkillID()}}', '{{$result->getSkill()}}')">Edit</button></td>
				<td><a
					href="{!! route('onDeleteSkill', ['SkillID'=>$result->getSkillID()]) !!}">Delete</a></td>
			</tr>
			@empty
			<h3>No skills</h3>
			@endforelse @endif
		</table>
	</div>

	<div class="border-table">
		<h3>Education</h3>

		<input type="button" id="addEducationButton"
			onclick="showAddEducationForm()" value="Add Education">

		<div class="form-container" id="addEducationForm" style="display: none">
			<form class="floating-form" action="{{route('onAddEducation')}}" method="post">
				{{ csrf_field() }} <label for="educationSchoolName">School Name</label>
				<input type="text" name="educationSchoolName"
					id="educationSchoolName" placeholder="School Name"><br> <label
					for="educationDegree">Degree</label> <input type="text"
					name="educationDegree" id="educationDegree" placeholder="Degree"><br>
				<label for="educationFieldOfStudy">Field of Study</label> <input
					type="text" name="educationFieldOfStudy" id="educationFieldOfStudy"
					placeholder="Field of Study"><br> <label for="educationStartDate">Start
					Date</label> <input type="text" name="educationStartDate"
					id="educationStartDate" placeholder="Start Year"><br> <label
					for="educationEndDate">End Date</label> <input type="text"
					name="educationEndDate" id="educationEndDate"
					placeholder="End Year"><br>
				<br> <input type="submit" value="Add Education">
			</form>
			<input type="button" onclick="hideAddEducationForm()" value="Cancel">
		</div>
		

		<div class="form-container" id="editEducationForm" style="display: none">
			<form class="floating-form" action="{{route('onEditEducation')}}" method="post">
				{{ csrf_field() }} <input type="hidden" name="editEducationID"
					id="editEducationID"><br> <label for="editEducationSchoolName">School
					Name</label> <input type="text" name="editEducationSchoolName"
					id="editEducationSchoolName" placeholder="School Name"><br> <label
					for="editEducationDegree">Degree</label> <input type="text"
					name="editEducationDegree" id="editEducationDegree"
					placeholder="Degree"><br> <label for="editEducationFieldOfStudy">Field
					of Study</label> <input type="text"
					name="editEducationFieldOfStudy" id="editEducationFieldOfStudy"
					placeholder="Field of Study"><br> <label
					for="editEducationStartDate">Start Date</label> <input type="text"
					name="editEducationStartDate" id="editEducationStartDate"
					placeholder="Start Year"><br> <label for="editEducationEndDate">End
					Date</label> <input type="text" name="editEducationEndDate"
					id="editEducationEndDate" placeholder="End Date"><br>
				<br> <input type="submit" value="Edit Education">
			</form>
			<input type="button" onclick="hideEditEducationForm()" value="Cancel">
		</div>

		<table style="color: white" width="90%">
			<tr>
				<th>School Name</th>
				<th>Degree</th>
				<th>Field of Study</th>
				<th>Start Date</th>
				<th>End Date</th>
			</tr>

			@if(is_array($educations)) 
			@forelse($educations as $result)
			<tr style="color: white">
				<td>{{$result->getSchoolName()}}</td>
				<td>{{$result->getDegree()}}</td>
				<td>{{$result->getFieldOfStudy()}}</td>
				<td>{{$result->getStartDate()}}</td>
				<td>{{$result->getEndDate()}}</td>
				<td><button onclick="showEditEducationForm('{{$result->getEducationID()}}', '{{$result->getSchoolName()}}', '{{$result->getDegree()}}', '{{$result->getFieldOfStudy()}}', '{{$result->getStartDate()}}', '{{$result->getEndDate()}}')">Edit</button></td>
				<td><a href="{!! route('onDeleteEducation', ['educationID'=>$result->getEducationID()]) !!}">Delete</a></td>
			</tr>
			@empty
			<h3>No education</h3>
			@endforelse 
			@endif
		</table>
	</div>


</div>
<script>
	function showAddJobForm() {
      var x = document.getElementById("addJobForm");
      var y = document.getElementById("addJobButton");
      if (x.style.display === "none") {
        x.style.display = "block";
        y.style.display = "none"
      }
    }
    
    function hideAddJobForm() {
        var x = document.getElementById("addJobForm");
        var y = document.getElementById("addJobButton");
        if (x.style.display === "block") {
        x.style.display = "none";
        y.style.display = "block"
        }
    }
    
    function showEditJobForm(jobHistoryID, title, company, description) {
        var x = document.getElementById("editJobForm");
        var a = document.getElementById("editJobTitle");
        var b = document.getElementById("editJobCompany");
        var c = document.getElementById("editJobDescription");
        var d = document.getElementById("editJobHistoryID");
        if (x.style.display === "none") {
        	x.style.display = "block";
            a.value = title;
            b.value = company;
            c.value = description;
            d.value = jobHistoryID;
        }
    }
    
    function hideEditJobForm() {
    	var x = document.getElementById("editJobForm");
        if (x.style.display === "block") {
        x.style.display = "none";
        }
    }
    
    
    
    function showAddSkillForm() {
      var x = document.getElementById("addSkillForm");
      var y = document.getElementById("addSkillButton");
      if (x.style.display === "none") {
        x.style.display = "block";
        y.style.display = "none"
      }
    }
    
    function hideAddSkillForm() {
        var x = document.getElementById("addSkillForm");
        var y = document.getElementById("addSkillButton");
        if (x.style.display === "block") {
        x.style.display = "none";
        y.style.display = "block"
        }
    }
    
    function showEditSkillForm(skillID, skill) {
        var x = document.getElementById("editSkillForm");
        var a = document.getElementById("editSkillID");
        var b = document.getElementById("editSkill");
        if (x.style.display === "none") {
        	x.style.display = "block";
            a.value = skillID;
            b.value = skill;
        }
    }
    
    function hideEditSkillForm() {
    	var x = document.getElementById("editSkillForm");
        if (x.style.display === "block") {
        x.style.display = "none";
        }
    }
    
    
    
    function showAddEducationForm() {
      var x = document.getElementById("addEducationForm");
      var y = document.getElementById("addEducationButton");
      if (x.style.display === "none") {
        x.style.display = "block";
        y.style.display = "none"
      }
    }
    
    function hideAddEducationForm() {
        var x = document.getElementById("addEducationForm");
        var y = document.getElementById("addEducationButton");
        if (x.style.display === "block") {
        x.style.display = "none";
        y.style.display = "block"
        }
    }
    
    function showEditEducationForm(educationID, educationSchoolName, educationDegree, educationFieldOfStudy, educationStartDate, educationEndDate) {
        var x = document.getElementById("editEducationForm");
        var a = document.getElementById("editEducationID");
        var b = document.getElementById("editEducationSchoolName");
        var c = document.getElementById("editEducationDegree");
        var d = document.getElementById("editEducationFieldOfStudy");
        var e = document.getElementById("editEducationStartDate");
        var f = document.getElementById("editEducationEndDate");
        if (x.style.display === "none") {
        	x.style.display = "block";
            a.value = educationID;
            b.value = educationSchoolName;
            c.value = educationDegree;
            d.value = educationFieldOfStudy;
            e.value = educationStartDate;
            f.value = educationEndDate;
        }
    }
    
    function hideEditJobForm() {
    	var x = document.getElementById("editEducationForm");
        if (x.style.display === "block") {
        x.style.display = "none";
        }
    }
	</script>
@endsection
