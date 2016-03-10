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
$databytes = 8000;
        
TestSetGet($TB,$ops,$keybytes,$databytes);

$ops = 50000;
$keybytes = 24;
$databytes = 40;
        
TestSetGet($TB,$ops,$keybytes,$databytes);

$ops = 5;
$keybytes = 80;
$databytes = 80;
        
TestSetGet($TB,$ops,$keybytes,$databytes);

// Test Delete Operations

// TODO:  Check all delete operation are performing properly


if(false){  
    // Fix for over 10000 bytes not done yet will Crash server need to fix client and server
    $ops = 5;
    $keybytes = 80;
    $databytes = 12000;

    TestSetGet($TB,$ops,$keybytes,$databytes);
}