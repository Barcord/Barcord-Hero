<?php

$redisObj = new Redis();

function openRedisConnect()
{
	global $redisObj;

	$redisObj->connect('barcord1.ddtmfr.0001.apne1.cache.amazonaws.com');
	$redisObj->set('p', 'test');
	echo $redisObj->get('p');
	echo "connect succ";
	return $redisObj;
}

openRedisConnect();

echo $redisObj->get('p');
?>