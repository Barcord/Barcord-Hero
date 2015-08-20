<?php
require_once 'Gacha.php';
require_once 'LoadJson.php';

try {
	if (array_key_exists('WHAT', $_POST)) {
		$What = $_POST['WHAT'];
				
		if($What == 'GACHA')
		{
			Gacha();						
		}
		else if($What == 'LoadJson')
		{
			InitRedis();
			LoadGachaBase();
			CheckRedisValue();
		}
		else if($What == 'Use')
		{
			
		}
	}
} catch (PDOException $ex) {

}