<!DOCTYPE html>
<html>
<head>
<style>
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


</style>
</head>
<body>

	<ul>
		<li><img alt="Glimpse" src="{{url('/images/logo.png')}}" height="30px" style="margin-top:10px; margin-left:10px"></li>
		<li><a class="active" href="{{ route('userHome') }}">Home</a></li>
		<li><a href="{{ route('profile') }}">Profile</a></li>
		<li><a href="{{ route('portfolio') }}">Portfolio</a></li>
		<li><a href="{{ route('jobs') }}">Jobs</a></li>
		<li><a href="{{ route('home') }}">Logout</a></li>
		
	</ul>

</body>
</html>