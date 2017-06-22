<?php
  require_once('connect.php');
  include_once("shortestPathQueue.php");
  include_once("shortestPathAlg.php");


  $q = "SELECT * FROM price";

  $result=$mysqli->query($q);

  if(!$result){
		echo "Select failed. Error: ".$mysqli->error ;
		break;
	}
  $priceList = array();
  while($row=$result->fetch_array()){
    $priceObj = ["from" => $row["OStationID"],"to"=>$row["DStationID"], "distance"=>$row["Distance"]];
    array_push($priceList,$priceObj);
  }

  $fromStation = $_GET["OStationID"];
  $toStation = $_GET["DStationID"];
  $s = new UCSAlgorithm($fromStation,$toStation,$priceList);

  if ($s->Test())
  {
      var_dump($s->GetShortestPath(TRUE)); // with debug mode
  }
  else
  {
      throw new Exception("Bad test checking");
  };

  echo $_GET["OStationID"]+" "+$_GET["DStationID"];
?>
