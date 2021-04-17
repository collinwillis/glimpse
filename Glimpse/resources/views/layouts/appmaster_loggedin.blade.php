<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>

<link href="https://fonts.googleapis.com/css?family=Nunito:200,600"
	rel="stylesheet">

<!-- Styles -->
<style>
html, body {
	background-color: #36383b;
	color: #636b6f;
	font-family: 'Nunito', sans-serif;
	font-weight: 200;
	height: 100vh;
	margin: 0;
}

input {
    color: black;
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

.border-table {
    color: white;
    background-color: grey;
    border-radius: 7px;
    border: solid black 3px;
    margin-bottom: 15px;
    padding-bottom: 80px;
}

tr, td, th{
    border: solid black 3px;
    text-align: center;
}

.linktobutton {
  font: bold 11px Arial;
  text-decoration: none;
  font-size: large;
  background-color: #EEEEEE;
  color: #333333;
  padding: 2px 6px 2px 6px;
  border-top: 1px solid #CCCCCC;
  border-right: 1px solid #333333;
  border-bottom: 1px solid #333333;
  border-left: 1px solid #CCCCCC;
  border-radius: 7px;
}

ul {
	list-style-type: none;
	margin: 0;
	padding: 0;
	overflow: hidden;
	background-color: #333;
}

li {
	float: left;
}

li a {
	display: block;
	color: white;
	text-align: center;
	padding: 14px 16px;
	text-decoration: none;
}

li a:hover {
	background-color: #111;
}


.form-container{
  display: none;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  border-radius: 17px;
  border: 3px solid #f1f1f1;
  z-index: 9;
  background-color: lightgrey;
  width: 50%;
  height: 50%;
  
}

.floating-form {
    margin-top: 15%;
}

.clickablediv {
    position:absolute; 
    width:100%;
    height:100%;
    top:0;
    left: 0;
    z-index: 1;
}

</style>
</head>
<body>
	@include('layouts.navbar_loggedIn')
	<div align="center">@yield('content')</div>


</body>
</html>