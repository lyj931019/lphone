<?php
require_once('init.php');
session_start();
@$_SESSION['uid']=-1;
session_destroy();
echo -1;
//echo @$_SESSION['uid'];