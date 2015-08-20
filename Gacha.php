<?php
require_once 'RedisManager.php';

function Gacha()
{
	openRedisConnect();
	$TotalValue = GetRedisValue("TotalGachaBaseRate");
	
	if($TotalValue == false)
		return ;
	
	$returnValue = GetRedisValue_Hash("GachaBase");
	
	if($returnValue == false)
		return ;
	
	
	for($i ==0 ; $i< 1000 ; $i++)
	{
		$rValue = mt_rand(1,$TotalValue);
		
		$min = 0;
		$max = 0;
		foreach ($returnValue as $key => $value)
		{
			$max = $max + $value;
			if($rValue >= $min && $rValue < $max)
			{
				echo $key.'  '.$rValue;
				break;
			}
			$min = $min + $value;
		}
	}

	
}