<?php
require_once("../init.php");

@$key = $_REQUEST["key"];


$sql ="select DISTINCT g.gid,g.gname,g.abs,l.logo from index_hot h,kaggle_games g,game_logo l where h.$key = 1 and h.game_id = g.gid and l.game_id = g.gid order by g.gid";

$rows = sql_execute($sql,MYSQLI_ASSOC);



echo json_encode($rows );