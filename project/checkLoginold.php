<?php
session_start();
require_once('connect.php');
$re_user = $_POST['Username'];
$re_pass = MD5($_POST['Password']);
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
    echo "<script type='text/javascript'>alert('Login success');window.location = 'main.php';</script>";
	}
	else
	{	echo "<script type='text/javascript'>alert('wrong username or password');window.location = 'login.php';</script>";
	}
}
else
{echo "<script type='text/javascript'>alert('wrong username or password');window.location = 'login.php';</script>";}
?>
