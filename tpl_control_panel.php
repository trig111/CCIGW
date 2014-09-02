<?php
require_once("include/common.php");


if(!clean('get',$keys=array())){
    redirect('illegal access!', 'index.php', 'home', 5,false);
    exit();
}

$error=array();

if(!validate()){
    redirect(implode("<br />", $error), 'index.php ',home,5,false);
    exit();
}
if(!is_legal_access($_GET['uid'])){
     redirect('illegal access!', 'index.php', 'home', 5,false);
    exit();
}
$css=array();
$js=array();
getHeader("Control Panel", $css, $js);
output_page_menu();

if(strcmp($_GET['action'],'show')==0){
  require_once('dblib/db_user.php');
  $du = new Db_user();
  $result=$du->show_user_info($_GET['uid']);
  
  if(!isArrayOrString($result)){
        redirect($result, $_SERVER['HTTP_REFERER'], 'home', 5,false);
        exit();
    }
    if(empty($result)){
        redirect('404 NOT FOUND', $_SERVER['HTTP_REFERER'], 'home', 5,false);
        exit();
    }
  
   $checked=array('','');
    if($result['gender']=='m')$checked[0]='checked';
    else $checked[1]='checked';
    
    echo <<< zzeof

<br />
<ul class="nav nav-tabs" >
 <li class="active"><a href="tpl_control_panel.php?uid={$_GET['uid']}&action=show">Profile</a></li>
  <li ><a href="tpl_control_panel.php?uid={$_GET['uid']}&action=change">Change Password</a></li>
    <li><a href="#">Search</a></li>
  <li><a href="#">Messages</a></li>
</ul>
<br />
<div style="width: 50%;margin:0 auto;">
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Personal Info</h3>
  </div>
  <div class="panel-body">
    <form action="server_user_update_action.php" method="POST">
  <table>
    <tr><td><label >uid</label></td>
  
     <td> <input type="text" name="uid" value="{$result['uid']}" readonly/><br /></td></tr>
    
     <tr><td><label >username</label></td>
    
      <td><input type="text" value="{$result['username']}" disabled/><br /></td></tr>
    
    
      <tr><td><label >email</label></td>
 
      <td><input type="text" name="email" value="{$result['email']}"/><br /></td></tr>
       
    
      <tr><td> <label >created at</label></td>
   
      <td><input type="text" value="{$result['created']}" disabled/><br /></td></tr>
    
 <tr><td><label >accessid</label></td>
    
      <td><input type="text" value="{$result['accessid']}" disabled/><br /></td></tr>
      
    
 <tr><td><label >lastname</label></td>
   
      <td><input type="text" name="lastname" value="{$result['lastname']}"/><br /></td></tr>
      
   
      <tr><td> <label >firstname</label></td>
    
       <td><input type="text" name="firstname" value="{$result['firstname']}"/><br /></td></tr>
    
        <tr><td> <label >phone</label></td>
   
       <td><input type="text" name="phonenumber" value="{$result['phonenumber']}"/><br /></td></tr>
    
        <tr><td> <label >gender</label></td>
    
       <td><label><input type="radio" name="gender" value="m" $checked[0]>Male</label>
       <label><input type="radio" name="gender" value="f" $checked[1]>Female</label><br /></td></tr>

           <tr><td><label >address</label></td>
   
       <td><input type="text" name="address" value="{$result['address']}"/><br /><br /></td></tr>
    </table>

<button type="submit" class="btn btn-default" name="edit">Update</button>
    </form>
  </div>

</div>
</div>
zzeof;
}

if(strcmp($_GET['action'],'change')==0){
    echo <<< zzeof

<br />
<ul class="nav nav-tabs" >
  <li ><a href="tpl_control_panel.php?uid={$_GET['uid']}&action=show">Profile</a></li>
  <li class="active"><a href="tpl_control_panel.php?uid={$_GET['uid']}&action=change">Change Password</a></li>
    <li><a href="#">Search</a></li>
  <li><a href="#">Messages</a></li>
</ul>
<br />
<div style="width: 50%;margin:0 auto;">
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Change Password</h3>
  </div>
  <div class="panel-body">
    <form action="server_user_update_action.php" method="POST">
 <input type="hidden" name="uid" value=" {$_GET['uid']}">
     <label >username</label>
    <div >
      <input type="text"name="username" value="{$_SESSION['username']}" readonly/>
    </div>
    
       <label >old pass</label>
    <div class>
       <input type="password" name="userpass" value=""/>
    </div>
            <label >new pass</label>
    <div class>
       <input type="password" name="newuserpass" value=""/>
    </div>
    
           <label >confirm pass</label>
    <div class>
       <input type="password" name="repeat_pass" />
    </div>
<button type="submit" class="btn btn-default" name="changepass">Submit</button>
    </form>
  </div>

</div>
</div>
zzeof;
    
}


getFooter();
 function validate(){
     global $error;
     if(!is_numeric($_GET['uid'])||$_GET['uid']<1) $error['uid']="invaild uid!";
     if(!ctype_alnum($_GET['action'])) $error['action']='invalid action!';
     if(empty($error))return true;
     else return false;
     
 }

