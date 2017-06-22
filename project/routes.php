<?php
	session_start();
	require_once('connect.php');
	require_once('extension.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Mobi link</title>
<link rel="stylesheet" href="default.css" >
</head>
<style>
body {
		margin: auto;
		width: 100%;
    background-image: url("image/Routes.png");
    background-repeat: no-repeat;
}
/* for routes*/
nav{
	float: right;
	margin-top: 250px;
  margin-right: 465px;
}
setfont
{ font-family:"Helvetica Neue" ;
	font-size: 20px;
	color: #FFFFFF;
	position: absolute;
}
.positionhead {
		font-family:"HelveticaNeue BlackCond";
		font-size: 36px;
		color: #FFFFFF;
    position: absolute;
    left:890px;
    top: 100px;
    text-align: center;
}
.positionFrom {
		font-family:"HelveticaNeue BlackCond";
		font-size: 30px;
		color: #FFFFFF;
    position: absolute;
    left:900px;
    top: 160px;
    text-align: center;
}
.selectFrom {
    position: absolute;
    left:1000px;
    top: 160px;
		height: 40px;
		width:300px;
    text-align: center;
    font-size: 18px;
}
.positionTo {
		font-family:"HelveticaNeue BlackCond";
		font-size: 30px;
		color: #FFFFFF;
    position: absolute;
    left:900px;
    top: 210px;
    text-align: center;
}
.selectTo {
    position: absolute;
    left:1000px;
    top: 210px;
		height: 40px;
		width:300px;
    text-align: center;
    font-size: 18px;
}
.botton{
	top:260px;left:1168px;position: absolute;
  background-color: #414141;border: none;color: white;
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
		  <li><a class="active" href="routes.php">Routes</a></li>
			<li><a href="main.php">Home</a></li>
			<li class="dropdown"><?php welcome()?></li>
		</ul>
	</div>
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
	<heading class="positionhead">Where would you like to go?</heading>
	<mainPage class="positionFrom">FROM : </mainPage>
	<select name="Origin" class="selectFrom">
		<?php
		while($row=$resultFrom->fetch_array()){
			echo '  <option value='.$row["StationID"].'>'.$row["StationName"].'</option>';
		}
		?>
	</select>
	<mainPage class="positionTo">TO : </mainPage>
	<select name="Destination" class="selectTo">
		<?php
		while($row=$resultTo->fetch_array()){
			echo '<option value='.$row["StationID"].'>'.$row["StationName"].'</option>';
		}
		?>
	</select>
	<input type="hidden" name="sendroute" value="sendroute" >
	<input class="botton" type="submit" value="search&nbsp; &#x1f50d;">

	<nav>
		<?php
			if(isset($_POST['sendroute'])){
			$origin=$_POST['Origin'];
			$destination=$_POST['Destination'];

			require_once('connect.php');
			// Get O&DStation Name
			$q = "SELECT S.StationName, S.LineID, T.StationName, T.LineID FROM station as S, station as T WHERE S.StationID = '$origin' and T.StationID = '$destination'";
			$OS= [];
			$result = $mysqli->query($q);
			$row = $result->fetch_array();

			$OStationName = $row[0];
			$OStationLine = $row[1];
			$DStationName = $row[2];
			$DStationLine = $row[3];
			echo "<br>";
			echo "<setfont>From: ".$OStationName."</setfont><br><br>";
			echo "<setfont>To: ".$DStationName."</setfont><br><br>";

			if($OStationLine != $DStationLine){
				echo "<setfont>(need transfer)</setfont><br>";

				// Get price and distance with transit
				if($OStationLine == "GL" && $DStationLine == "BL"){
					$i = 0;
					$q="SELECT * from transit1";
					$result = $mysqli->query($q);
					while($row=$result->fetch_array()){
						//echo "start ".$row[0];
						//echo " ".$row[1]." end ";
						$OS[$i]=$row[1];
						$DS[$i]=$row[2];
						$i=$i+1;
					}
				}
				else if ($OStationLine == "BL" && $DStationLine == "GL") {
					$i = 0;
					$q="SELECT * from transit1";
					$result = $mysqli->query($q);
					while($row=$result->fetch_array()){

						$OS[$i]=$row[2];
						$DS[$i]=$row[1];
						$i=$i+1;
					}
				}
				else if ($OStationLine == "PL" && $DStationLine == "BL") {
					$i = 0;
					$q="SELECT * from transit3";
					$result = $mysqli->query($q);
					while($row=$result->fetch_array()){

						$OS[$i]=$row[1];
						$DS[$i]=$row[2];
						$i=$i+1;
					}
				}
				else if ($OStationLine == "BL" && $DStationLine == "PL") {
					$i = 0;
					$q="SELECT * from transit3";
					$result = $mysqli->query($q);
					while($row=$result->fetch_array()){

						$OS[$i]=$row[2];
						$DS[$i]=$row[1];
						$i=$i+1;
					}
				}
				else if ($OStationLine == "GL" && $DStationLine == "RL") {
					$i = 0;
					$q="SELECT * from transit2";
					$result = $mysqli->query($q);
					while($row=$result->fetch_array()){

						$OS[$i]=$row[1];
						$DS[$i]=$row[2];
						$i=$i+1;
					}
				}
				else if ($OStationLine == "RL" && $DStationLine == "GL") {
					$i = 0;
					$q="SELECT * from transit2";
					$result = $mysqli->query($q);
					while($row=$result->fetch_array()){

						$OS[$i]=$row[2];
						$DS[$i]=$row[1];
						$i=$i+1;
					}
				}
				else if ($OStationLine == "BL" && $DStationLine == "RL") {
					$i = 0;
					$q="SELECT * from transit4";
					$result = $mysqli->query($q);
					while($row=$result->fetch_array()){

						$OS[$i]=$row[1];
						$DS[$i]=$row[2];
						$i=$i+1;
					}
				}
				else if ($OStationLine == "RL" && $DStationLine == "BL") {
					$i = 0;
					$q="SELECT * from transit4";
					$result = $mysqli->query($q);
					while($row=$result->fetch_array()){

						$OS[$i]=$row[2];
						$DS[$i]=$row[1];
						$i=$i+1;
					}
				}


			for($i=0;$i<sizeof($OS);$i++){
				$q = "SELECT * FROM price WHERE OStationID = '$origin' AND DStationID = '$OS[$i]' ";
				//echo $q;
				$r = "SELECT p.DStationID, s.StationID, s.StationName FROM price p, station s WHERE p.DStationID = '$OS[$i]' AND p.DStationID = s.StationID";
				//echo $r;
			$result = $mysqli->query($q);
			$row = $result->fetch_array();
			$result1 = $mysqli->query($r);
			$row1 = $result1->fetch_array();

			$price1 = $row[3];
			$distance1 = $row[4];

			$q = "SELECT * FROM price WHERE OStationID = '$DS[$i]' AND DStationID = '$destination'";
			//echo $q;
			$result = $mysqli->query($q);
			$row = $result->fetch_array();
			$price2 = $row[3];
			$distance2 = $row[4];

			$Tstation = $row1[2];
			$price = $price1 + $price2;
			$distance = $distance1 + $distance2;
			echo "<br><table><tr><td><setfont>price:".$price." distance:".$distance." Transit at:".$Tstation."</setfont></tr></td></table><br>";

			}


			} else {
				echo "<setfont>(one line)</setfont><br>";
				// Get price and Distance From the same line
			$q = "SELECT * FROM price WHERE OStationID = '$origin' AND DStationID = '$destination'";
			$result = $mysqli->query($q);
			$row = $result->fetch_array();
			$price = $row[3];
			$distance = $row[4];

			echo "<br><setfont>";
			echo "price ".$price;
			echo "  distance ".$distance."</setfont>";
			}


		}//end ifsset
		?>
	</nav>
</body>
</html>
