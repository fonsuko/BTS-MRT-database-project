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
    background-image: url("image/signup.png");
    background-repeat: no-repeat;
}
/*position*/
.logomem{top:100px; left:1120px;position: absolute;}
.tablePos{
	position: absolute;
	top:150px;left:725px;
	text-align: left;
}
/*circle picture: border-radius: 50%*/
/*button*/
posbutton1{top:570px;left:1030px;position: absolute;}
posbutton2{top:570px;left:930px;position: absolute;}
.botton{
  background-color: #414141;border: none;color: white;
	font-family:"HelveticaNeue";
  padding: 8px 20px;
  text-align: center;
	text-decoration: none;
  display: inline-block;
  font-size: 20px;
	cursor: pointer;
}
/*text*/
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
</style>

<body>
	<!-- Navigation Bar -->
	<div id="wrapper">
		<ol style="float:left"><img height="38"src="image/mobiLink_logo.png"></ol>
		<ul>
			<li><?php loginlogout();?></li>
			<li><a href="contactus.php">Contact Us</a></li>
		  <li><a href="tickets.php">Tickets</a></li>
		  <li><a href="routes.php">Routes</a></li>
			<li><a href="main.php">Home</a></li>
			<li class="dropdown"><?php welcome()?></li>
		</ul>
	</div >
	<form name="profile" action="signup.php" method="POST">
	<div>
		<img class="logomem" src="image/mem_logo_small.png"/>
		<div class="tablePos">
			<table class="label" border="0" align="center"; >
				<tr>
					<th width="150" text-align="left">Member card ID</th>
					<th><ans class="fillIn"><input style="width:250px;" type="text" name="memid"></ans></th>
				</tr>
				<tr>
					<th>Title</th>
					<th>
						<select name="title"style="width:254px;">
						<?php
								$q='select TitleID, Title from title;';
								$q = strtolower($q);
								if($result=$mysqli->query($q)){
									while($row=$result->fetch_array())
									{echo '<option value="'.$row[0].'">'.$row[1].'</option>';}
								}else{echo 'Query error: '.$mysqli->error;}
						?>
						</select>
					</th>
				</tr>

				<tr>
					<th width="150" text-align="left">Name</th>
					<th><ans class="fillIn"><input style="width:250px;" type="text" name="name"></ans></th>
				</tr>

				<tr>
					<th width="150" text-align="left">Surname</th>
					<th><ans class="fillIn"><input style="width:250px;" type="text" name="sname"></ans></th>
				</tr>

				<tr>
					<th width="150" text-align="left">Username</th>
					<th><ans class="fillIn"><input style="width:250px;" type="text" name="username"></ans></th>
				</tr>

				<tr>
					<th width="150" text-align="left">Password</th>
					<th><ans class="fillIn"><input style="width:250px;" type="password" name="pass"></ans></th>
				</tr>

				<tr>
					<th width="150" text-align="left">Confirm Password</th>
					<th><ans class="fillIn"><input style="width:250px;" type="password" name="cpass"></ans></th>
				</tr>

				<tr>
					<th width="150" text-align="left">Birthday</th>
					<th><ans class="fillIn"><input style="width:250px;" type="date" name="bdate"></ans></th>
				</tr>

				<tr>
					<th width="150" text-align="left">Telephone Number</th>
					<th><ans class="fillIn"><input style="width:250px;" type="text" name="tel"></ans></th>
				</tr>

				<tr>
					<th width="150" text-align="left">Email</th>
					<th><ans class="fillIn"><input style="width:250px;" type="email" name="email"></ans></th>
				</tr>
				<!-- add into variable-->
				<?php	require_once('connect.php');
			    if(isset($_POST['signup']))
					{	$memid = $_POST["memid"];
			      $title = $_POST["title"];
			      $name = $_POST["name"];
			      $sname = $_POST["sname"];
			      $username = $_POST["username"];
			      $pass = MD5($_POST["pass"]);
						$cpass = $_POST["cpass"];// for check only
			      $bdate = $_POST["bdate"];
			      $tel = $_POST["tel"];
			      $email = $_POST["email"];
			      $signup = $_POST['signup'];

					//check
					if(empty($memid)OR empty($title)OR empty($name)OR empty($sname)OR empty($username)OR empty($pass)
					OR empty($cpass)OR empty($cpass)OR empty($bdate)OR empty($tel)OR empty($email))
						{echo "<script type='text/javascript'>alert('Please fill out all required information.');</script>";}
					else if ($_POST['pass']!=$_POST['cpass'])
						{echo "<script type='text/javascript'>alert('Your password and confirmation password do not match.');</script>";}
					else if (!is_numeric($_POST['tel']))
						{echo "<script type='text/javascript'>alert('Please check your telphone number.');</script>";}
					else{
					//add into sql
						if($signup=='signup')
						{	$q="INSERT INTO member (MemberCardID,TitleID,FName,LName,Username,Password,Birthday,TelNumber,Email)
				      VALUES ('$memid','$title','$name','$sname','$username','$pass','$bdate','$tel','$email')";
				      $q = strtolower($q);
				      $result=$mysqli->query($q);
				      if(!$result)
							{	echo "INSERT failed. Error: ".$mysqli->error;
				        break;
				      }
							echo "<script type='text/javascript'>alert('Regist success');window.location = 'main.php';</script>";
				    }
					}
			    }?>


			</table>
		</div>
		<posbutton1><input class="botton" type="submit" value="Submit"></posbutton1>
		<posbutton2><input class="botton" type="reset" value="Clear"></posbutton2>
		<input type="hidden" name="signup" value="signup" >
	</div>
	</form>
</body>
</html>
