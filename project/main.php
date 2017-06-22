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
    background-image: url("image/main.png");
    background-repeat: no-repeat;
}

.positionFrom {
		font-family:"HelveticaNeue BlackCond";
		font-size: 30px;
		color: #212121;
    position: absolute;
    left:150px;
    top: 530px;
    text-align: center;
}
.selectFrom {
    position: absolute;
    left:240px;
    top: 530px;
		height: 40px;
		width:300px;
    text-align: center;
    font-size: 18px;
}
.positionTo {
		font-family:"HelveticaNeue BlackCond";
		font-size: 30px;
		color: #212121;
    position: absolute;
    left:590px;
    top: 530px;
    text-align: center;
}
.selectTo {
    position: absolute;
    left:645px;
    top: 530px;
		height: 40px;
		width:300px;
    text-align: center;
    font-size: 18px;
}
.botton{
	top:530px;left:1050px;position: absolute;
  background-color: #212121;border: none;color: white;
	font-family:"Helvetica Neue";
  padding: 8px 20px;
  text-align: center;
	text-decoration: none;
  display: inline-block;
  font-size: 20px;
	cursor: pointer;
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
			<li><a class="active" href="main.php">Home</a></li>
			<li class="dropdown"><?php welcome()?></li>
		</ul>
	</div>
	<div>

		<form method="POST" action="routes.php"> <!--real ver-->
	<!--- select station --->
		<?php
		require_once('connect.php');
			$q = "SELECT * FROM station ORDER BY StationName";
			$resultFrom=$mysqli->query($q);
			$resultTo = $mysqli->query($q);
			if(!$resultFrom || !$resultTo){
				echo "Select failed. Error: ".$mysqli->error ;
				break;
			}

		?>
		</select>
		<mainPage class="positionFrom">FROM: </mainPage>
		<select name="Origin" class="selectFrom">
			<?php
			while($row=$resultFrom->fetch_array()){
				echo '  <option value='.$row["StationID"].'>'.$row["StationName"].'</option>';
			}
			?>
		</select>
		<mainPage class="positionTo">TO: </mainPage>
		<select name="Destination" class="selectTo">
			<?php
			while($row=$resultTo->fetch_array()){
				echo '<option value='.$row["StationID"].'>'.$row["StationName"].'</option>';
			}
			?>
		</select>
		<input type="hidden" name="sendroute" value="sendroute" >
		<input class="botton" type="submit" value="search&nbsp; &#x1f50d;">


	</form>
	</div>
</body>
</html>
