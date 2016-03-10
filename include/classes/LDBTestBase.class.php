<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoganDBTestBase
 *
 * @author pnovack
 */
class LDBTestBase {
    //put your code here
    private $testnameText;
    private $prepareText;
    private $checkText;
    private $startTicks;
    private $endTicks;
    private $minutes;
    private $seconds;
    private $milliseconds;
    private $microseconds;
    private $opsPerSecond;
    public $testData;
    private $testNumber = 1;
    public $lc;
    function LDBTestBase(){
      $port = 6779;
      $this->lc = new loganDBClient("127.0.0.1",$port);
      $this->lc->Connect();
      $today = date("F j, Y, g:i a"); 
$str = <<<MARKER
<!DOCTYPE html>
<html>
    <head>
        <title>LoganDB PHP Client Test</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            div { margin-right: auto; margin-left: auto; width: 800px; }
            body {font-family: arial,verdana;font-size:12px;}
            table {	margin:0px;
                   
                        border-spacing: 0;
                    border-collapse: collapse;
                    width: 800px;

            }
            tr.testhead {background-color: #e6ccff}
            tr.pass {background-color: lightgreen}
            tr.fail {background-color:tomato}
            tr.desc {background-color:#ccc}
            tr.prep {background-color:#f5f5f0}
            tr.ops {background-color:lightblue}
        </style>
    </head>
    <body>
        <div >
            <h3>Logan DB PHP Client / Server Test Report version 0.5.0:  $today UTC Time</h3>
            <table >
MARKER;
        echo $str;
    }
    function runOut($message = "", $ops = 0){
        $this->ops = $ops;
$str = <<<MARKER
                <tr class="testhead">
                    <td colspan="2">
                        <strong>Test #$this->testNumber:</strong> $message
                    </td>     
                </tr>
MARKER;
        echo $str;
    }    
    function prepareOut($message = ""){
      $this->start();
$str = <<<MARKER
                <tr class="desc">
                    <td colspan="2">
                        <strong>Test #$this->testNumber preparing data:</strong> $message
                    </td>     
                </tr>
MARKER;
        echo $str;
        ob_flush();
        flush();
    }
    
    function runOperation(){
      $this->start();
$str = <<<MARKER
                <tr class="desc">
                    <td colspan="2">
                        <strong>Running operation to test...................
                    </td>     
                </tr>
MARKER;
        echo $str;
        ob_flush();
        flush();
    }        
    function checkOperation(){
      $this->start();
$str = <<<MARKER
                <tr class="desc">
                    <td colspan="2">
                        <strong>Check operation to check operation ran and worked properly...................
                    </td>     
                </tr>
MARKER;
        echo $str;
        ob_flush();
        flush();            
    }

    
    function start(){
        $this->startTicks = $this->microtime_float();
        //echo "Start:";
        //var_dump($this->startTicks);
       // echo "</br>";
    }
    
    function end(){
        $this->endTicks = $this->microtime_float();
        //echo "End:";
       // var_dump($this->endTicks);
       // echo "</br>";
    }
    
    function checkOut($pass){
      if($pass){
$str = <<<MARKER
                <tr class="pass">
                    <td colspan="2">
                        <strong>Result:</strong>&nbsp;&nbsp;---- PASS ----
                    </td>     
                </tr>        
MARKER;
      } else {     
$str = <<<MARKER
                <tr class="fail">
                    <td colspan="2">
                        <strong>Result:</strong>&nbsp;&nbsp;---- FAIL ----
                    </td>     
                </tr>        
MARKER;
      }
      echo $str;
      $this->testNumber++;
      ob_flush();
      flush();
    }
    
    function prepareTimeOut(){
      $this->end();
      $this->calculate($this->ops);  
$str = <<<MARKER
                <tr class="ops">
                    <td>
                        <strong>Prepare operations per second:</strong>&nbsp;&nbsp; $this->opsPerSecond ops/sec.
                    </td>   
                    <td>
                        <strong>Prepare time to complete:</strong>&nbsp;&nbsp; 
        $this->seconds seconds AND $this->microseconds microseconds
                    </td>     
                </tr>
MARKER;
      echo $str;
      ob_flush();
      flush();
    }  
    function runtimeOut(){
      $this->end();
      $this->calculate($this->ops);
$str = <<<MARKER
                <tr class="ops">
                    <td>
                        <strong>Run operations per second:</strong>&nbsp;&nbsp; $this->opsPerSecond ops/sec.
                    </td>   
                    <td>
                        <strong>Run time to complete:</strong>&nbsp;&nbsp; 
        $this->seconds seconds AND $this->microseconds microseconds
                    </td>     
                </tr>
MARKER;
      echo $str;
      ob_flush();
      flush();
    }  
    
    function checktimeOut(){
      $this->end();
      $this->calculate($this->ops);
$str = <<<MARKER
                <tr class="ops">
                    <td>
                        <strong>Check operations per second:</strong>&nbsp;&nbsp; $this->opsPerSecond ops/sec.
                    </td>   
                    <td>
                        <strong>Check time to complete:</strong>&nbsp;&nbsp; 
        $this->seconds seconds AND $this->microseconds microseconds
                    </td>     
                </tr>
MARKER;
      echo $str;
      ob_flush();
      flush();
    }  
    
    function calculate(){
      $duration = $this->endTicks - $this->startTicks;
      $this->seconds = floor($duration);
      $this->milliseconds = floor(((float)$duration - (float)$this->seconds) * 1000);
      $this->microseconds =  floor(((float)$duration - (float)$this->seconds) * 1000000);
      $this->opsPerSecond = floor($this->ops / $duration);
        
      //var_dump($duration);
        
      //echo "Seconds: " . $this->seconds . "</br>";
      //echo "milliseconds: " . $this->milliseconds . "</br>";
      //echo "microseconds: " . $this->microseconds . "</br>";
      // "Operations performed: " . $ops . ":: Operations per second:" . $this->opsPerSecond . "</br>";
    }
    
    function microtime_float(){
      list($usec, $sec) = explode(" ", microtime());
      return ((float)$usec + (float)$sec);
    }
    
    function makeFakeData($elements,$keysize,$datasize){
        $testarray = array();
        for($itnum = 0; $itnum < $elements;$itnum++){
            $testarray[$this->random_str($keysize)] = $this->random_str($datasize);
        }

        $this->testData = $testarray;
        return $testarray;
    }
    function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        return $str;
    }
    
    function __destruct(){
$str = <<<MARKER
            </table> 



        </div>
    </body>
</html>
MARKER;
      echo $str;
    }
    
}
