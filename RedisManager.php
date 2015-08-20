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
	echo 'DeleteData '. $key.'<br>';
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
	return  $redisObj->hGetAll($key);
}
?>