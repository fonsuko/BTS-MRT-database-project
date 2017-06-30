<?php
$mysqli = new mysqli('localhost','root','','datamobilink');
if($mysqli->connect_errno){
  echo $mysqli->connect_errno.": ".$mysqli->connect_error;
}

?>
