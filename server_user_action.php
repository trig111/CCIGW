<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once 'include/common.php';

if(!is_admin()){
      redirect('illegal access!', 'index.php', 'Home', 5,false);
        exit();
}
$error=array();
$numofitem=count($_POST)-1;
if($numofitem==0){
     redirect('no selection has been chosen!', $_SERVER['HTTP_REFERER'], 'Users Admin', 5,false);
        exit();
}
$size=(count($_POST,1)-1-$numofitem)/$numofitem;

if(isset($_POST['edit'])&&check_2d_array('edit')){
    if(!validate()){
       redirect(implode("<br />", $error), $_SERVER['HTTP_REFERER'], 'users', 5,false);
            exit();
    }
    require_once 'dblib/db_user.php';
    require_once 'dblib/user.class.php';
    $db_user= new Db_user();
    for($i=0;$i<$size;$i++){
        $user_info = new User();
        
        $user_info->uid = $_POST["uid"][$i];
        $user_info->accessid = $_POST["accessid"][$i];
        $user_info->username = $_POST["username"][$i];
        //$user_info->userpass = $_POST["userpass"];
        $user_info->email = $_POST["email"][$i];
        $user_info->firstname = $_POST["firstname"][$i];
        $user_info->lastname = $_POST["lastname"][$i];
        $user_info->gender = $_POST["gender"][$i];
        $user_info->phonenumber = $_POST["phonenumber"][$i];
        $user_info->address = $_POST["address"][$i];
        $user_info->status = $_POST["status"][$i];
        //$user_info->lastlogin = $_POST["lastlogin"][$i];
        $user_info->identifier = $_POST["identifier"][$i];
        //$user_info->expiry_time = $_POST["expiry_time"][$i];
       // print_r($_POST);
        //
        $result=$db_user->update_user_info($user_info);
        if(!isBoolOrString($result)){
            redirect($result, $_SERVER['HTTP_REFERER'], 'Users Admin', 5,false);
            exit();  
        }
    }
    
     redirect('user info has been updated!', $_SERVER['HTTP_REFERER'], 'Users Admin',1,true);
     exit();
    
}

if(isset($_POST['delete'])&&!empty($_POST['uid'])){
    require_once 'dblib/db_user.php';
    $db_user= new Db_user();
    for($i=0;$i<$size;$i++){
        if(!is_numeric($_POST['uid'][$i]||$_POST['uid'][$i]<1)){
            $error['uid']='invalid uid';
//            redirect(implode("<br />", $error), $_SERVER['HTTP_REFERER'], 'Users Admin', 5,false);
//            exit();
        }
         $result=$db_user->delete_user_info($_POST["uid"][$i]);
         if(!isBoolOrString($result)){
            redirect($result, $_SERVER['HTTP_REFERER'], 'Users Admin', 5,false);
            exit();  
        }
    }
    redirect('user info has been deleted!', $_SERVER['HTTP_REFERER'], 'Users Admin',1,true);
     exit();
    
}


function check_2d_array($exception){
    global $size;
    $testsize=$size;
    if(!isset($_POST)||empty($_POST))return false;
    foreach($_POST as $key=>$item){
        
        if(strcmp($key, $exception)==0) continue;
        $nextsize=count($item);
        if($testsize!=$nextsize)return false;
        $testsize=$nextsize;
        foreach($item as $data){
            fix_str($data);
        }
    }
    return true;
}

function validate(){
        global $error,$size;
    for($i=0;$i<$size;$i++){
        if(!is_numeric(($_POST['status'][$i]))||$_POST['status'][$i]<0){
            $error['status']='invalid status';
            return false;
        }
         if(!is_numeric($_POST['uid'][$i])||$_POST['uid'][$i]<1){
            $error['uid']='invalid uid';
            return false;
        }
         if ((utf8_strlen($_POST['email'][$i]) > 50) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i',$_POST['email'][$i])) {
                $error['email'] ='invalid format or length of email';
                return false;
        }
             if ((utf8_strlen($_POST['username'][$i]) >10) || (utf8_strlen($_POST['username'][$i]) <1 )) {
             $error['username'] = 'invalid length of username';
        }
         if(!is_numeric(($_POST['accessid'][$i]))||$_POST['accessid'][$i]<1){
            $error['accessid']='invalid accessid';
            return false;
        }
         if ($_POST['gender'][$i]!='m'&&$_POST['gender'][$i]!='f') {
             $error['gender'] = 'invalid gender';
             return false;
        }
        if (!empty($_POST['firstname'][$i])&&utf8_strlen($_POST['firstname'][$i]) > 32) {
             $error['firstname'] = 'invalid length of firstname';
             return false;
        }
        
         if (!empty($_POST['lastname'][$i]) && utf8_strlen($_POST['lastname'][$i]) > 32) {
             $error['lastname'] = 'invalid length of lastname';
             return false;
        }

       
        if (!empty($_POST['address'][$i])&&(utf8_strlen($_POST['address'][$i]) >255 || utf8_strlen($_POST['address'][$i]) <5) ) {
             $error['address'] = 'invalid length of address';
             return false;
        }
       
      
        if (!empty($_POST['phonenumber'][$i]) && !preg_match('/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/',$_POST['phonenumber'][$i])) {
             $error['phonenumber'] = 'invalid length or format of phonenumber';
              return false;
        }
        if(!empty($_POST['identifier'][$i])&&(!is_numeric($_POST['identifier'][$i])||strlen($_POST['identifier'][$i])!=4)){
            $error['identifier'] = 'invalid format of identifier';
             return false;
        }
        
    }
    return true;
}

?>