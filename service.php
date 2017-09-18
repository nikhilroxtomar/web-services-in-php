<?php

include('config.php');
$conn = get_db();

header("Content-Type:application/json");

function respond($status, $msg, $data){
  header("HTTP/1.1 $status $msg");
  $resp['status'] = $status;
  $resp['msg'] = $msg;
  $resp['data'] = $data;
  echo json_encode($resp);
}

if( !isset($_REQUEST['key']) || trim($_REQUEST['key']) != KEY ){
  respond("201", "Invalid Key Value.", NULL);
  die();
}

if(!isset($_REQUEST['action'])){
  respond("201", "Please provide action parameter value in URL.", NULL);
  die();
}

$action = trim($_REQUEST['action']);

if($action == 'userinfo'){
  if( !isset($_REQUEST['uid']) ){
    respond("201", "Invalid uid(User Id)", NULL);
    die();
  }

  $uid = $_REQUEST['uid'];
  $stmt = $conn->prepare("SELECT fname, lname, email FROM user WHERE uid = $uid");
  $stmt->execute();

  if($stmt->rowCount() <= 0){
    respond("201", "Invalid uid(User Id)", NULL);
  }else{
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $data = $stmt->fetch();
    respond("200", "Success", $data);
  }

} else{
  respond("201", "No Service Found", NULL);
}

?>
