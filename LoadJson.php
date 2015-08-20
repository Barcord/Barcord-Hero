
<?php
require_once 'RedisManager.php';

function LoadJsonFile($FileName)
{
	$context = stream_context_create(array(
			'http' => array(
					'method' => 'GET',
					'agent'  => $agent,
					'header' => "Content-Type: type=application/json\r\n"
					. "X-Api-Signature: $hash"
			)
	)
	);
	
	$str = file_get_contents($FileName, FILE_USE_INCLUDE_PATH,$context);
	
	//$str=utf8_encode($str);
	$json=json_decode($str,true);
	
	return $json;
}
function LoadGachaBase()
{
	echo 'LoadGachaBase<br>';
	$jsonData = LoadJsonFile("GachaBase.txt");
	$TotalGachaBaseRate = 0;
	DeleteData("GachaBase");
	foreach ($jsonData as $key => $value)
	{		
		$TotalGachaBaseRate = $TotalGachaBaseRate + $value['RATE'];
		InsertRedis_Hash("GachaBase", $value['ID'], $TotalGachaBaseRate);
	}	
	
	DeleteData("TotalGachaBaseRate");
	InsertRedis("TotalGachaBaseRate", $TotalGachaBaseRate);

}



openRedisConnect();
echo '<br>';
WriteAllKeys();
echo '<br>';
WireAllValues();
echo '<br>';


LoadGachaBase();
echo '<br>';
WriteAllKeys();
echo '<br>';
WireAllValues();
echo '<br>';
echo GetRedisValue("TotalGachaBaseRate");
echo '<br>';
$returnValue = GetRedisValue_Hash("GachaBase");
echo $returnValue.'<br>';

foreach ($returnValue as $key => $value)
{
	echo $key.' ';
	echo $value . "<br>";
}
?>


