<html>

<head>

    <meta charset='utf-8'/>
    <title>LoadJson</title>
       <?php
  		 include_once 'utility/BodyInclude.php';
	
	?>


</head>
<body>



<?php

$context = stream_context_create(array(
  'http' => array(
    'method' => 'GET',
    'agent'  => $agent,
    'header' => "Content-Type: type=application/json\r\n"
        . "X-Api-Signature: $hash"
    )
  )
);

$str = file_get_contents("Basic.txt",FILE_USE_INCLUDE_PATH,$context);

//$str=utf8_encode($str);
$json=json_decode($str,true);

?>
<div class="bs-example" data-example-id="hoverable-table">
	<table class="table table-hover table-bordered">
		<thead>
			<tr class="danger">
			<?php 
		//	$MenuArray = array ();
			foreach ($json as $key => $value)
			{			
				foreach ($value as $Jkey => $Jvalue)
				{
					echo "<th>$Jkey</th>";
		//			array_push ( $MenuArray, $Jkey );					
				}	
				break;						
			}					
			?>
			</tr>
		</thead>
		<tbody>
		<?php 
		
		foreach ($json as $key => $value)
		{
			echo "<tr>";
			foreach ($value as $Jkey => $Jvalue)
			{
				echo sprintf('<td> %s </td>', $Jvalue);
			}			
			echo "</tr>";
		}
		/*		
		foreach($MenuArray as $v)
		{
			echo $v;
			echo "<br>";
		}
		*/
		?>
		</tbody>
	</table>
</div>

</body>
</html>
>