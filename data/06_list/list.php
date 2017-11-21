<?php

require_once("../init.php");
@$pno = $_REQUEST["pno"];
@$label = $_REQUEST["label"];
@$terrace = $_REQUEST["terrace"];//多个值用 " , " 隔开

$gid=[];
$gid_label=[];
$gid_terrace=[];


if(!$pno){
    $pno=1;
}else{
    $pno = intval($pno);
}
$pageSize=10;
$output = [
    "recodeCount"=>0,
    "pageCount"=>0,
    "pno"=>$pno,
    "data"=>null,
    "pageSize"=>$pageSize
];



function myArrayNoRepeat($arr){
    $arr2=[];
    array_push($arr2,$arr[0]);
    for($i=0;$i<count($arr);$i++){
        if(!in_array($arr[$i],$arr2)){
            array_push($arr2,$arr[$i]);
        }
    }
    return $arr2;
}
if($label){
    $labels = explode(",",$label);
    $gid_repeat = [];
    for($i=0;$i<count($labels);$i++){
        $sql="select g.gid from kaggle_games g,game_label l where g.gid=l.game_id and l.label_id=$labels[$i]";
        $gid_repeat = array_merge($gid_repeat,sql_execute($sql,MYSQLI_ASSOC));
//        var_dump(sql_execute($sql,MYSQLI_ASSOC));
    }
//    var_dump($gid_repeat);
    $gid_label = myArrayNoRepeat($gid_repeat);
}


if($terrace){
    $terraces = explode(",",$terrace);
    $gid_repeat = [];
    for($i=0;$i<count($terraces);$i++){
        $sql="select g.gid from kaggle_games g,game_terrace t where g.gid=t.game_id and t.terrace_id=$terraces[$i]";
        $gid_repeat = array_merge($gid_repeat,sql_execute($sql,MYSQLI_ASSOC));
//        var_dump(sql_execute($sql,MYSQLI_ASSOC));
    }
//    var_dump($gid_repeat);
    $gid_terrace = myArrayNoRepeat($gid_repeat);
}
$gid = array_merge($gid_label,$gid_terrace);



//如果用户有选择平台或标签,则先查出所有游戏的id,并逐个gid查出对应信息,并拼入$result中
if(count($gid)>0){

    for($i=0;$i<count($gid);$i++){
        $gid[$i]=$gid[$i]["gid"];
    }

    $gid = myArrayNoRepeat($gid);
//    var_dump($gid);

    $result=[];
    for($i=0;$i<count($gid);$i++){
        $id = $gid[$i];

        $sql="select DISTINCT g.gid,g.gname,g.abs,g.intr,g.price,g.market,o.logo,group_concat(l.lname separator '/') label, group_concat(t.tname separator '/') terrace from kaggle_games g,game_logo o,game_label gl,label l,terrace t,game_terrace gt where g.gid=o.game_id and l.lid=gl.label_id and gl.game_id=g.gid and t.tid=gt.terrace_id and gt.game_id=g.gid and g.gid=$id group by g.gid";
//        var_dump($sql);
        $result = array_merge($result,sql_execute($sql,MYSQLI_ASSOC));
    }
}else{
    $sql="select DISTINCT g.gid,g.gname,g.abs,g.intr,g.price,g.market,o.logo,group_concat(l.lname separator '/') label, group_concat(t.tname separator '/') terrace from kaggle_games g,game_logo o,game_label gl,label l,terrace t,game_terrace gt where g.gid=o.game_id and l.lid=gl.label_id and gl.game_id=g.gid and t.tid=gt.terrace_id and gt.game_id=g.gid group by g.gid";

    $result = sql_execute($sql,MYSQLI_ASSOC);
}

//将查出的数据中的平台,标签 去重
function myNoRepeat($str){
    $arr = explode("/",$str);
    $arr2=[];
    array_push($arr2,$arr[0]);
    for($i=0;$i<count($arr);$i++){
        if(!in_array($arr[$i],$arr2)){
            array_push($arr2,$arr[$i]);
        }
    }
    $myStr=array_reduce($arr2,function($v1,$v2){
        return $v1 . " / " . $v2;
    });

    return $myStr;
}
for($i=0;$i<count($result);$i++){
    $result[$i]["label"] = myNoRepeat($result[$i]["label"]);
    $result[$i]["label"] = substr($result[$i]["label"],2);
    $result[$i]["terrace"] = myNoRepeat($result[$i]["terrace"]);
    $result[$i]["terrace"] = substr($result[$i]["terrace"],2);
}


//循环 将数据量*10

$output["data"]=$result;
for($i=0;$i<10;$i++){
    $output["data"]=array_merge($output["data"],$result);
}




$output["recodeCount"]=count($output["data"]);
$output["pageCount"]=ceil($output["recodeCount"]/$output["pageSize"]);

function myLimit($pno,$pageSize,$arr1,$output){
    $count=0;
    $index = ($pno-1)*$pageSize;
    if($pno<$output["pageCount"]){
        $count=$pageSize;
    }else{
        $count = $output["recodeCount"]-($index);
    }
    $arr2=[];
    for($i=0;$i<$count;$i++){
        array_push($arr2,$arr1[$i+$index]);
    }
    return $arr2;

}

$output["data"]=myLimit($pno,$pageSize,$output["data"],$output);

echo json_encode($output);