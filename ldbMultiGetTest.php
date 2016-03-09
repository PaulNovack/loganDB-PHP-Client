<?php
include_once('global.php');

$port = 6779;
$lc = new loganDBClient("127.0.0.1",$port);

// 11904 per second for set key
// 15151 AND 16986 per second get key
// 24467 AND 21963 delete keys per second

// mysql Get (select): 6666 AND 5747 per second
// mysql Delete per second: 25 (only tested with 1000 deletes slow operation)
// mysql update per second: 25.37 (only tested with 1000 updates slow operation)
//$myfile = fopen("/home/pnovack/list.csv", "w");
$lc->Connect();

$start = 0;
for(;$start < 100; $start++){
     $key = str_pad($start,12,"0",STR_PAD_LEFT);
     $lc->AddGetKey($key);
}
$data = $lc->GetMultikey("A",false);
var_dump($data);
var_dump($lc);



