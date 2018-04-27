<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$contents = file_get_contents("postingdata.txt");

// $arrElems = array();
$arrElems = explode("\n", $contents);
$retVal = array();
for( $i = 0; $i < count($arrElems) - 1; $i++){
	if($arrElems[$i] == "")continue;
	$elem = json_decode($arrElems[$i]);
	if( isset($_GET['lastTime'])){
		$lastTime = $_GET['lastTime'];
		$reqTime = strtotime($lastTime);
		$curTime = strtotime($elem->time);
		if( $reqTime >= $curTime)
			continue;
	}
	$retElem = new stdClass();
	$retElem->time = $elem->time;
	$retElem->HeartRate = $elem->HeartRate;
	$retElem->Count = $elem->Count;
	$retElem->Datas = $elem->Datas;
	// $retVal .= "{time:'" . $elem->time . "';" . $elem->data . "}\n";
	array_push($retVal, $retElem);
}

echo json_encode($retVal);

?>