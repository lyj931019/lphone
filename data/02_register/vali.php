<?php
header("Content-Type:application/json;charset=UTF-8");
require_once("../init.php");

$uname = $_REQUEST["uname"];

$sql="select * from kaggle_users where uname='$uname';";


$result=sql_execute($sql,MYSQLI_ASSOC);
if($result!=null){
	echo true;
}else{
	echo 0;
}