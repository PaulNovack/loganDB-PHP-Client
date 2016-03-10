<?php
include_once('global.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SetV16BD16B
 *
 * @author pnovack
 */
class SetV16BD16B extends LDBTestBase {
    //put your code here
    private $RunMessage = "";
    private $PrepareMessage = "";
    private $testops = 10000;
    
    function Setv16BD16B(){
      $TB->runOut($this->RunMessage,$this->testops);
      $TB->prepareOut("Creating array of $TB->ops 16 byte Key 16 Byte value pairs........");        
    }
    
    function prepare(){
        
    }    
    function run(){
        
    }
    
    function test(){
        
    }
    
}
