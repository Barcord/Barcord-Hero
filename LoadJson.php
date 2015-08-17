<?php

echo "1";
$redisObj = new Redis();

function openRedisConnect()
{
	global $redisObj;
	echo "3";
	$redisObj->connect('barcord1.ddtmfr.0001.apne1.cache.amazonaws.com');
	echo "4";
	echo $redisObj->get('set_testkey');
	echo "connect succ";
	return $redisObj;
}

echo "2";
openRedisConnect();



?>