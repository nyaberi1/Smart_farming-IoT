<?php
include 'database.php';


//get newline 
if (!empty($_POST)) {
  // keep track post values
  $id = $_POST['id'];

  $myObj = (object)array();

  //........................................ 
  $pdo = Database::connect();

  $sql = 'SELECT * FROM dht11 WHERE id="' . $id . '"';
  foreach ($pdo->query($sql) as $row) {
    //$date = date_create($row['date']);
    //$dateFormat = date_format($date,"d-m-Y");

    $myObj->id = $row['id'];
    $myObj->sensor = $row['sensor'];
    $myObj->location = $row['location'];
    $myObj->temperature = $row['temperature'];
    $myObj->humidity = $row['moisture'];
    $myObj->ls_time = $row['reading_time'];
    //$myObj->ls_date = $dateFormat;

    $myJSON = json_encode($myObj);

    echo $myJSON;
  }
  Database::disconnect();
  //........................................ 
}
//---------------------------------------- 
