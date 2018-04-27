<?php

$contents = file_get_contents("postingdata.txt");

// $arrElems = array();

$arrElems = explode("\n", $contents);
$jsonData = json_encode($arrElems);
echo $jsonData;
?>
<script type="text/javascript">
	var arrElems = "<?= $jsonData; ?>";
	console.log(arrElems);
</script>