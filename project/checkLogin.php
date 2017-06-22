<?php
session_start();
require_once('connect.php');
$re_user = $_POST['Username'];
$re_pass = MD5($_POST['Password']);
//$re_pass = md5($_POST['Password']);
$q = "SELECT * FROM member WHERE ".
"Username = '$re_user' AND ".
"Password = '$re_pass' ";
//echo $q;
$result = $mysqli->query($q);
if ($result)
{	$count_no_row = $result->num_rows;
	if ($count_no_row==1)
	{ $row = $result->fetch_array();
		$_SESSION['Username']=$row['Username'];

		// add membercard june
		$q = "SELECT * FROM member WHERE Username = '$re_user'";
		$result = $mysqli->query($q);
		$row=$result->fetch_array();
		$mid = $row[0];
		$mcid = $row[1];

		$currentmoney = 0;
		$q2 = "SELECT * FROM membercard";
		$qresult=$mysqli->query($q2);
		$i=0;
		while($qrow=$qresult->fetch_array())
		{
			$existmcid[$i] = $qrow[0];
			if($existmcid[$i] == $mcid)
			{ echo "<script type='text/javascript'>alert('Login success');window.location = 'main.php';</script>";
				break;
			}
			else
			{$i=$i+1;}
		}
			$q1="INSERT INTO membercard (MemberCardID,CurrentMoney, MemberID)
			VALUES ('$mcid','$currentmoney', '$mid')";
			$q1 = strtolower($q1);
			$result1=$mysqli->query($q1);
			if(!$result1)
			{	echo "INSERT failed. Error: ".$mysqli->error;
				break;
			}
			echo "<script type='text/javascript'>alert('Login success');window.location = 'main.php';</script>";
		}
		else
		{
			echo "<script type='text/javascript'>alert('wrong username or password');window.location = 'login.php';</script>";
		}
	}

else
{echo "<script type='text/javascript'>alert('wrong username or password');window.location = 'login.php';</script>";}
?>
