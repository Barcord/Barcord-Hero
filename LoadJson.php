
<?php

$redisObj = new Redis();

function openRedisConnect()
{
	global $redisObj;
	$redisObj->connect('barcord1.ddtmfr.0001.apne1.cache.amazonaws.com');
	echo 'Connect Succ';
	return $redisObj;
}

function WriteAllKeys()
{
	global $redisObj;
	echo 'WriteAllKeys<br>';

	$keyarray =  $redisObj->keys('*');
	foreach ($keyarray as $value)
	{
		echo $value;
		echo '<br>';
	}
}
function WireAllValues()
{
	echo 'WireAllValues<br>';
	global $redisObj;
	$keyarray =  $redisObj->keys('*');
	foreach ($keyarray as $value)
	{
		echo $value. ' : '.$redisObj->get($value);
		echo '<br>';
	}
}

function  DeleteAllData()
{
	echo 'DeleteAllData<br>';
	global $redisObj;
	$redisObj->flushAll();
}

function GetAllKeysTTL()
{
	echo 'GetAllKeysTTL<br>';
	global $redisObj;
	$keyarray =  $redisObj->keys('*');
	foreach ($keyarray as $value)
	{
		echo $value. ' : '.$redisObj->ttl($value);
		echo '<br>';
	}
}

function CloseRedis()
{
	echo 'CloseRedis<br>';
	global $redisObj;
	$redisObj->close();
}

function InsertRedis($key, $value)
{
	global $redisObj;
	$redisObj->set($key, $value);
}


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
	foreach ($jsonData as $key => $value)
	{		
		$TotalGachaBaseRate = $TotalGachaBaseRate + $value['RATE'];
	}	
	
	InsertRedis("TotalGachaBaseRate", $TotalGachaBaseRate);
	InsertRedis("GachaBase", $jsonData);
}



openRedisConnect();
echo '<br>';
WriteAllKeys();
echo '<br>';
WireAllValues();
echo '<br>';
GetAllKeysTTL();
echo '<br>';
LoadGachaBase();
echo '<br>';
WriteAllKeys();
echo '<br>';
WireAllValues();
echo '<br>';
GetAllKeysTTL();
?>


