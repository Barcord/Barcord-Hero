
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

function  DeleteAllDatas()
{
	echo 'DeleteAllData<br>';
	global $redisObj;
	$redisObj->flushAll();
}

function DeleteData($key)
{
	echo 'DeleteData<br>';
	global $redisObj;
	$redisObj->delete($key);
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

function InsertRedis_Hash($key, $hashKey, $value)
{
	global $redisObj;
	return $redisObj->hSet($key, $hashKey, $value);
}

function GetRedisValue($key)
{
	echo 'GetRedisValue<br>';
	global $redisObj;
	return  $redisObj->get($key);
}

function GetRedisValue_Hash($key)
{
	global $redisObj;
	return  $redisObj->hVals($key);
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
	DeleteData("GachaBase");
	foreach ($jsonData as $key => $value)
	{		
		$TotalGachaBaseRate = $TotalGachaBaseRate + $value['RATE'];
		InsertRedis_Hash("GachaBase", $key, $value);
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
GetAllKeysTTL();
echo '<br>';
LoadGachaBase();
echo '<br>';
WriteAllKeys();
echo '<br>';
WireAllValues();
echo '<br>';
GetAllKeysTTL();
echo '<br>';
echo GetRedisValue("TotalGachaBaseRate");
echo '<br>';
$returnValue = GetRedisValue_Hash("GachaBase");
echo $returnValue;

foreach ($returnValue as $key => $value)
{
	echo $value['ID'];
	echo $value['RATE']."<br>";
}
?>


