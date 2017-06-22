<?php
	session_start();
	require_once('connect.php');
	require_once('extension.php');
?>
<?php
  $member = $_SESSION['Username'];

  $memid = $_POST["memid"];//cannot edit
  $title = $_POST["title"];
  $name = $_POST["name"];
  $sname = $_POST["sname"];
  $username = $_POST["username"];
  $pass = MD5($_POST["pass"]);
  $cpass = $_POST["cpass"];// for check only
  $bdate = $_POST["bdate"];
  $tel = $_POST["tel"];
  $email = $_POST["email"];

  if(empty($title)OR empty($name)OR empty($sname)OR empty($username)OR empty($pass)
  OR empty($cpass)OR empty($bdate)OR empty($tel)OR empty($email))
    {echo "<script type='text/javascript'>alert('Please fill out all required information.');</script>";}
  else if ($_POST['pass']!=$_POST['cpass'])
    {echo "<script type='text/javascript'>alert('Your password and confirmation password do not match.');</script>";}
  else if (!is_numeric($_POST['tel']))
    {echo "<script type='text/javascript'>alert('Please check your telphone number.');</script>";}
  else{
  	$q = "update member set MemberCardID=$memid,TitleID=$title, FName='$name',
    LName='$sname', Username='$username', Password='$pass', Birthday='$bdate',
    TelNumber='$tel', Email='$email'WHERE Username='$member'";

  	if(!$mysqli->query($q))
    {		echo "<script type='text/javascript'>alert('Update failed');</script>";	}
    else{	echo "<script type='text/javascript'>alert('Update success, Please login again');window.location = 'logout.php';</script>";}
  }
?>
