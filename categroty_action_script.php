<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once("include/common.php");
require_once ('dblib/events.class.php');
require_once ('dblib/db_events.php');
$result=array();

if(isset($_POST['action'],$_POST['key'])){
    $action= fix_str($_POST['action']);
    $key=fix_str($_POST['key']);
    $evt=new Events();
    $de=new Db_events();
    if(strcmp($action,"add")==0){
     $evt->Seteventscategory('categoryname',$key);
     $de->add_category($evt);
    }
    elseif(strcmp($action,"delete")==0){
     $evt->Seteventscategory('categoryid',$key);
    $de->delete_category($evt);
    }
    
    $result=$de->show_category_list();
    
    foreach ($result as $key)echo'<option value ="',$key['categoryid'],'"','id="',$key['categoryname'],'">',$key['categoryname'],'</option>';
}


    
