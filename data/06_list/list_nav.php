<?php
require_once("../init.php");
$output=[
    "labels"=>null,
    "terraces"=>null,
];

$sql="select * from label";
$output["labels"]=sql_execute($sql,MYSQLI_ASSOC);

$sql="select * from terrace";
$output["terraces"]=sql_execute($sql,MYSQLI_ASSOC);

echo json_encode($output);