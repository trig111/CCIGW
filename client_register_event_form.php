
<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once('dblib/db_events.php');
require_once('dblib/db_user.php');
require_once("include/demoframe.php");
require_once("include/common.php");

$css=array();
$js=array();
//require_once('/form/form_admin.php');
getHeader("Events", $css, $js, '' , 0);

output_page_menu();
    $event_handle = new Db_events();
    $user_handle = new Db_user();
if(isset($_GET['eventsid'])){
    

    
    
    $result=$user_handle->show_user_info( $_SESSION['username']);
    $uid=$user_handle->get_uid_by_name($result['uid']);
    $subject=$event_handle->show_single_event_name($uid);
    //var_dump($subject);
    $checked=array('','');
    if($result['gender']=='m')$checked[0]='checked';
    else $checked[1]='checked';

echo <<< ZZEOF
    
    <form action="client_register_event_action.php" method="POST">
    
    
    
    <fieldset>
    <legend>Event Info</legend>
                 

                        event name:(*)<br />

                         <input  type="text"  value="$subject" readonly>
                          <input type="hidden" name="eventsid" value="$eventsid" readonly>
                          <input type="hidden" name="uid" value="$uid" readonly><br />

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
                        <input type="submit" name="Submit" value="Submit">

                        <input type="reset" name="Reset" value="Reset"></td>

                       <br /><br /> 
    
    
    
    
     </form>
ZZEOF;
}
if(isset($_POST['eventsid'],$_POST['uid'],$_POST['firstname'],$_POST['lastname'],$_POST['gender'],$_POST['phonenumber'],$_POST['$address'],$_POST['$numberofpeople'],$_POST['remarks'])){
    //check_more
    var_dump($_post);
    $numberofpeople=  fix_str($_POST['numberofpeople']);
    $remarks=  fix_str($_POST['remarks']);
    $eventsid=  fix_str($_POST['eventsid']);
    $uid= fix_str($_POST['uid']);
    $firstname=fix_str($_POST['firstname']);
    $lastname=fix_str($_POST['lastname']);
    $gender=fix_str($_POST['gender']);
    $phonenumber=fix_str($_POST['phonenumber']);
    $address=fix_str($_POST['$address']);
    
}
getFooter();
?>