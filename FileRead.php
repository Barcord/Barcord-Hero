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


foreach ($json as $key => $value)
{
        echo $value['ID'];
        echo $value['RATE']."<br>";
}
?>


</body>
</html>
>