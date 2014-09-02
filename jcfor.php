<?php
require_once 'include/common.php';
require_once ("dblib/db_user.php");
header("content-type:text/html; charset=gb2312");
//echo "11111111";
/*
 *compare the username with the username which is in the database
 */

if (isset($_GET['id'])&&isset($_GET['filed'])) {
$id=fix_str($_GET['id']);
$filed=fix_str($_GET['filed']);
 $du = new Db_user();   //connect database 
    $du = new Db_user();   //connect database          
    if($filed==='name'){
    	$result = $du->check_user_name_and_email($id,'');// check if the username existed
    	if($result)echo "username not exist";
   		 else echo "username exist";
    }
    else if($filed==='email'){
    	$result = $du->check_user_name_and_email('',$id);// check if the username existed
    	if($result)echo "email not exist";
   		 else echo "email exist";
    }
    else echo "you are playing around!";
}
?>
