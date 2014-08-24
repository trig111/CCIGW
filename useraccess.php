<?php
/*****************************
NOTES
 * THIS CODE is to navigate a user to the right panel based on user's access level
******************************/
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    
    //$_SESSION['username']='loppol';
//var_dump($_SESSION['username']);
require_once 'include/common.php';

require_once 'dblib/db_user.php';
//var_dump($_SESSION['username']);

//if session is not null
if (isset($_SESSION['username'])){
    
    
//     if(!isDataIllegal()) {
//         $url='/index.php';
//         redirect("whywhy whywhy", $url,'HOME');
//        
//        exit();
//    }
    //var_dump($_SESSION['username']);
    $username=  fix_str($_SESSION['username']);//preventing html injection
   
    
    $du=new Db_user();
    //var_dump($_SESSION['username']);
    $result=$du->show_single_user_access($username);
    //var_dump($result);
    
   if($result['accessid']>=3){
       // only if user's access level is >=3 then goto the superuser's panel
       header("Location: superuser.php");
       exit();
        
    }
    
    else {
        // goto normal user's panel
         header("Location: normaluser.php");
        
        exit();
    }
    
}
else {
    //any other conditions will redirect ro login page
    $url='/trylogin.php';
    redirect("illegal inputs", $url,'login');
        
        exit();
    
    
}

