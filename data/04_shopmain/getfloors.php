<?php
require_once("../init.php");

$floors =array(
"pc"=>null,
"net"=>null,
 "host"=>null,
  "phone"=>null
  );


$sql ="select DISTINCT g.gid,g.gname,g.abs,g.price,l.logo from index_hot h,kaggle_games g,game_logo l where h.pc_g = 1 and h.game_id = g.gid and l.game_id = g.gid order by g.gid";

$floors["pc"] = sql_execute($sql,MYSQLI_ASSOC);

$sql ="select DISTINCT g.gid,g.gname,g.abs,g.price,l.logo from index_hot h,kaggle_games g,game_logo l where h.net = 1 and h.game_id = g.gid and l.game_id = g.gid order by g.gid";

$floors["net"] = sql_execute($sql,MYSQLI_ASSOC);

$sql ="select DISTINCT g.gid,g.gname,g.abs,g.price,l.logo from index_hot h,kaggle_games g,game_logo l where h.host = 1 and h.game_id = g.gid and l.game_id = g.gid order by g.gid";

$floors["host"] = sql_execute($sql,MYSQLI_ASSOC);

$sql ="select DISTINCT g.gid,g.gname,g.abs,g.price,l.logo from index_hot h,kaggle_games g,game_logo l where h.phone = 1 and h.game_id = g.gid and l.game_id = g.gid order by g.gid";

$floors["phone"] = sql_execute($sql,MYSQLI_ASSOC);

echo json_encode($floors);