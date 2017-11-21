<?php
require_once("../init.php");

@$key = $_REQUEST["key"];

$sql = "select g.gid,g.gname,g.abs,l.logo from game_logo l,kaggle_games g where l.game_id = g.gid ORDER BY $key desc limit 0,3";

$rows = sql_execute($sql,MYSQLI_ASSOC);
echo json_encode($rows);