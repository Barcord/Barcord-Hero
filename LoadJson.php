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

?>

<script>
function openRedisConnect(){
 alert("<?PHP openRedisConnect(); ?>");
 }

function WriteAllKeys(){
	 alert("<?PHP WriteAllKeys(); ?>");
 }


function WireAllValues(){
	 alert("<?PHP WireAllValues(); ?>");
 }


function DeleteAllData(){
	 alert("<?PHP DeleteAllData(); ?>");
 }

function GetAllKeysTTL(){
	 alert("<?PHP GetAllKeysTTL(); ?>");
}
</script>

<html>

<head>
    <meta charset='utf-8'/>
</head>
<body>
	<button onclick="openRedisConnect()">openRedisConnect</button>
	<button onclick="WriteAllKeys()">WriteAllKeys</button>
	<button onclick="WireAllValues()">WireAllValues</button>
	<button onclick="DeleteAllData()">DeleteAllData</button>
	<button onclick="GetAllKeysTTL()">GetAllKeysTTL</button>
</body>