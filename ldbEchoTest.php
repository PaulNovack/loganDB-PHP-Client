<?php
include_once('global.php');

$port = 6779;
$lc = new loganDBClient("127.0.0.1",$port);
$lc->Connect();
if(true){
    for($i = 0;$i < 100000; $i++){
        $echoresult = $lc->LDBEcho("A",$i);
        if($i % 10000 == 0){
            echo "get result: " . $echoresult . '<br/>';
        }
    }
}
