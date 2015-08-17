<?php

$redisObj = new Redis();

function openRedisConnect()
{
	global $redisObj;

	$redisObj->connect('barcord1.ddtmfr.0001.apne1.cache.amazonaws.com');
	
	echo $redisObj->get('p');
	echo '<br>';
	echo "connect succ";
	echo '<br>';
	return $redisObj;
}

openRedisConnect();

echo $redisObj->get('p');
echo '<br>';
echo $redisObj->ttl('p');
echo '<br>';
echo $redisObj->keys('*');
?>