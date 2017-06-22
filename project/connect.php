<?php
//test ver
//$mysqli = new mysqli('localhost','root','','mobi_user');
//real ver
$mysqli = new mysqli('localhost','root','','datamobilink');
if($mysqli->connect_errno){
  echo $mysqli->connect_errno.": ".$mysqli->connect_error;
}

?>
