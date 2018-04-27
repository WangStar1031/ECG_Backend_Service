<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

if( isset($_POST['req'])){

	// $date = date('Y-m-d H:i:s');
	$putData = new stdClass();
	$putData->time = date('Y-m-d H:i:s');

	$get = $_POST['req'];
	$arrGets = explode(";", $get);
	$arrHearts = explode(":", $arrGets[0]);
	$putData->HeartRate = $arrHearts[1];
	$arrCount = explode(":", $arrGets[1]);
	$putData->Count = $arrCount[1];
	$arrDatas = explode(":", $arrGets[2]);
	$putData->Datas = $arrDatas[1];

	$data = json_encode($putData);

	$fileContents = file_get_contents("postingdata.txt");
	$arrContents = explode("\n", $fileContents);
	for( $i = count($arrContents) - 1; $i >= 0; $i--){
		if( $arrContents[$i] == "")unset($arrContents[$i]);
	}
	while( count($arrContents) > 4){
		array_shift($arrContents);
	}
	$fileContents = "";
	for( $i = 0; $i < count($arrContents); $i ++){
		$fileContents .= $arrContents[$i] . "\n";
	}
	$fileContents .= $data . "\n";
	file_put_contents("postingdata.txt", $fileContents . "\n");
}

?>