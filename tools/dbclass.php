<?php

class MyPOSDB {
  protected $host =  DB_SERVER;
  protected $user = DB_USERNAME;
  protected $password = DB_PASSWORD;
  protected $database = DB_DATABASE;
  
  function __construct() {
    $conn = $this->connectDB();
    if(!empty($conn)) {
      $this->selectDB($conn);
    }
  }
  
  function connectDB() {
    $conn = mysql_connect($this->host,$this->user,$this->password);
    return $conn;
  }
  
  function selectDB($conn) {
    mysql_select_db($this->database,$conn);
  }

  function closeDB(){
    mysql_close();
    }
    
}
  ?>