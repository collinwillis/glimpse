<?php 
// Glimpse 1.1 / CLC Milestone 2
// Home
// Collin Willis and Derek Lundy
// 2/7/21
// This is the user home page.

?>
@extends('layouts.appmaster_loggedin')
@section('title', 'Login Page')
@section('content')
<div class="flex-center position-ref full-height">


	<div class="content">
		<div class="title m-b-md">
			<img alt="Logo" src="images/logo.png">
		</div>

		<div class="links">
			<a href="https://laravel.com/docs">About Glimpse</a> <a
				href="https://laracasts.com">Help</a> <a
				href="https://laravel-news.com">News</a> <a
				href="https://blog.laravel.com">Contact</a> <a
				href="https://github.com/laravel/laravel">GitHub</a>
		</div>
	</div>
</div>
@endsection

