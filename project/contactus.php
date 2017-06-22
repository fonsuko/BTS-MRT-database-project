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
    background-image: url("image/contactus.png");
    background-repeat: no-repeat;
}
.fillIn{
	font-family:"Helvetica Neue";
	font-size: 32px;
	color: #212121;
}
.label{
	font-family:"Helvetica Neue";
	font-size: 20px;
	color: #FFFFFF;
}
.tablePos{
	position: absolute;
	top:390px;left:120px;
	text-align: left;
}
.botton{
  background-color: #414141;border: none;color: white;
	font-family:"HelveticaNeue";
  padding: 4px 10px;
  text-align: center;
	text-decoration: none;
  display: inline-block;
  font-size: 20px;
	cursor: pointer;
}
biglabel{
	font-family:"HelveticaNeue BlackCond";
	font-size: 32px;
	color: #FFFFFF;
	top:360px;left:60px;
	position: absolute;
}
posbutton1{top:220px;left:325px;position: absolute;}
posbutton2{top:225px;left:250px;position: absolute;}

</style>

<body>
	<div id="wrapper">
		<ol style="float:left"><img height="38" src="image/mobiLink_logo.png"></ol>
		<ul>
			<li><?php loginlogout();?></li>
		  <li><a class="active" href="contactus.php">Contact Us</a></li>
		  <li><a href="tickets.php">Tickets</a></li>
		  <li><a href="routes.php">Routes</a></li>
			<li><a href="main.php">Home</a></li>
			<li class="dropdown"><?php welcome()?></li>
		</ul>
	</div>
	<form name="contact" action="contactus.php" method="POST">
	<biglabel>Send information</biglabel>
	<div class="tablePos">
		<table class="label" border="0" align="left"; >
			<tr>
				<th width="150" text-align="left">Name</th>
				<th><ans class="fillIn"><input style="width:250px;" type="text" name="name"></ans></th>
			</tr>
			<tr>
				<th width="150" text-align="left">Surname</th>
				<th><ans class="fillIn"><input style="width:250px;" type="text" name="sname"></ans></th>
			</tr>
			<tr>
				<th width="150" text-align="left">Email</th>
				<th><ans class="fillIn"><input style="width:250px;" type="email" name="email"></ans></th>
			</tr>

			<tr>
				<th width="150" text-align="left">Subject</th>
				<th>
					<select name="subject"style="width:255px;">
					<?php
						$q='select SubjectID, SubjectName from subject;';
						$q = strtolower($q);
						if($result=$mysqli->query($q)){
							while($row=$result->fetch_array())
							{echo '<option value="'.$row[0].'">'.$row[1].'</option>';}
						}else
							{echo 'Query error: '.$mysqli->error;}
					?>
					</select>
				</th>
			</tr>
			<tr>
				<th width="150" text-align="left">Message</th>
				<th><ans class="fillIn"><textarea style="width:250px; height:50px" name="message"></textarea></ans></th>
			</tr>
			<?php
				if(isset($_POST['contact']))
				{ $name = $_POST["name"];
					$sname = $_POST["sname"];
					$email = $_POST["email"];
					$subject = $_POST["subject"];
					$message = $_POST["message"];
					$contact = $_POST["contact"];
					if(empty($name)OR empty($sname)OR empty($email)OR empty($subject)OR	empty($message))
					{echo "<script type='text/javascript'>alert('Please fill out all required information.');</script>";}
					else
					{	if($contact=='contact')
						{	$q="INSERT INTO contactus (FName,LName,Email,SubjectID,Message)
				      VALUES ('$name','$sname','$email','$subject','$message')";
				      $q = strtolower($q);
				      $result=$mysqli->query($q);
				      if(!$result)
							{	echo "INSERT failed. Error: ".$mysqli->error;
				        break;
				      }
							echo "<script type='text/javascript'>alert('Thank you for getting in touch!');window.location = 'main.php';</script>";
						}
					}

				}
			?>
		</table>
		<posbutton1><input class="botton" type="submit" value="Submit"></posbutton1>
		<!--<posbutton2><input class="botton" type="reset" value="Clear"></posbutton2>-->
		<input type="hidden" name="contact" value="contact" >
	</div>
	</form>
</body>
</html>
