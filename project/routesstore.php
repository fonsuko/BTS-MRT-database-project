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
    background-image: url("routes.png");
    background-repeat: no-repeat;
}
/* for routes*/
setfont
{ font-family:"HelveticaNeue BlackCond" ;
	font-size: 24px;
	color: #212121;
	position: absolute;
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

	<div class="setting">

		<!--send data-->
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
			echo "<setfont>From: ".$OStationName."&nbsp;&nbsp;To: ".$DStationName."&nbsp;&nbsp;</setfont><br><br>";

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
			echo"<table><tr><td><setfont>";
			//echo "<br>";
			echo "price:".$price;
			echo "distance:".$distance;
			echo "Transit at:".$Tstation;
			echo"</setfont></tr></td></table>";
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
	</div>
</body>
</html>
