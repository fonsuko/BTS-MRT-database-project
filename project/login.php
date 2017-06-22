<?php
	session_start();
	require_once('connect.php');
	require_once('extension.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Mobi link</title>
<link rel="stylesheet" href="default.css">
</head>
<style>
body{
		margin: auto;
		width: 100%;
    background-image: url("image/Login.png");
    background-repeat: no-repeat;
}

.logomem{top:150px; left:750px;position: absolute;}
.usernamePos{top:320px; left:700px;position: absolute;}
.passwordPos{top:390px; left:700px;position: absolute;}
.ansUserPos{top:320px; left:825px;position: absolute;}
.ansPassPos{top:390px; left:825px;position: absolute;}
.ForgotPos{top:475px; left:700px;position: absolute;}

sFont{
	font-family:"Helvetica Neue";
	font-size: 18px;
	color: #FFFFFF;
}
nFont{
	display: block;
	font-family:"Helvetica Neue";
	font-size: 24px;
	color: #FFFFFF;
}

.botton{
	top:460px;left:985px;position: absolute;
  background-color: #414141;border: none;color: white;
	font-family:"HelveticaNeue";
  padding: 8px 20px;
  text-align: center;
	text-decoration: none;
  display: inline-block;
  font-size: 20px;
	cursor: pointer;
}

</style>
<body>
	<!-- Navigation Bar -->
	<div id="wrapper">
		<ol style="float:left"><img height="38" src="image/mobiLink_logo.png"></ol>
		<ul>
		  <li><?php loginlogout();?></li>
			<li><a href="contactus.php">Contact Us</a></li>
		  <li><a href="tickets.php">Tickets</a></li>
		  <li><a href="routes.php">Routes</a></li>
			<li><a href="main.php">Home</a></li>
			<li class="dropdown"><?php welcome()?></li>
		</ul>
	</div >

	<div id="leftinfo">
		<img class="logomem" src="image/mem_logo.png"/>

		<!--send data for check login-->
		<form action="checklogin.php" method="POST">

			<nFont class="usernamePos">Username: </nFont>
			<ans class="ansUserPos"><input style="width:250px;" type="text" name="Username"></ans>

			<nFont class="passwordPos">Password: </nFont>
			<ans class="ansPassPos"><input style="width:250px;" type="password" name="Password"></ans>

			<sFont class="ForgotPos">Create new account:&nbsp;&nbsp;<u><a href="signup.php" style="color:#FFFFFF;">Sign Up</a></u></sFont>

		<input class="botton" type="submit" value="Login">
	</form>
	</div>

</body>
</html>
