<?php
header("Content-Type:application/json;charset=UTF-8");
require_once("../init.php");

@$uname = $_REQUEST["uname"];
@$upwd = $_REQUEST["upwd"];
@$email = $_REQUEST["email"];
@$phone = $_REQUEST["phone"];
@$user_name = $_REQUEST["user_name"];
@$user_id = $_REQUEST["user_id"];
@$gender = $_REQUEST["gender"];
$sql="insert into kaggle_users(uname,upwd,email,phone,user_name,gender) values('$uname','$upwd','$email','$phone','$user_name','$gender');";

if(!empty($_FILES["img"])){
	if($_FILES["img"]["error"]>0 ||($_FILES["img"]["size"]/1024)>200)
		$sql="insert into kaggle_users(uname,upwd,email,phone,user_name,gender,user_id) values('$uname','$upwd','$email','$phone','$user_name','$gender','$user_id');";
	else{

		$avatar_name=$uname.date("Y-m-d").$uname.".png";


		move_uploaded_file($_FILES["img"]["tmp_name"],"../../img/avatar/".$avatar_name);

		$sql="insert into kaggle_users(uname,upwd,email,phone,user_name,gender,user_id,avatar) values('$uname','$upwd','$email','$phone','$user_name','$gender','$user_id','img/avatar/$avatar_name');";
	}
}

echo mysqli_query($conn,$sql);


