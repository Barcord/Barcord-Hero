
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

openRedisConnect();
echo '<br>';
WriteAllKeys();
echo '<br>';
WireAllValues();
echo '<br>';
DeleteAllData();
echo '<br>';
GetAllKeysTTL();
echo '<br>';
?>


