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
body {
		margin: auto;
		width: 100%;
    background-image: url("image/refill.png");
    background-repeat: no-repeat;
}
.tablePos{
	padding-left: 35px;
	padding-top: 150px;
	font-family:"Helvetica Neue";
	font-size: 24px;
	color: #212121;
}

.botton{
	top:350px;left:895px;position: absolute;
  background-color: #414141;border: none;color: white;
	font-family:"HelveticaNeue";
  padding: 8px 20px;
  text-align: center;
	text-decoration: none;
  display: inline-block;
  font-size: 20px;
	cursor: pointer;
}

.longCombobox{
	width:150px;
}

</style>

<body>
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
	</div>

	<div class="tablePos">
		<table border="1" align="center"; >
			<tr>
				<th colspan="2">Online Refill Money</th>
			</tr>
			<tr>
				<th width="300" text-align="left">Your balance</th>
				<th width="300" text-align="left">Refill Money</th>
			</tr>
			<tr>
				<th width="300" text-align="left">300</th><!--select balance from table-->
				<th><select class="longCombobox" name="refill"width="150"></select></th>
			</tr>
		</table>
	</div>
	<div>
			<input class="botton" type="button" value="Confirm">
	</div>



</body>
</html>
