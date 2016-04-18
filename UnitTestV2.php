<?php

include_once('global.php');


function TestSetGet($TB,$ops,$keybytes,$databytes) {
    $TB->runOut("Run test of $ops $keybytes Byte key and $databytes Byte value pairs and verify output.", $ops);

    $TB->prepareOut("Creating random array of $TB->ops $keybytes Byte key and $databytes Byte value pairs........");

    $fakedata = $TB->makeFakeData($ops, $keybytes, $databytes);

    $TB->prepareTimeOut();

    $TB->runOperation();

    foreach ($TB->testData as $key => $value) {
        //echo "Key: $key; Value: $value</br>\n";
       // if(strlen($value) > 8000){
        //    $value = gzcompress($value, 9);
       //     $TB->testData[$key] = $value;
       // }
        $TB->lc->SetKey("A", $key, $value);
        //echo $key . "</br>";
        //ob_flush();
        //flush();
    }

    $TB->runtimeOut();

    $TB->checkOperation();

    $check = true;
    foreach ($TB->testData as $key => $value) {
        $getValue = $TB->lc->GetKey("A", $key);
        if ($value != $getValue) {
            $check = false;
            break;
        }
    }

    $TB->checkOut($check);

    $TB->checktimeOut();
    if(false){
        $TB->DeleteOperation();
        foreach ($TB->testData as $key => $value) {
            $return =  $TB->lc->DeleteKey("A", $key);
        }

        $TB->deletetimeOut();


        $TB->checkdeleteOperation();
        $check = true;
        foreach ($TB->testData as $key => $value) {
            $getValue = $TB->lc->GetKey("A", $key);
            if ("NULL" == $getValue) {
                //$check = false;
                //break;
            } else {
                if($getValue == "NULL"){
                    echo "<tr><td colspan='2'>GetValue:" . "PASSED TRY 2" . "</td></tr>";
                } else {
                  echo "<tr><td colspan='2'>GetValue:" . $getValue . "</td></tr>";
                  $check = false;
                }
            }
        }
        $TB->checkdeleteOut($check);
        $TB->checkdeletetimeOut();
    }
    $size = $TB->lc->GetSize("A");
    $TB->CheckSize($size);
}

 $TB = new LDBTestBase();
for($runs = 0; $runs < 250;$runs++){
 

  $ops = 500;
  $keybytes = 24;
  $databytes = 4000;
   
  TestSetGet($TB,$ops,$keybytes,$databytes);

  
  $ops = 10000;
  $keybytes = 32;
  $databytes = 32;
        
  TestSetGet($TB,$ops,$keybytes,$databytes);

  $ops = 5000;
  $keybytes = 80;
  $databytes = 80;
        
  TestSetGet($TB,$ops,$keybytes,$databytes);

  $ops = 5000;
  $keybytes = 50;
  $databytes = 50;
        
  TestSetGet($TB,$ops,$keybytes,$databytes);



  $ops = 100;
  $keybytes = 80;
  $databytes = 15000;
  
  if(true){
  TestSetGet($TB,$ops,$keybytes,$databytes);

  $ops = 100;
  $keybytes = 80;
  $databytes = 18000;

  TestSetGet($TB,$ops,$keybytes,$databytes);

  $ops = 100;
  $keybytes = 80;
  $databytes = 60000;

  TestSetGet($TB,$ops,$keybytes,$databytes);
  }
  
  
  }



