<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>

<link href="https://fonts.googleapis.com/css?family=Nunito:200,600"
	rel="stylesheet">

<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>

<!-- Styles -->
<style>
.wrapper {
	width: 650px;
	margin: 0 auto;
}

.page-header h2 {
	margin-top: 0;
}

table tr td:last-child a {
	margin-right: 15px;
}

html, body {
	background-color: #36383b;
	color: #636b6f;
	font-family: 'Nunito', sans-serif;
	font-weight: 200;
	height: 100vh;
	margin: 0;
}

.full-height {
	height: 100vh;
}

.flex-center {
	align-items: center;
	display: flex;
	justify-content: center;
}

.position-ref {
	position: relative;
}

.top-right {
	position: absolute;
	right: 10px;
	top: 18px;
}

.content {
	text-align: center;
}

.title {
	font-size: 84px;
}

.links>a {
	color: white;
	padding: 0 25px;
	font-size: 13px;
	font-weight: 600;
	letter-spacing: .1rem;
	text-decoration: none;
	text-transform: uppercase;
}

.m-b-md {
	margin-bottom: 30px;
}
</style>
</head>
<body>
	@include('layouts.header_admin')
	<div align="center">@yield('content')</div>


</body>
</html>