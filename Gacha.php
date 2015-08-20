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
	
	echo 'BASE RATE<br>';
	$beforv = 0;
	foreach ($returnValue as $key => $value)
	{
		echo $key.' ';
		$Tvalue = $value - $beforv;
		$beforv = $value;
	
		echo $Tvalue . "<br>";
	}
	
	$GUN = 0;
	$SWORD  = 0;
	$SHIELD  = 0;
	$RING  = 0;
	$WAND  = 0;
	$SHOES  = 0;
	
	for($i ==0 ; $i< 10000 ; $i++)
	{
		$rValue = mt_rand(1,$TotalValue);
		
		$min = 0;
		$max = 0;
		
		foreach ($returnValue as $key => $value)
		{			
			$max = $value;
			if($rValue >= $min && $rValue < $max)
			{					
				switch ($key)
				{
					case "GUN":
						$GUN++;
						break;
					case "SWORD":
						$SWORD++;
						break;
					case "SHIELD":
						$SHIELD++;
						break;
					case "RING":
						$RING++;
						break;
					case "WAND":
						$WAND++;
						break;
					case "SHOES":
						$SHOES++;
						break;							
				}
				break;
			}
			$min = $value;
		}
		
	}
	

	echo 'GUN = '. $GUN.'<br>';
	echo 'SWORD = '. $SWORD.'<br>';
	echo 'SHIELD = '. $SHIELD.'<br>';
	echo 'RING = '. $RING.'<br>';
	echo 'WAND = '. $WAND.'<br>';
	echo 'SHOES = '. $SHOES.'<br>';

	
}