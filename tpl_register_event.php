<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once("include/common.php");
if(!is_user_logged_in()&&!is_admin()){
    redirect('illegal access!', $_SERVER['HTTP_REFERER'], 'Events', 5,false);
    exit();
}

if(!clean('get',$keys=array())){
    redirect('illegal access!', $_SERVER['HTTP_REFERER'], 'Events', 5,false);
    exit();
}
$error=array();
if(!validate()){
    redirect(implode("<br />", $error), $_SERVER['HTTP_REFERER'], 'Events', 5,false);//should redirect to prev page
    exit();
}

$css=array();
$js=array();
getHeader("Register Events", $css, $js);
output_page_menu();
require_once ("dblib/db_events.php");
require_once ("dblib/db_user.php");

    $user_handle= new Db_user();
       
    $result=$user_handle->show_user_info( $_SESSION['username']);
    if(!isArrayOrString($result)){
        redirect($result, $_SERVER['HTTP_REFERER'], 'Events', 5,false);
        exit();
    }
    $event_handle = new Db_events();
    $subject=$event_handle->show_single_event_name($_GET['eventsid']);
    $checked=array('','');
    if($result['gender']=='m')$checked[0]='checked';
    else $checked[1]='checked';

echo <<< ZZEOF
    
    <form action="server_register_event_action.php" method="POST">
    
    
    
    <fieldset>
    <legend>Event Info</legend>
                 

                        event name:(*)<br />

                         <input  type="text"  value="$subject" readonly>
                          <input type="hidden" name="eventsid" value="{$_GET['eventsid']}" readonly>
                          <input type="hidden" name="uid" value="{$result['uid']}" readonly><br />

                        number of people:(*)<br />

                         <input name="numberofpeople" type="text"><br />
                        remarks(optional):<br />

                         <input name="remarks" type="text"><br />
                          
                           
                

                    
</fieldset>
        <fieldset>
    <legend>personal Info</legend>
                    
        
        

                        Username:<br />

                        <input type="text" id="username" value="{$_SESSION['username']}" readonly> <br />
                        
                    
                  
                     

                        Email:<br />

                         <input type="text" id="email" value="{$result['email']}" readonly><br />

                    

                    

                        First Name:(*)<br />

                        <input name="firstname" type="text" id="firstname" value="{$result['firstname']}">
                    <br />
                    
                    

                        Last Name:(*)

                       <br /> <input name="lastname" type="text" id="lastname" value="{$result['lastname']}">

                    
                        
                         <br />Gender：
                             
                        <label><input type="radio" name="gender" value="m" $checked[0]>Male</label>
                        <label><input type="radio" name="gender" value="f" $checked[1]>Female</label>
                        

                    <br />

                        Phone Number(xxx-xxx-xxxx):(*)

                       <br />  <input name="phonenumber" type="text" id="phonenumber" value="{$result['phonenumber']}">

                    

                       <br /> Address:(*)

                       <br />  <input name="address" type="text" id="address" value="{$result['address']}">

                    

                  </fieldset> 

                    <br />
                        <input type="submit" name="submit" value="Submit">

                        <input type="reset" name="Reset" value="Reset"></td>

                       <br /><br /> 
    
    
    
    
     </form>
ZZEOF;
getFooter();

 function validate(){
     global $error;
 
     if(!is_numeric($_GET['eventsid'])||$_GET['eventsid']<1) $error['eventsid']="invaild eventsid!";
     if(empty($error))return true;
     else return false;
     
 }
//var_dump($_POST);


?>