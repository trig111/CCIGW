<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once 'include/common.php';

$uid= isset($_POST['uid']) ? fix_str($_POST['uid']) : fix_str($_GET['uid']);
    if(!is_legal_access($uid)&&!is_admin()){
        redirect('illegal access!', 'index.php', 'Home', 5,false);
        exit();
    }
    require_once ("dblib/db_news.php");
    require_once ("dblib/news.class.php");
    $news_handle= new Db_news();
    $aNews = new News();


if (isset($_POST['modify'])) {

    if(!clean('post',$keys=array())||!validate()||!is_numeric($_POST['newsid'])||$_POST['newsid']<1){
        if(empty($error))$error['eventsid_or_clean']='invalid newsid or post request';
        redirect(implode("<br />", $error), $_SERVER['HTTP_REFERER'], 'News', 5,false);
        exit();
    }
        $aNews->newsid=$_POST['newsid'];
        $aNews->subject=$_POST['subject'];
        $aNews->readaccess=0;
        $aNews->body=$_POST['body'];
        $aNews->categoryid=$_POST['categoryid'];
        $aNews->uid=$_POST['uid'];
        
        $result=$news_handle->update_news($aNews);
        if(!isBoolOrString($result)){
            
            redirect($result, $_SERVER['HTTP_REFERER'], 'News', 5,false);
            exit();
        }
                
        redirect('your (news) post now is updated', 'News.php?pg=1', 'News', 1,true);//should redirect to prev page
        exit();
        
    }

elseif( isset($_POST['submit']))
{
    if(!clean('post',$keys=array())||!validate()){
        if(empty($error))$error['lean']='invalid post request';
        redirect(implode("<br />", $error), $_SERVER['HTTP_REFERER'], 'News', 5,false);
        exit();
    }
        $aNews->subject=$_POST['subject'];
        $aNews->readaccess=0;
        $aNews->body=$_POST['body'];
        $aNews->categoryid=$_POST['categoryid'];
        $aNews->uid=$_POST['uid'];
        
        $result=$news_handle->post_news($aNews);
        if(!isBoolOrString($result)){
            
            redirect($result, $_SERVER['HTTP_REFERER'], 'News', 5,false);
            exit();
        }
                
        redirect('your (news) post now is submitted', 'News.php?pg=1', 'News', 1,true);//should redirect to prev page
        exit();
}
elseif(isset($_GET['action'])&&clean('get',$keys=array())&&strcmp($_GET['action'],'delete')==0){
        if(!is_numeric(($_GET['newsid']))||$_GET['newsid']<1){
            $error['newsid']='invalid newsid';
             redirect(implode("<br />", $error), $_SERVER['HTTP_REFERER'], 'News', 5,false);
            exit();
        }
        
        
        $result=$news_handle->delete_news($_GET['newsid']);
        if(!isBoolOrString($result)){
            redirect($result, $_SERVER['HTTP_REFERER'], 'News', 5,false);
            exit();
        }
        
        redirect("the (news) post now is deleted",'News.php?pg=1', 'News', 1,true);
        exit();  
}
else{
    redirect('unforeseen error...', $_SERVER['HTTP_REFERER'], 'News', 5,false);
    exit();
}

function validate(){
        global $error;
//        if(!is_numeric(($_POST['newsid']))||$_POST['newsid']<1){
//            $error['newsid']='invalid newsid';
//        }
         if(!is_numeric($_POST['uid'])||$_POST['uid']<1){
            $error['uid']='invalid uid';
        }
          
        
         if ((utf8_strlen($_POST['body']) < 11)) {
             $error['body'] = 'invalid length of body';
        }
          if(!is_numeric($_POST['categoryid'])||$_POST['categoryid']<1){
            $error['categoryid']='invalid categoryid';
        } 

        if (utf8_strlen($_POST['subject']) >25||utf8_strlen($_POST['subject']) <3) {
             $error['subject'] = 'invalid length of subject';
        }
        
        if(!empty($error)) {
            
            
            return false;
        }
        else return true;
    }
?>