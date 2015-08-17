<?php
 if(isset($_POST['openRedisConnect']))
{
    openRedisConnect();
}
else if(isset($_POST['WriteAllKeys']))
{
    WriteAllKeys();
}
else if(isset($_POST['WireAllValues']))
{
	WireAllValues();
}
else if(isset($_POST['DeleteAllData']))
{
    DeleteAllData();
}
else if(isset($_POST['GetAllKeysTTL']))
{
	GetAllKeysTTL();
}
?>

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

openRedisConnect();
echo '<br>';
WriteAllKeys();
?>


<html>

<head>
    <meta charset='utf-8'/>
</head>
<body>
	<form action="LoadJson.php" method="post">

	<input type="submit" name="openRedisConnect" value="openRedisConnect" />
	<input type="submit" name="WriteAllKeys" value="WriteAllKeys"/>
	<input type="submit" name="WireAllValues" value="WireAllValues"/>
	<input type="submit" name="DeleteAllData" value="DeleteAllData"/>
	<input type="submit" name="GetAllKeysTTL" value="GetAllKeysTTL"/>
	</form>
</body>