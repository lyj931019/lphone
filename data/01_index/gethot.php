<?php
require_once("../init.php");


$sql = "select g.gid,g.gname,g.abs,h.index_pic from index_hot h,kaggle_games g where h.hot = 1 and h.game_id = g.gid";

$rows = sql_execute($sql,MYSQLI_ASSOC);
echo json_encode($rows);