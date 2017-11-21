<?php 
//    header("Content-Type:application/json;charset=utf-8");
    require_once("../init.php");

    @$n = $_REQUEST["uname"];
    @$p = $_REQUEST["upwd"];

    $sql = "select * from kaggle_users where uname='$n' and upwd='$p' ";

    $row = sql_execute($sql,MYSQLI_ASSOC);

    if($row){
        echo '{"uid":'.$row[0]["uid"].',"msg":"登陆成功！"}';
        session_start();
        $_SESSION['uid']=$row[0]["uid"];

    }else{
        echo '{"uid":-1,"msg":"登陆失败！"}';
    }
?>