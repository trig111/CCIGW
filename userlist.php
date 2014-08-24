<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once 'dblib/db_user.php';
require_once 'dblib/db_events.php';
require_once 'dblib/db_news.php';

function show_users_list() {
//echo <<<zzeof
//<script src="js/group5js/check.js" type="application/javascript"></script>
//
//zzeof;
    echo '<script language="JavaScript">
  <!--
function selectKind(uid){
var attr = new Array(
                        "uid"+uid,
                       "accessid"+uid,    
                        "username"+uid,    
               //         "userpass"+uid,    
                        "email"+uid,        
                        "firstname"+uid,   
                        "lastname"+uid,     
                        "gender"+uid,      
                        "phonenumber"+uid, 
                        "address"+uid,      
                        "status"+uid,       
                        "lastlogin"+uid,   
                        "identifier"+uid,   
                        "expiry_time"+uid  );

  var c="c"+uid;
  var isTrue=true;
  if(document.getElementById(c).checked)
      isTrue=false;
               
  for (var i = 0; i < attr.length; i++){
     // if ( i !== 0 && i !== 1 )
      document.getElementById(attr[i]).disabled=isTrue;
      }

}
//-->
</script>';
    //header('Content-Type: text/plain');
    $db_user = new Db_user();
    $user_list = $db_user->show_all_user_info(0, 100);
    echo'<form action="list_action.php" method="POST">';
    echo '<table><tr>';
    $user_info = $user_list[0];
    echo '<td></td>'; // place holder
    foreach ($user_info as $title => $value_not_use) {
        if ($title === "userpass")
            continue; //disable password
        echo '<td>', $title, '</td>';
    } // this is to print out the title of the table
    echo '</tr>';
    $i = 0;
    foreach ($user_list as $user_id => $user_info) {
        echo '<tr>';
        echo '<td>', '<input type="checkbox" name="checkbox[]" id="', 'c' . $user_info['uid'], '"', 'value="', $user_info['uid'], '" onclick="selectKind(', $user_info['uid'], ') " ></td>';
        //echo '<td>', '<input type="checkbox" name="checkbox[]" id="','c'.$user_info['uid'], '"', 'value="',$user_info['uid'],'" onclick="displayItems("hello");" ></td>';
        // here make the checkbox have the name form of "admin_checkboc_.$user_id"


        foreach ($user_info as $title => $value) {
            if ($title === "userpass")
                continue; //disable password

            $titles = "each[$i][$title]";
            //echo $titles;

            echo '<td>', '<input type="text" name="', $titles, '"', 'value="', $value, '" id="', $title . $user_info['uid'], '" disabled></td>';
        }
        echo '</tr>';
        $i++;
    }

    echo '</table>';
    echo '<div>click the checkbox to choose which user information you want to delete or modify</div>';
    echo '<input type="submit" name="delete_buttom" value="Delete" />
    <input type="submit" name="update_buttom" value="Update" /></form>';
}

function show_event_list() {
    $event_handle = new Db_events();
     echo'<form action="event_action.php" method="POST">';
    echo '<table width=400 ><tr><td></td><td>eventsid</td><td>Event title</td>';
    
    foreach ($event_handle->show_events_list(0, 50) as $aEvent) {

//        print_r($aEvent);
        
        echo  '<tr><td><input type="checkbox" name="checkbox_events[]"   value="', $aEvent['eventsid'] ,'"></td>' ,
        ' <td> ' , $aEvent['eventsid'] , '</td><td>' ,
    
           '<a href="event_manage.php?eventsid=', $aEvent["eventsid"]
         , '" > ', $aEvent['subject'], '</a> </Std></tr>
   
';
    }
    echo '</table>';
     echo '<input type="submit" name="delete_event" value="Delete selected events" />';  
    echo '<a href="event_create_page.php">
   <input type="button" value="Create a new event" /></a></form>';
}



function show_news_list() {
    $news_handle = new Db_news();
     echo'<form action="news_action.php" method="POST">';
    echo '<table width=400 ><tr><td></td><td>newsid</td><td>News title</td>';
    
    foreach ($news_handle->show_all_news(0, 50) as $aNews ) {

//        print_r($aEvent);
        
        echo  '<tr><td><input type="checkbox" name="checkbox_news[]"   value="', $aNews['newsid'] ,'"></td>' ,
        ' <td> ' , $aNews['newsid'] , '</td><td>' ,
    
           '<a href="news_manage.php?newsid=', $aNews["newsid"]
         , '" > ', $aNews['subject'], '</a> </Std></tr>
   
';
    }
    echo '</table>';
    echo '<input type="submit" name="delete_news" value="Delete selected news" />';  
    echo '<a href="news_create_page.php">
        <input type="button" value="Create a new news" /></a></form>';
}
?>