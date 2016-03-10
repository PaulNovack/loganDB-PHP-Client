<?php

include_once('global.php');


function TestSetGet($TB,$ops,$keybytes,$databytes) {
    $TB->runOut("Run test of $ops $keybytes Byte key and $databytes Byte value pairs and verify output.", $ops);


    $TB->prepareOut("Creating random array of $TB->ops $keybytes Byte key and $databytes Byte value pairs........");

    // Prepare 
    $fakedata = $TB->makeFakeData($ops, $keybytes, $databytes);
    //var_dump($fakedata);

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

    // Prepare output

    $TB->checktimeOut();
}



$TB = new LDBTestBase();

$ops = 500;
$keybytes = 24;
$databytes = 4000;
        
TestSetGet($TB,$ops,$keybytes,$databytes);

$ops = 5000;
$keybytes = 24;
$databytes = 40;
        
TestSetGet($TB,$ops,$keybytes,$databytes);

$ops = 5000;
$keybytes = 80;
$databytes = 80;
        
TestSetGet($TB,$ops,$keybytes,$databytes);

$ops = 5000;
$keybytes = 50;
$databytes = 50;
        
TestSetGet($TB,$ops,$keybytes,$databytes);

// Test Delete Operations

// TODO:  Check all delete operation are performing properly


if(true){  
    // Fix for over 10000 bytes not done yet will Crash server need to fix client and server
    $ops = 100;
    $keybytes = 80;
    $databytes = 15000;

    TestSetGet($TB,$ops,$keybytes,$databytes);
}

if(true){  
    // Fix for over 10000 bytes not done yet will Crash server need to fix client and server
    $ops = 100;
    $keybytes = 80;
    $databytes = 18000;

    TestSetGet($TB,$ops,$keybytes,$databytes);
}

if(true){  
    // Fix for over 10000 bytes not done yet will Crash server need to fix client and server
    $ops = 100;
    $keybytes = 80;
    $databytes = 60000;

    TestSetGet($TB,$ops,$keybytes,$databytes);
}

if(true){  
    // Fix for over 10000 bytes not done yet will Crash server need to fix client and server
    $ops = 10;
    $keybytes = 80;
    $databytes = 250000;

    TestSetGet($TB,$ops,$keybytes,$databytes);
}

if(true){  
    // Fix for over 10000 bytes not done yet will Crash server need to fix client and server
    $ops = 2;
    $keybytes = 80;
    $databytes = 2500000;

    TestSetGet($TB,$ops,$keybytes,$databytes);
}

