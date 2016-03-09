<?php
include_once('global.php');

$port = 6779;
$lc = new loganDBClient("127.0.0.1",$port);
$lc->Connect();
if(true){
    for($i = 0;$i < 10000; $i++){
        $key = str_pad($i,12,"0",STR_PAD_LEFT);
        $value = str_pad($i,12,"0",STR_PAD_LEFT);
        $setkeyresult = $lc->SetKey("A",$key,$value);
        if($i % 1000 == 0){
            echo "Set result: " . $setkeyresult . " :Key and Value: " . $key . "::" . $value . '<br/>';
            flush();
        }
    }
}
