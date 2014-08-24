<?php

/*****************************
NOTES
 * THIS CODE IS ONLY FOR DEMONSTRATION OF HOW TO USE FUNCTIONS UNDER THE FOLDER "/dblib"
 * SOME OF THE PRIMARY KEY VALUE ARE HARDCODED WHICH MEAN IT SHOULD BE MODIFIED,DEPENDS ON THE REAL SITUATION
******************************/

require_once ('user.class.php');
require_once ('events.class.php');
require_once ('eventsreginfo.class.php');
require_once ('news.class.php');
require_once ('db_user.php');
require_once ('db_news.php');
require_once ('db_events.php');



function userdemo() {
	$newuser = new User();
        $du= new Db_user();
        $result=NULL;
	$newuser->username='testuser1';
	$newuser->accessid=3;
	$newuser->userpass='1234';
	$newuser->created='now()';
        $newuser->email='dasdasfas';

	$result=$du->add_new_user($newuser);
        echo'<pre>',print_r("insert$result record(s)"),'</pre>';
        echo'</br></br>';
        
        
         $newuser->username='testuser0';
	$newuser->accessid=1;
	$newuser->userpass='9012';
	$newuser->created='now()';
        $newuser->email='dasffasd';
        $du->add_new_user($newuser);
//        unset($newuser);
//        $newuser = new User();
        $newuser->username='testuser2';
	$newuser->accessid=4;
	$newuser->userpass='5678';
	$newuser->created='now()';
        $newuser->email='sadasfas';
        $result=$du->add_new_user($newuser);
        echo'<pre>',print_r("insert $result record(s)"),'</pre>';
        echo'</br></br>';
        
        //show_all_user_info($offset,$number of records perpage)
        $result=$du->show_all_user_info(0,2);
        echo'<pre>',print_r($result),'</pre>';
        echo'</br></br>';
        
        $result=$du->show_corresponding_access(3);
        echo'<pre>',print_r($result),'</pre>';
        echo'</br></br>';
        
        $result=$du->show_user_info('testuser2');
        echo'<pre>',print_r($result),'</pre>';
        echo'</br></br>';
        
        $result=$du->check_user_account('testuser1', '1234' );
        if($result===True)$result='true';
        else $result='false';
        echo'<pre>',print_r($result),'</pre>';
        echo'</br></br>';
        
        $result=$du->check_user_account('testuser1', '5678' );
        if($result===True)$result='true';
        else $result='false';
        echo'<pre>',print_r($result),'</pre>';
        echo'</br></br>';
        
        //$temp=$du->show_user_info('testuser2');
        $newuser->uid=$du->show_user_info('testuser2')['uid'];
	$newuser->accessid=1;
	$newuser->userpass='8888';
	$newuser->created=NULL;
        $newuser->email='sadasfas';
        $newuser->username='testuser3';
	
        $result=$du->update_user_info( $newuser );
        if($result===True)$result='true';
        echo'<pre>',print_r($result),'</pre>';
        
        
        $newuser->uid=$du->show_user_info('testuser3')['uid'];
       $result=$du-> delete_user_info($newuser );
       if($result===True)$result='true';
        else $result='false';
        echo'<pre>',print_r($result),'</pre>';
        echo'</br></br>';
        
        $result=$du->show_all_user_info(0,2);
        echo'<pre>',print_r($result),'</pre>';
        echo'</br></br>';
        
        echo'<pre></br></br></br>       *********usertest finished*********       </br></br></br>';
}

function events_demo(){
    $evt=new Events();
    $de=new Db_events();
    
    $evt->Seteventscategory('categoryname', 'RENT');
    $de->add_category($evt);
    
    $evt->Seteventscategory('categoryname', 'EDUCATION');
     $de->add_category($evt);
     
     $result=$de->show_category_list();
       echo'<pre>',print_r($result),'</pre>';
    echo'</br></br>';
    $categoryarray=$result;
    
     $evt->Seteventscategory('categoryid', $categoryarray[0]['categoryid']);
     $evt->Seteventscategory('categoryname', 'SELL');
     $de->update_category($evt);
     
    $result=$de->show_corresponding_category($categoryarray[0]['categoryid']);
    echo'<pre>',print_r($result),'</pre>';
    echo'</br></br>';
    
    $evt->Seteventscategory('categoryid', $categoryarray[1]['categoryid']);
    $de->delete_category($evt);
    
     $result=$de->show_category_list();
       echo'<pre>',print_r($result),'</pre>';
    echo'</br></br>';      
    
   
     $evt->subject='test topic1';
           $evt->readaccess=10;
            $evt->body='body test1';
            $evt->categoryid=$categoryarray[0]['categoryid'];
            $evt->uid=1;
            
           
    $result=$de->post_events($evt);
    echo'<pre>',print_r($result),'</pre>';
        echo'</br></br>';
        
        
            $evt->subject='test topic2';
            $evt->readaccess=20;
            $evt->body='body test2';
            $evt->categoryid=$categoryarray[0]['categoryid'];
            $evt->uid=1;
             $result=$de->post_events($evt);
            echo'<pre>',print_r($result),'</pre>';
             echo'</br></br>';
            
    
   $result= $de->show_events_list(0,4);
    echo'<pre>',print_r($result),'</pre>';
        echo'</br></br>';
        
        $temp=$result[0]['eventsid'];
       $result= $de->show_single_event($temp);
       echo'<pre>',print_r($result),'</pre>';
        echo'</br></br>';
        
        $evt->eventsid=(int)$temp;
        $evt->subject='update topic';
        $evt->readaccess=30;
        $evt->body='blablabla';
        $evt->categoryid=$categoryarray[0]['categoryid'];
        $evt->uid=1;
        $result= $de->update_events($evt);
        echo'<pre>',print_r($result),'</pre>';
        echo'</br></br>';
        
        $result= $de->show_single_event($temp);
       echo'<pre>',print_r($result),'</pre>';
        echo'</br></br>';
        
        $evt->eventsid=(int)$temp;
        
        $result= $de->delete_events($evt);
       echo'<pre>',print_r($result),'</pre>';
        echo'</br></br>';
        
         $result= $de->show_events_list(0,4);
    echo'<pre>',print_r($result),'</pre>';
        echo'</br></br>';
 
   
            $evt->Seteventsreply('eventsid',2);
            $evt->Seteventsreply('body','body text test1');
            $evt->Seteventsreply('uid',1);
            
          $de->add_reply($evt );  
          
           $evt->Seteventsreply('eventsid',2);
            $evt->Seteventsreply('body','tst body222222');
            $evt->Seteventsreply('uid',2);
            
          $de->add_reply($evt );
         $result=$de->show_corresponding_reply(2);
          echo'<pre>',print_r($result),'</pre>';
        echo'</br></br>';
        
        
            $evt->Seteventsreply('eventsid',2);
            $evt->Seteventsreply('body','body updated testreply1');
            $evt->Seteventsreply('uid',2);
            $evt->Seteventsreply('replytime', $result[0]['replytime']);
             $de->update_reply( $evt );
         $result=$de->show_corresponding_reply(2);
          echo'<pre>',print_r($result),'</pre>';
        echo'</br></br>';
        
          $evt->Seteventsreply('eventsreplyid', $result[1]['eventsreplyid']);
           $de-> delete_reply($evt);
       
         $result=$de->show_corresponding_reply(2);
          echo'<pre>',print_r($result),'</pre>';
        echo'</br></br>';
    
   $reg =new Eventsreginfo();
   
    
            $reg->eventsid=2;
            $reg->uid=1;
            $reg->numberofpeople=7;
            $reg->price=7;
            $reg->remarks='remarks test';
            
            
            $result=$de->register_event($reg);
            echo'<pre>',print_r($result),'</pre>';
            echo'</br></br>';
            
            $reg->eventsid=2;
            $reg->uid=2;
            $reg->numberofpeople=255;
            $reg->price=255;
            $reg->remarks='lalalalallala';
            
            
            $result=$de->register_event($reg);
            echo'<pre>',print_r($result),'</pre>';
            echo'</br></br>';
            
          $result= $de-> show_register_list(0,2);
           echo'<pre>',print_r($result),'</pre>';
            echo'</br></br>';
            
            $reg->eventsid=2;
            $reg->uid=1;
            $reg->numberofpeople=1000;
            $reg->price=0;
            $reg->remarks='update test';
            $reg->regid=$result[1]['regid'];
            
            $de->update_registration( $reg );
           
         $result= $de->show_single_register( $result[1]['regid']);
            echo'<pre>',print_r($result),'</pre>';
            echo'</br></br>';
            
           $reg->regid=$result['regid'];
           $de->cancel_register($reg); 
           
           $result= $de-> show_register_list(0,2);
           echo'<pre>',print_r($result),'</pre>';
            echo'</br></br>';
        
    echo'<pre></br></br></br>       *********eventstest finished*********       </br></br></br>';
}

function news_demo(){
    
    $dn=new Db_news();
    $news=new News();
    
    $news->subject='test news1';
           $news->readaccess=10;
            $news->body='news body test1';
           $news->categoryid=2;
           $news->uid=1;
    
   $result= $dn->post_news($news);
    echo'<pre>',print_r($result),'</pre>';
            echo'</br></br>';
            
            
            $news->subject='test news2';
           $news->readaccess=55;
            $news->body='news body test22222';
           $news->categoryid=2;
           $news->uid=2;
           
     $result=$dn->post_news($news);
      echo'<pre>',print_r($result),'</pre>';
            echo'</br></br>';
            
            
     
     $result=$dn->show_all_news( 0,2 );
     echo'<pre>',print_r($result),'</pre>';
            echo'</br></br>';
            
         $news->subject='update news2';
           $news->readaccess=99;
            $news->body='update body test22222';
           $news->categoryid=2;
           $news->uid=2;
           $news->newsid=$result[1]['newsid'];
           $temp=$result[1]['newsid'];
           $result=$dn->update_news($news);
           echo'<pre>',print_r($result),'</pre>';
            echo'</br></br>';
            
            $result=$dn->show_single_news($temp);
            echo'<pre>',print_r($result),'</pre>';
            echo'</br></br>';
             $news->newsid=$temp;
             $dn-> delete_news($news);
           
           
           $result=$dn->show_all_news(0,2);
            echo'<pre>',print_r($result),'</pre>';
            echo'</br></br>';
           
    echo'<pre></br></br></br>       *********newstest finished*********       </br></br></br>';
    
}

?>
