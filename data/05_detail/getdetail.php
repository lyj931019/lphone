<?php
require_once("../init.php");

@$gid = $_REQUEST["gid"];

$sql = "select * from kaggle_games where gid=$gid";
$result = mysqli_query($conn,$sql);
if(!$result){
 $gid = 1;
}
$game_details =array(
"details"=>null,
"terraces"=>null,
 "labels"=>null,
  "imgs"=>null,
   "specs"=>null,
   "phone_qr"=>null
  );
$sql = "select  g.gid,g.gname,g.abs,g.intr,g.price,g.market,l.logo from kaggle_games g,game_logo l where g.gid=$gid and g.gid=l.game_id";

$game_details["details"] = sql_execute($sql,MYSQLI_ASSOC);


$sql = "select pic from game_pic where game_id=$gid ";
$game_details["imgs"] = sql_execute($sql,MYSQLI_ASSOC);


$sql = "select t.tname from game_terrace g,terrace t where g.game_id=$gid and g.terrace_id = t.tid";
$game_details["terraces"] = sql_execute($sql,MYSQLI_ASSOC);

$sql = "select l.lname from game_label g,label l where g.game_id=$gid and g.label_id = l.lid";
$game_details["labels"] = sql_execute($sql,MYSQLI_ASSOC);

if($game_details["terraces"][0]["tname"]=="Android" || $game_details["terraces"][0]["tname"]=="IOS" ){
   $sql = "select android,ios from phone_qr where game_id=$gid";
   $game_details["phone_qr"] = sql_execute($sql,MYSQLI_ASSOC);
}else{
   $sql = "select cpu,graphics,memory,hardpan,ishigh from spec where game_id=$gid";
   $game_details["specs"] = sql_execute($sql,MYSQLI_ASSOC);
}



echo json_encode($game_details);