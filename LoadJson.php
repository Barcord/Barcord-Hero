<?php

$redisObj = new Redis();

function openRedisConnect()
{
	global $redisObj;
	$redisObj->connect('barcord1.ddtmfr.0001.apne1.cache.amazonaws.com');
	
	return $redisObj;
}

function WriteAllKeys()
{
	echo 'WriteAllKeys<br>';
	global $redisObj;
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
		echo $redisObj->get($value);
		echo '<br>';
	}
}
openRedisConnect();

echo '<br>';
echo 'Time : ';
echo $redisObj->ttl('p');
echo '<br>';
WriteAllKeys();
echo '<br>';
WireAllValues();

?>