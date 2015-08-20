<?php
require_once 'RedisManager.php';

function Gacha()
{
	openRedisConnect();
	$TotalValue = GetRedisValue("TotalGachaBaseRate");
	echo $TotalValue.'<br>';
	if($TotalValue == false)
		return ;
	
	$returnValue = GetRedisValue_Hash("GachaBase");
	echo $returnValue.'<br>';
	if($returnValue == false)
		return ;
	
	$rValue = mt_rand(1,$TotalValue);
	echo $rValue.'<br>';
	
	$min = 0;
	$max = 0;
	foreach ($returnValue as $key => $value)
	{
		$max = $max + $value;
		if($rValue >= $min && $rValue < $max)
		{
			echo $key.'  '.$rValue;
		}
		$min = $min + $value;
	}
	
}