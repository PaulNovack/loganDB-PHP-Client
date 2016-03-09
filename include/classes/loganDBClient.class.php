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
    $this->sock = stream_socket_client("$this->hostport", $errno, $errstr, $this->timeout);
    if(!$this->sock){
      echo "Connection error!";  //throw new loganDBException("$errno: $errstr");
    } else {
      echo "OK!<br/>";
    }
    stream_set_blocking ($this->sock , false);
  }
  public function LDBEcho($keystorename, $key){
    $in = '|' . $this->apiversion . '|' 
            . $this->authid . '|' 
            . $this->sessionid . '|' 
            . $keystorename . '|'
            . 'echo|' 
            . $key . '|';
    return $this->WriteReadStream($in);
  }
  public function GetKey($keystorename, $key){
    $in = '|' . $this->apiversion . '|' 
            . $this->authid . '|' 
            . $this->sessionid . '|' 
            . $keystorename . '|'
            . 'getkey|' 
            . $key . '|';
    return $this->WriteReadStream($in);
  }
  public function AddSetPair($key,$value){
    array_push($this->keys,$key);
    array_push($this->values,$value);
  }
  public function AddGetKey($key){
     array_push($this->keys,$key);     
  }
  public function GetMultiKey($keystorename,$debug = false){
    $in = '|' . $this->apiversion . '|' 
        . $this->authid . '|' 
        . $this->sessionid . '|' 
        . $keystorename . '|'
        . 'getmultikey';
        // add keys
    foreach ($this->keys as $key) {
      $in .= "|" . $key;
    }
    $in.= "|***LOGANDB_ENDLIST***"; 
    $in.= "|"; //end messsage string
    if($debug == true){
      echo $in . "<br/>";
    } else {
      return $this->WriteReadStream($in);    
    }
     
  }
  public function SetMultiKey($keystorename){
    $in = '|' . $this->apiversion . '|' 
           . $this->authid . '|' 
           . $this->sessionid . '|' 
           . $keystorename . '|'
           . 'setmultikey';
    // add keys
    foreach ($this->keys as $key) {
      $in .= "|" . $key;
    }
    $in.= "|***LOGANDBENDLIST***"; 
    foreach ($this->values as $value) {
      $in .= "|" . $values;
    }
    $in.= "|***LOGANDBENDLIST***"; 
    $in.= "|"; //end messsage string
    return $this->WriteReadStream($in);
  }
  public function SetKey($keystorename, $key,$value){
    $in = '|' . $this->apiversion . '|' 
            . $this->authid . '|' 
            . $this->sessionid . '|' 
            . $keystorename . '|'
            . 'setkey|' 
            . $key . '|'
            . $value . '|';
    return $this->WriteReadStream($in);
  }
  public function GetKeyRange($keystorename, $startkey,$endkey,$limit = 100){
    $in = '|' . $this->apiversion . '|' 
            . $this->authid . '|' 
            . $this->sessionid . '|' 
            . $keystorename . '|'
            . 'getkeyrange|' 
            . $startkey . '|'
            . $endkey . '|'
            . $limit . "|";
    return $this->WriteReadStream($in);
  }
  public function DeleteKey($keystorename, $key){
    $in = '|' . $this->apiversion . '|' 
            . $this->authid . '|' 
            . $this->sessionid . '|' 
            . $keystorename . '|'
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
