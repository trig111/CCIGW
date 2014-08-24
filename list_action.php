<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

//require_once '../include/common.php';
require_once("dblib/db_user.php");
require_once 'dblib/user.class.php';

$db_user = new Db_user();
if (isset($_POST['delete_buttom'])) {
    
    //  should prevent injection
    foreach( $_POST["each"] as $aUser => $aUserData)
    {
       print_r($aUserData)  ;
       
//       
//        if ( isset($aUserData["uid"])){
//            echo "!!!!!";
//        }
      // echo $aUserData["uid"];
        
       $db_user->delete_user_info($aUserData[uid]);
        
    }
    
}
if ( isset($_POST['update_buttom']) ){
   
    foreach( $_POST["each"] as $aUser => $aUserData)
    {
        
        $user_info = new User();
        
        $user_info->uid = $aUserData["uid"];
        $user_info->accessid = $aUserData["accessid"];
        $user_info->username = $aUserData["username"];
        //$user_info->userpass = $aUserData["userpass"];
        $user_info->email = $aUserData["email"];
        $user_info->firstname = $aUserData["firstname"];
        $user_info->lastname = $aUserData["lastname"];
        $user_info->gender = $aUserData["gender"];
        $user_info->phonenumber = $aUserData["phonenumber"];
        $user_info->address = $aUserData["address"];
        $user_info->status = $aUserData["status"];
        $user_info->lastlogin = $aUserData["lastlogin"];
        $user_info->identifier = $aUserData["identifier"];
        $user_info->expiry_time = $aUserData["expiry_time"];
        print_r($aUserData);
        //
        $db_user->update_user_info($user_info);
       
    }
}
header("location: userpage.php");  // redirect to userpage

?>

