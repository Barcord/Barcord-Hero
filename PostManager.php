<?php
require_once 'Gacha.php';

try {
	if (array_key_exists('WHAT', $_POST)) {
		$What = $_POST['WHAT'];
		echo $What;
		
		if($What == 'GACHA')
		{
			Gacha();						
		}
		else if($What == 'Select')
		{
			
		}
		else if($What == 'Use')
		{
			
		}
	}
} catch (PDOException $ex) {

}