<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once 'include/common.php';

    if(!is_admin()){
        redirect('illegal access!', 'index.php', 'Home', 5,false);
        exit();
    }
  

$error=array();
if (isset($_POST['submit'])&&  validate()) {
    
    $temp=array();
    array_push($temp,$_POST['size']);
    array_push($temp,$_POST['slider']);
    $slider=  json_encode($temp);
    unset($temp);
    $temp = array();
    array_push($temp,$_POST['title']);
    array_push($temp,$_POST['line1']);
    array_push($temp,$_POST['line2']);
    array_push($temp,$_POST['link']);
    $jumbo=json_encode($temp);
    $limit=json_encode($_POST['limit']);
    if (!copy('home_page_setting.txt', 'home_page_setting_backup.txt')) 
    {
    echo "failed to copy $file...\n";}
    $myfile = fopen( "home_page_setting.txt", "w" ) or die( "Unable to open file!" );
    fwrite( $myfile, "$slider\n" );
    fwrite( $myfile, "$jumbo\n" );
    fwrite( $myfile, "$limit\n" );
    fclose($myfile);
    
redirect("Home page setting now is updated",$_SERVER['HTTP_REFERER'], 'Admin Home Page', 1,true);
    exit();  
}
else{
    redirect("unforeseen error occured",$_SERVER['HTTP_REFERER'], 'Admin Home Page', 5,false);
    exit(); 
}
    
    function validate(){
        global $error;
       if(!check_2d_array($_POST['slider'],"''url''")){
           $error['slider']='missing one or more fileds on the carousel section';
       }
       if(!isset($_POST['size'])||!is_numeric($_POST['size'])||$_POST['size']<1){
           $error['size']='invalid total number on the carousel section';
       }
        if(!isset($_POST['title'])||empty($_POST['title'])){
           $error['title']='invalid title';
       }
        if(!isset($_POST['line1'])||empty($_POST['line1'])){
           $error['line1']='invalid paragraph1';
       }
       if(!isset($_POST['line2'])||empty($_POST['line2'])){
           $error['line1']='invalid paragraph2';
       }
        if(!isset($_POST['link'])){
           $error['line1']='invalid link to';
       }
       if(!isset($_POST['limit'])||!is_numeric($_POST['limit'])||$_POST['limit']<1){
           $error['size']='invalid total display';
       }
        
         if(!empty($error)) {
            
            
            return false;
        }
        else return true;
        
    }
    
    function check_2d_array($target,$exception){
   
    if(!isset($target)||empty($target))return false;
    foreach($target as $key=>$item){
        
       
            foreach($item as $data){
                if(strcmp($key, $exception)==0) {
                    if(!isset($data)) return false;
                }
                else{
                    if(!isset($data)||empty($data)) return false;
                }
  
            }
    return true;
    }
}
    