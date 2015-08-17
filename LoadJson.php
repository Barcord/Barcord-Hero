<?php

$redisObj = new Redis();

function openRedisConnect()
{
	global $redisObj;
	$redisObj->connect('barcord1.ddtmfr.0001.apne1.cache.amazonaws.com');
	echo $redisObj->get('set_testkey');
	echo "connect succ";
	return $redisObj;
}

openRedisConnect();



?>