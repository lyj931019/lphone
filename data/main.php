<?php

header("Content-Type:application/json;charset=utf-8");
session_start();
if($_SESSION['uid']){
    echo $_SESSION['uid'];
}else{
    echo "error";
}