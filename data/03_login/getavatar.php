<?php

header("Content-Type:application/json;charset=UTF-8");
require_once("../init.php");

session_start();
if($_SESSION['uid']){
    $uid = $_SESSION['uid'];
    $sql = "select uid,avatar from kaggle_users where uid=$uid";
    $row = sql_execute($sql,MYSQLI_ASSOC)[0];
    echo json_encode($row);
}