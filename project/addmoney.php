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
    background-image: url("image/refillmoney.png");
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
	top:380px;left:890px;position: absolute;
  background-color: #212121;border: none;color: white;
	font-family:"HelveticaNeue";
  padding: 8px 20px;
  text-align: center;
	text-decoration: none;
  display: inline-block;
  font-size: 20px;
	cursor: pointer;
}
.bg{
	background-color: #212121;
	color: #FFFFFF;
}
.longCombobox{
	width:150px;
}
table {
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
}
tr {
    height: 50px;
    vertical-align: center;
}

</style>

<body>
	<div id="wrapper">
		<ol style="float:left"><img height="38" src="image/mobiLink_logo.png"></ol>
		<ul>
		  <li><?php loginlogout();?></li>
		  <li><a href="#Contact Us">Contact Us</a></li>
		  <li><a href="tickets.php">Tickets</a></li>
		  <li><a href="routes.php">Routes</a></li>
			<li><a href="main.php">Home</a></li>
			<li><a href="#Member"><?php welcome();?></a></li>
		</ul>
	</div>
  <?php
		$member = $_SESSION['Username'];
    $re_money = $_POST['refill'];
    $q = "SELECT m.MemberID, mc.MemberID, mc.MembercardID, mc.Currentmoney FROM member m, membercard mc WHERE m.MemberID = mc.MemberID AND m.Username = '$member'";
    $result=$mysqli->query($q);
    $row = $result->fetch_array();
    $old_money = $row[3];
		$mcid = $row[2];
    $cur_money = $re_money + $old_money;

    $r  = "UPDATE membercard SET CurrentMoney = $cur_money WHERE membercard.MembercardID = $mcid;";
    $result1=$mysqli->query($r);
    $row1 = $result->fetch_array();

  ?>
	<div class="tablePos">
    	<table border="1" align="center"; >
      <tr>
        <th colspan="2" class="bg">Online Refill Money</th>
      </tr>
      <tr>
        	<th width="300" text-align="left">Now your balance is </th>
          <th width="300" text-align="left"><?=$cur_money ?></th>
      </tr>


	</div>



</body>
</html>