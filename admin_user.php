<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once("include/demoframe.php");
require_once('dblib/db_user.php');
$css = array('jquery.dataTables.min.css','simple-sidebar.css');

$js = array('jquery.dataTables.min.js');


$du = new Db_user();
$results=$du->show_all_user_info(0,100);
//var_dump($result);
getHeader("Superuser", $css, $js);
output_page_menu();
getSidebarHeader();
echo <<<ZZEOF
<script language="JavaScript">
function isChecked(uid){
var attr = new Array(
                        "uid"+uid,
                       "accessid"+uid,    
                        "username"+uid,
                        "email"+uid,
                        "lastname"+uid, 
                        "firstname"+uid,     
                        "gender"+uid,      
                        "phonenumber"+uid, 
                        "address"+uid,      
                        "status"+uid,         
                        "identifier"+uid
                          );

  var c="checkbox"+uid;
  var isTrue=true;
  document.getElementById(attr[0]).readOnly=false;
  if(document.getElementById(c).checked){
      isTrue=false;
     document.getElementById(attr[0]).readOnly=true;
   }         
  for (var i = 0; i < attr.length; i++){
     
      document.getElementById(attr[i]).disabled=isTrue;
      
      }

}
</script>

<form action="server_user_action.php" method="post">
<table class="table table-hover" border="2">
					<thead>
						<tr>
                                                        <th></th>
                                                        <th>uid</th>
                                                        <th>accessid</th>
							 <th>username</th>
                                                         <th>email</th>
							 <th>Lname</th>
							 <th>Fname</th>
							 <th>sex</th>
                                                         <th>phone</th>
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
foreach( $results as $result){
echo <<<ZZEOF
    
    <td><input type="checkbox" id="checkbox{$result['uid']}" onclick="isChecked('{$result['uid']}')"/></td>
    <td><input type="text" name="uid[]" id="uid{$result['uid']}" value="{$result['uid']}" readonly/></td>
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
    <td><input type="text" name="status[]" id="status{$result['uid']}" value="{$result['stauts']}" disabled/></td>
    <td><input type="text" name="identifier[]" id="identifier{$result['uid']}" value="{$result['identifier']}" disabled/></td>
    <td><input type="text" name="expiry_time[]" id="expiry_time{$result['uid']}" value="{$result['expiry_time']}" disabled/></td>

</tr>

ZZEOF;
}
echo <<<ZZEOF

						
					</tbody>
			 </table>
<div class="form-group">
            <div class="col-sm-offset-0 col-sm-10">
                <button type="submit" class="btn btn-default" name="edit">Edit</button>
            </div>
        </div>
                         </form>
ZZEOF;
getSidebarFooter();
getFooter();
?>