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
    background-image: url("image/userprofile.png");
    background-repeat: no-repeat;
}
/*position*/
.logomem{top:100px; left:1000px;position: absolute;}
.tablePos{
	position: absolute;
	top:250px;left:1000px;
	text-align: left;
}
/*circle picture: border-radius: 50%*/
/*button*/
posbutton1{top:450px;left:1225px;position: absolute;}

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
	font-size: 20px;
	color: #FFFFFF;
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
	</div>
	<div id="leftinfo">
		<img class="logomem" src="image/mem_logo.png"/>
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
								 <th width="150" text-align="left">MemberCardID</th>
								 <th class="fillIn"><?=$row['MemberCardID']?></th>
							 </tr>

							 <tr>
								  <th width="150" text-align="left">User</th>
								 <th class="fillIn"><?=$row['Title']?> <?=$row['FName']?> <?=$row['LName']?></th>
							 </tr>

								<tr>
									<th width="150" text-align="left">Username</th>
									<th class="fillIn"><?=$row['Username']?></th>
								</tr>

								<tr>
									<th width="150" text-align="left">Birthday</th>
									<th class="fillIn"><?=$row['Birthday']?></th>
								</tr>

								<tr>
									<th width="150" text-align="left">Telephone Number</th>
									<th class="fillIn"><?=$row['TelNumber']?></th>
								</tr>

								<tr>
									<th width="150" text-align="left">Email</th>
									<th class="fillIn"><?=$row['Email']?></th>
								</tr>
								<?php }?>
					</table>

				</div>
			<posbutton1><a href="editprofile.php?memberid=<?=$row['MemberID']?>"><input class="botton" type="button" value="Edit"></a></posbutton1>
		</div>
</body>
</html>
