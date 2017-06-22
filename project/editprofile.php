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
    background-image: url("image/edit.png");
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
.fill{
	font-family:"Helvetica Neue";
	font-size: 20px;
	color: #FFFFFF;
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
	<form name="editprofile" action="updateuserprofile.php" method="POST">
	<div>
		<img class="logomem" src="image/mem_logo_small.png"/>
	<div class="tablePos">
		<table class="label" border="0" align="center"; >
			<?php
					$member = $_SESSION['Username'];
					$q="select * from member,title where member.TitleID=title.TitleID AND Username = '$member';";
					$q = strtolower($q);
					$result=$mysqli->query($q);
					if(!$result){
						echo "Select failed. Error: ".$mysqli->error ;
						break;
					}
				 while($row=$result->fetch_array()){ ?>
							<tr>
								<th width="150" text-align="left">Member card ID</th>
								<th><ans class="fill"><?=$row['MemberCardID']?></th>
								<input type="hidden" name="memid" value="<?=$row['MemberCardID']?>" >
							</tr>

							<tr>
								<th>Title</th>
								<th>
									<select name="title"style="width:254px;">
									<?php
											$q='select TitleID, Title from title;';
											$q = strtolower($q);
											if($result=$mysqli->query($q)){
												while($row=$result->fetch_array()){
													if($row['TitleID']==$row['TitleID'])
													{$select = 'selected';}
													else{	$select = '';}
												echo '<option value="'.$row[0].'">'.$row[1].'</option>';}
											}else{echo 'Query error: '.$mysqli->error;}
									?>
									</select>
								</th>
							</tr>

							<tr>
								<th width="150" text-align="left">Name</th>
								<th><ans class="fillIn"><input style="width:250px;" type="text" name="name" value="<?=$row['FName']?>"></ans></th>
							</tr>

							<tr>
								<th width="150" text-align="left">Surname</th>
								<th><ans class="fillIn"><input style="width:250px;" type="text" name="sname" value="<?=$row['LName']?>"></ans></th>
							</tr>

							<tr>
								<th width="150" text-align="left">Username</th>
								<th><ans class="fillIn"><input style="width:250px;" type="text" name="username" value="<?=$row['Username']?>"></ans></th>
							</tr>

							<tr>
								<th width="150" text-align="left">Password</th>
								<th><ans class="fillIn"><input style="width:250px;" type="password" name="pass" value="<?=$row['Password']?>"></ans></th>
							</tr>

							<tr>
								<th width="150" text-align="left">Confirm Password</th>
								<th><ans class="fillIn"><input style="width:250px;" type="password" name="cpass" value="<?=$row['Password']?>"></ans></th>
							</tr>

							<tr>
								<th width="150" text-align="left">Birthday</th>
								<th><ans class="fillIn"><input style="width:250px;" type="date" name="bdate" value="<?=$row['Birthday']?>"></ans></th>
							</tr>

							<tr>
								<th width="150" text-align="left">Telephone Number</th>
								<th><ans class="fillIn"><input style="width:250px;" type="text" name="tel" value="<?=$row['TelNumber']?>"></ans></th>
							</tr>

							<tr>
								<th width="150" text-align="left">Email</th>
								<th><ans class="fillIn"><input style="width:250px;" type="email" name="email" value="<?=$row['Email']?>"></ans></th>
							</tr>
				<?php }?>
			</table>
		</div>
		<posbutton1><input class="botton" type="submit" value="Submit"></posbutton1>
		<posbutton2><input class="botton" type="reset" value="Clear"></posbutton2>
	</div>
	</form>
</body>
</html>
