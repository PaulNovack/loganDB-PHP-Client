<?php
include_once('global.php');

$port = 6779;
$lc = new loganDBClient("127.0.0.1",$port);
$lc->Connect();
if(true){
    for($i = 0;$i < 1000000; $i++){
        $key = str_pad($i,12,"0",STR_PAD_LEFT);
        $deleteyresult = $lc->DeleteKey("A",$key);
        if($i % 10000 == 0){
            echo "delete key result: " . $deleteyresult . '<br/>';
            flush();
        }
    }
}
