<?php

define('HOST', 'localhost');
define('DBNAME', 'fb');
define('USERNAME', 'root');
define('PASSWORD', '');

define('KEY', '123456');

function get_db(){
  try{
    $conn = new PDO('mysql:host='.HOST.'; dbname='. DBNAME, USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
  }catch(PDOExecption $e){
    die("Error: " . $e->getMessage());
  }
}

?>
