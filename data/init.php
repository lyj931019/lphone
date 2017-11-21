<?php
header("Content-Type:application/json;charset=UTF-8");
header('Access-Control-Allow-Origin:http://localhost:8100');
header('Access-Control-Allow-Credentials:true');
$db_host = '127.0.0.1';
$db_user = 'root';
$db_password = '';
$db_database = 'kaggle';
$db_port = 3306;
$db_charset = 'UTF8';

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_database, $db_port);
mysqli_query($conn, "SET NAMES $db_charset");
function sql_execute($sql,$arr_type){
    global $conn;
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, $arr_type);
}