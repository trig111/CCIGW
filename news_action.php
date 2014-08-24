<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once ("dblib/db_news.php");
require_once ("dblib/db_events.php");
require_once ("dblib/news.class.php");
require_once 'include/common.php';
$news_handle = new Db_news();
$aNews = new News();
$event_handle = new Db_events();
//print_r($_POST);
if (isset($_POST['submit_modify'] )) 
{
    //print_r($_POST);
    if ( isset($_POST['news_title']) && isset($_POST['news_body']) && isset($_POST['news_id'])
            && isset($_POST['news_uid']))
    {
        //print_r($_POST);
        $_POST['news_title'] = fix_str( $_POST['news_title']);
        $_POST['news_id'] = fix_str( $_POST['news_id']);
        $_POST['news_uid'] = fix_str( $_POST['news_uid']);
        $categoryarray=$event_handle->show_category_list();
        $aNews->categoryid=$categoryarray[0]['categoryid'];
        $aNews->uid=$_POST['news_uid'];
        $aNews->newsid=$_POST['news_id'];
        $aNews->body=$_POST['news_body'];
        $aNews->subject=$_POST['news_title'];
       // $aNews->readaccess=99;
        $result= $news_handle->update_news($aNews);
        
        header("Location: superuser.php");
        var_dump($result);
        
    }
 
    
} elseif (isset ($_POST['delete_news']))
{
    if ( isset($_POST['checkbox_news']))
    {
        $_POST['checkbox_news'] = fix_str( $_POST['checkbox_news']); // prevent html injection
        foreach ($_POST['checkbox_news'] as $news_id_delete ){
            $aNews->newsid=$news_id_delete;
            $news_handle->delete_news($aNews);
        }
        header("Location: superuser.php");
    }
} elseif( isset($_POST['submit_new_news']))
{
    //print_r($_POST);
    if ( isset($_POST['news_uid']) && isset($_POST['news_body']) && isset($_POST['news_title']))
    {
        
        $_POST['news_uid'] = fix_str( $_POST['news_uid']); // prevent html injection
        $_POST['news_title'] = fix_str( $_POST['news_title']); // prevent html injection
        $categoryarray=$event_handle->show_category_list();
        $aNews->subject=$_POST['news_title'];
        $aNews->readaccess=20;
        $aNews->body=$_POST['news_body'];
        $aNews->categoryid=$categoryarray[0]['categoryid'];
        $aNews->uid=$_POST['news_uid'];
        $result=$news_handle->post_news($aNews);
        header("Location: superuser.php");
    }
    
}