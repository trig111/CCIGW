<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once("include/common.php");
if(!is_admin()||!clean('get',$keys=array())){
    redirect('illegal access!', 'index.php', 'home', 5,false);
    exit();
}
$error=array();
if(!validate()){
    redirect(implode("<br />", $error), $_SERVER['HTTP_REFERER'], 'home', 5,false);
    exit();
}

require_once('dblib/db_user.php');
$du = new Db_user();
$num=$du->get_num_of_users();
if(!isArrayOrString($num)){
     redirect($num, $_SERVER['HTTP_REFERER'], 'Users Admin', 5,false);
            exit();  
}
if(empty($num)){
     redirect('404 NOT FOUND', $_SERVER['HTTP_REFERER'], 'Users Admin', 5,false);
            exit();  
}
$pagesize = 100;
$page_key = pagination($num[0],$pagesize,'admin_user.php?');


$css = array('simple-sidebar.css');
$js = array('checkbox.js');
getHeader("Superuser", $css, $js);
output_page_menu();
getSidebarHeader();

echo <<< zzeof
<form action="server_user_access_action.php" method="post">
<table class="table table-hover" border="2">
                <h2>User Access Table</h2><br />
<small>click the checkbox to choose which row you want to delete or modify</small>
					<thead>
						<tr>
                                                        <th></th>
                                                        <th>Accessid</th>
                                                         <th>Type</th>
                                                        <th>ReadAccess</th>
							 <th>AllowView</th>
                                                         <th>AllowPost</th>
							 <th>AllowReply</th>
                                                         <th>AllowUpdate</th>
							 <th>AllowDelete</th>
                                                         <th>AllowGetAttach</th>
                                                         <th>AllowPostAttach</th>
                                                         <th>AllowSearch</th>
                                                         <th>AllowSetReadPerm</th>
                                                         
							
						</tr>
					 </thead>
                                        <tbody>

zzeof;
$results=$du->show_user_access_list();

if(!isArrayOrString($results)){
     redirect($results, $_SERVER['HTTP_REFERER'], 'Users Admin', 5,false);
            exit();  
}
if(empty($results)){
     redirect('404 NOT FOUND', $_SERVER['HTTP_REFERER'], 'Users Admin', 5,false);
            exit();  
}
foreach( $results as $result){
echo <<<ZZEOF
    
    <td><input type="checkbox" id="checkbox{$result['accessid']}" onclick="isChecked_userAccess('{$result['accessid']}')"/></td>
    <td><input type="text" name="accessid[]" id="accessid{$result['accessid']}" value="{$result['accessid']}" disabled/></td>
    <td><input type="text" name="type[]" id="type{$result['accessid']}" value="{$result['type']}" disabled/></td>
    
    <td><input type="text" name="readaccess[]" id="readaccess{$result['accessid']}" value="{$result['readaccess']}" disabled/></td>
    <td><input type="text" name="allowview[]" id="allowview{$result['accessid']}" value="{$result['allowview']}"disabled/></td>
    <td><input type="text" name="allowpost[]" id="allowpost{$result['accessid']}" value="{$result['allowpost']}"disabled/></td>
    <td><input type="text" name="allowreply[]" id="allowreply{$result['accessid']}" value="{$result['allowreply']}"disabled/></td>
    <td><input type="text" name="allowupdate[]" id="allowupdate{$result['accessid']}" value="{$result['allowupdate']}"disabled/></td>
    <td><input type="text" name="allowdelete[]" id="allowdelete{$result['accessid']}" value="{$result['allowdelete']}" disabled/></td>
    <td><input type="text" name="allowgetattach[]" id="allowgetattach{$result['accessid']}" value="{$result['allowgetattach']}" disabled/></td>
    <td><input type="text" name="allowpostattach[]" id="allowpostattach{$result['accessid']}" value="{$result['allowpostattach']}" disabled/></td>
    <td><input type="text" name="allowsearch[]" id="allowsearch{$result['accessid']}" value="{$result['allowsearch']}" disabled/></td>
    <td><input type="text" name="allowsetreadperm[]" id="allowsetreadperm{$result['accessid']}" value="{$result['allowsetreadperm']}" disabled/></td>
    
    

</tr>

ZZEOF;
}
echo <<<ZZEOF

						
					</tbody>
			 </table>
 <dl class="dl-horizontal">
  <dt>'0' and '1'</dt>
  <dd>0: not allowed 1: allowed</dd>
</dl>
 <div class="row">
  
  <button type="submit" class="btn btn-default" name="edit">Edit</button>
  <button type="submit" class="btn btn-default" name="delete">Delete</button>
  </div>  
                         </form>
<br /><br />
ZZEOF;


echo <<<ZZEOF
<form action="server_user_action.php" method="post">
<table class="table table-hover" border="2">
 <h2>User Records Table</h2><br />
<small>click the checkbox to choose which row you want to delete or modify</small>
					<thead>
						<tr>
                                                        <th></th>
                                                        <th>uid</th>
                                                        <th>accessid</th>
							 <th>username</th>
                                                         <th>email</th>
							 <th>lastname</th>
							 <th>firstname</th>
							 <th>gender</th>
                                                         <th>phoneNumber</th>
							 <th>address</th>
                                                         <th>created</th>
                                                         <th>lastlogin</th>
                                                         <th>status</th>
                                                         <th>identifier</th>
                                                         <th>expiry</th>
							
						</tr>
					 </thead>
                                        <tbody>
ZZEOF;

$results=$du->show_all_user_info($page_key['offset'],$pagesize);

if(!isArrayOrString($results)){
     redirect($results, $_SERVER['HTTP_REFERER'], 'Users Admin', 5,false);
            exit();  
}
if(empty($results)){
     redirect('404 NOT FOUND', $_SERVER['HTTP_REFERER'], 'Users Admin', 5,false);
            exit();  
}

foreach( $results as $result){
echo <<<ZZEOF
    
    <td><input type="checkbox" id="checkbox{$result['uid']}" onclick="isChecked_user('{$result['uid']}')"/></td>
    <td><input type="text" name="uid[]" id="uid{$result['uid']}" value="{$result['uid']}" disabled/></td>
    <td><input type="text" name="accessid[]" id="accessid{$result['uid']}" value="{$result['accessid']}" disabled/></td>
    <td><input type="text" name="username[]" id="username{$result['uid']}" value="{$result['username']}" disabled/></td>
    <td><input type="text" name="email[]" id="email{$result['uid']}" value="{$result['email']}"disabled/></td>
    <td><input type="text" name="lastname[]" id="lastname{$result['uid']}" value="{$result['lastname']}"disabled/></td>
    <td><input type="text" name="firstname[]" id="firstname{$result['uid']}" value="{$result['firstname']}"disabled/></td>
    <td><input type="text" name="gender[]" id="gender{$result['uid']}" value="{$result['gender']}"disabled/></td>
    <td><input type="text" name="phonenumber[]" id="phonenumber{$result['uid']}" value="{$result['phonenumber']}" disabled/></td>
    <td><input type="text" name="address[]" id="address{$result['uid']}" value="{$result['address']}" disabled/></td>
    <td><input type="text" name="created[]" id="created{$result['uid']}" value="{$result['created']}" disabled/></td>
    <td><input type="text" name="lastlogin[]" id="lastlogin{$result['uid']}" value="{$result['lastlogin']}" disabled/></td>
    <td><input type="text" name="status[]" id="status{$result['uid']}" value="{$result['status']}" disabled/></td>
    <td><input type="text" name="identifier[]" id="identifier{$result['uid']}" value="{$result['identifier']}" disabled/></td>
    <td><input type="text" name="expiry_time[]" id="expiry_time{$result['uid']}" value="{$result['expiry_time']}" disabled/></td>

</tr>

ZZEOF;
}
echo <<<ZZEOF

						
					</tbody>
			 </table>
 <dl class="dl-horizontal">
  <dt>status</dt>
  <dd>0: not activated 1: activated</dd>
    <dt>identifier</dt>
  <dd>4-digit integer that is used for activation</dd>
</dl>

 <div class="row">
 
  <button type="submit" class="btn btn-default" name="edit">Edit</button>
  <button type="submit" class="btn btn-default" name="delete">Delete</button>
  </div>  
                         </form>
<br /><br />

ZZEOF;
echo $page_key['pagefooter'];
getSidebarFooter();

getFooter();

 function validate(){
     global $error;
     if(!is_numeric($_GET['pg'])||$_GET['pg']<1) $error['pg']='invalid page number!';
     if(empty($error))return true;
     else return false;
     
 }
?>