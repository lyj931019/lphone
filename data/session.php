<?php
require_once('init.php');
session_start();
if(@$_SESSION['uid']){
    echo @$_SESSION['uid'];
}else{
    echo -1;
}