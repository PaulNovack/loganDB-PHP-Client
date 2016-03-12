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
  public $keys = array();
  public $values = array();
  private $apiversion = "0-5-0";   
  private $socket;
  function __construct($serverip = "127.0.0.1",$port = 6779,$authid = "JAVA-default",$sessionid = "JAVA-default",$timeout = 1000) {
     $this->serverip = $serverip;
     $this->port = $port; 
     $this->authid = $authid;
     $this->sessionid = $sessionid;
     $this->timeout = $timeout;
     $this->hostport = $this->serverip . ":" . $this->port;
  }
  public function Connect(){
    //  echo $this->hostport . "</br>";
    $this->sock = stream_socket_client("$this->hostport", $errno, $errstr, $this->timeout);
    if(!$this->sock){
      throw new loganDBException("$errno: $errstr");
    } else {
      //echo "OK!<br/>";
    }
    stream_set_blocking ($this->sock , false);
  }
  public function LDBEcho($keystorename, $key){
    $in = '|' . $keystorename . '|'
            . 'echo|' 
            . $key . '|';
    return $this->WriteReadStream($in);
  }
  public function GetKey($keystorename, $key){
    $in = '|' . $keystorename . '|'
            . 'getkey|' 
            . $key . '|';
    return $this->WriteReadStream($in);
  }
  public function SetKey($keystorename, $key,$value){
      if(strlen($value) > 8000){
          $start = substr($value,0,8000);
      } else {
          $start = $value;
      }
      $in = '|' . $keystorename . '|'
            . 'setkey|' 
            . $key . '|'
            . $start . '|';
    if(strlen($value) <= 8000){
      return $this->WriteReadStream($in);
    } else {
      $this->WriteReadStream($in);  
      $loops = floor(strlen($value) / 8000);
      $spos = 8000;
      for($loopnum = 1; $loopnum < $loops; $loopnum++){
        $start = substr($value,$spos,8000);
        $in = '|' . $keystorename . '|'
        . 'setappendkey|' 
        . $key . '|'
        . $start . '|';
        $this->WriteReadStream($in);
        $spos += 8000;
      }
      $start = substr($value,$spos,8000);
      $in = '|' . $keystorename . '|'
        . 'setappendkey|' 
        . $key . '|'
        . $start . '|';
      return $this->WriteReadStream($in);
    }
  }
  public function DeleteKey($keystorename, $key){
    $in = '|' . $keystorename . '|'
            . 'deletekey|' 
            . $key . '|'
            . '|';
    return $this->WriteReadStream($in);
  }
  public function WriteReadStream($in){
    $endmarker = "***LOGANDBTCPENDSTREAM***";
    $in = $in . $endmarker;
    $bytes = strlen($in);
    $bytes = $bytes + 9;
    str_pad($bytes,9,"0",STR_PAD_LEFT);
    $in = $bytes . $in;
    $result = fwrite($this->sock, $in);
    if(true){
        $out = "";
        $datalen = "";
        while($datalen  == ""){
          $datalen = fread($this->sock, 9);
        }
        //echo "Data Length:" . $datalen . "<br/><br/>";
        $discard = fread($this->sock, 1);
        $reads = ceil(intval($datalen) / 1024);
        //echo "Reads:" .  $reads . "<br/>";
        for($readnum = 1; $readnum <= $reads;$readnum++){
          $chunk = fread($this->sock, 1024);
          $out .= $chunk;
        }
        $out = substr($out,0,(strlen($out)-1));
    }
    return $out; 
  }
  public function __destruct()
  {
    fclose($this->sock);
  }
}
