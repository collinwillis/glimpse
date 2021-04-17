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
	<h1 style="color: white;"><b>Job Listings</b></h1>
	<div>
		<form action="{{route('adminjobsearch')}}" method="post">
		{{ csrf_field() }}
    		<div style="display: inline; font-size: large;">
    			<label for="search" style="color: white;">Search:</label>
    			<input style="width: 350px; text-align: center;" type="text" name="search" id="search" placeholder="Search by Title, Company, or Description">
            </div>
          &nbsp;&nbsp;&nbsp;
            <div style="display: inline; font-size: large;">
                <label for="order" style="color: white;">Sort:</label>
                <select name="order" id="order" onchange="toggleAlphabetize()">
                <option value="none">none</option>
                <option value="DESC-Date">New</option>
                <option value="ASC-Date">Old</option>
                <option value="ASC-Alpha">A-Z</option>
                <option value="DESC-Alpha">Z-A</option>
                </select>
			</div>
		&nbsp;&nbsp;&nbsp;&nbsp;
          	<div style="display: inline; font-size: large;">
              <label for="orderBy" style="color: white;">Alphabetize by:</label>
              <select name="orderBy" id="orderBy" disabled>
                <option value="title">Title</option>
                <option value="company">Company</option>
              </select>
            </div>
		&nbsp;&nbsp;&nbsp;
			<div style="display: inline; font-size: large;">
                <label for="resultCount" style="color: white;">Result Limit</label>
                <input type="number" name="resultCount" id="resultCount" min="0" onkeypress="return event.charCode >= 48" onkeyup="if(this.value<0){this.value= this.value * -1}" style="width: 50px;">
			</div>

			
			<br><br>
			<input type="submit" value="Search">
			
			<?php echo "<br><div style='color:red'>" . $errors->first('search') . "</div>"?>
		</form>
	</div>
</div>


<div align="center">
	@if(isset($limitPassed))
        @if($limitPassed == true)
        <h2 style="color: red;">Refine search results; result limit passed.</h2>
        @endif
    @endif
    @if(is_array($jobs)) 
		@forelse ($jobs as $job)
        	<div style="display: block; position: relative; text-align: left; border: solid black 3px; border-radius: 20px; width: 22%; color: white; padding-left: 10px; background-color: grey;">
        		<h2>{{$job->getTitle()}}</h2>
        		<h3>For: {{$job->getCompany()}}</h3>
        		<a href="{!! route('showJobAdmin', ['jobID'=>$job->getJobID()]) !!}"><span class="clickablediv"></span></a>
        	</div>
        	<br>
        	@empty
        	<h3>No Jobs</h3>
		@endforelse
@endif

</div>
<script type="text/javascript">
	function toggleAlphabetize() {
		var x = document.getElementById("order");
		var y = document.getElementById("orderBy");
		if (x.value == "ASC-Alpha" || x.value == "DESC-Alpha") {
			y.disabled = false;
		}
		else {
			y.disabled = true;
		}
	}

</script>
@endsection