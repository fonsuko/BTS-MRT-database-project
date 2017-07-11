<?php
	session_start();
	require_once('connect.php');
	require_once('extension.php');
	require_once('record.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Mobi link</title>
<link rel="stylesheet" href="default.css">
</head>
<style>
body {
		margin: auto;
		width: 100%;
    background-image: url("image/routes.png");
    background-repeat: no-repeat;
}
.headFont{
	font-family:"HelveticaNeue";
	font-size: 28px;
	color: #212121;
}
.subFont{
		font-family:"Helvetica Neue";
		font-size: 20px;
		color: #212121;
}
.tablePos{
	position: absolute;
	top:150px; left:80px;
	text-align:left;
	width:90%;
}
</style>

<body>
	<div id="wrapper">
		<ol style="float:left"><img height="38" src="image/mobiLink_logo.png"></ol>
		<ul>
			<li><?php loginlogout();?></li>
		  <li><a href="#Contact Us">Contact Us</a></li>
		  <li><a href="tickets.php">Tickets</a></li>
		  <li><a class="active" href="routes.php">Routes</a></li>
			<li><a href="main.php">Home</a></li>
			<li><a href="#Member"><?php welcome();?></a></li>
		</ul>
	</div>
	<!--<div class="tablePos">
		<table width="90%" align="center" border="1">
			<tr>
				<th class="headFont">Student Card</th>
				<th rowspan="3" width="20px">&nbsp;</th>
				<th class="headFont">Adult Card</th>
				<th rowspan="3" width="20px">&nbsp;</th>
				<th class="headFont">Elder Card</th>
			</tr>
			<tr>
				<th bgcolor="#212121" height="5"></th>
				<th bgcolor="#212121" height="5"></th>
				<th bgcolor="#212121" height="5"></th>
			</tr>
			<tr>
				<th><img align="center" src="image/studentCard.jpg"></th>
				<th><img align="center" src="image/adultCard.jpg"></th>
				<th><img align="center" src="image/elderCard.jpg"></th>
			</tr>
		</table>
	</div>-->
</body>
</html>
