<?php
/**
 * Description of loganDBClient
 *
 * loganDB php client class
 * version is identified in the apiversion.
 * @author pnovack
 */
class loganDBClient {
  public $serverip;
  public $port;
  public $authid;
  public $sessionid;
  public $timeout;  // in milliseconds;
  private $apiversion = "0-1-0";   
  private $socket;
  function __construct($serverip = "127.0.0.1",$port = 6779,$authid = "default",$sessionid = "default",$timeout = 1000) {
     $this->serverip = $serverip;
     $this->port = $port; 
     $this->authid = $authid;
     $this->sessionid = $sessionid;
     $this->timeout = $timeout;
     $this->hostport = $this->serverip . ":" . $this->port;
  }
  public function Connect(){
    $this->sock = @stream_socket_client("$this->hostport", $errno, $errstr, $this->timeout);
    if(!$this->sock){
      echo "Connection error!";  //throw new loganDBException("$errno: $errstr");
    } else {
      //echo "OK!<br/>";
    }
    stream_set_blocking ($this->sock , false);
    //if(function_exists('stream_set_chunk_size')){
    //  @stream_set_chunk_size($this->sock, 4096);
    //} 
  }
  public function GetKey($keystorename, $key){
    $in = '|' . $this->apiversion . '|' 
            . $this->authid . '|' 
            . $this->sessionid . '|' 
            . $keystorename . '|'
            . 'getkey|' 
            . $key . '|';
    //echo $in . "<br/>\r\n";
    $out = "";
    $result = @fwrite($this->sock, $in);
    $tries = 0;
    while($out == ""){
        //echo $tries++ . "<br/>";
        $out = @fread($this->sock, 10000);
    }
   // echo "OUTPUT is: " . $out . ":</br>";
    return $out; 
  }
  public function SetKey($keystorename, $key,$value){
    $in = '|' . $this->apiversion . '|' 
            . $this->authid . '|' 
            . $this->sessionid . '|' 
            . $keystorename . '|'
            . 'setkey|' 
            . $key . '|'
            . $value . '|';
    //echo $in . "<br/>\r\n";
    $out = "";
    $tries = 0;
    $result = @fwrite($this->sock, $in);
    while($out == ""){
        //echo $tries++ . "<br/>";
        $out = @fread($this->sock, 10000);
    }
    //echo "OUTPUT is: " . $out . ":</br>";
    return $out; 
  }
    public function DeleteKey($keystorename, $key){
    $in = '|' . $this->apiversion . '|' 
            . $this->authid . '|' 
            . $this->sessionid . '|' 
            . $keystorename . '|'
            . 'delete|' 
            . $key . '|'
            . '|';
    //echo $in . "<br/>\r\n";
    $out = "";
    $tries = 0;
    $result = @fwrite($this->sock, $in);
    while($out == ""){
        //echo $tries++ . "<br/>";
        $out = @fread($this->sock, 10000);
    }
    //echo "OUTPUT is: " . $out . ":</br>";
    return $out; 
  }
  public function __destruct()
  {
    @fclose($this->sock);
  }
}
