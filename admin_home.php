<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once("include/common.php");
if(!is_admin()){
    redirect('illegal access!', 'index.php', 'home', 5,false);
    exit();
}
$css = array('simple-sidebar.css');
$js = array('ajaxupload.js','test.js');
getHeader("Superuser", $css, $js);
output_page_menu();
getSidebarHeader();

echo <<< zzeof
<form action="server_home_action.php" method="POST">
     <fieldset>
    <legend>Carousel (图片滑动条设定)：</legend>
     <label class="col-sm-2 control-label">totalNumber:</label>
         <input type="text" name="size" value="" id="size"/> <button type="button" class="btn btn-default" onclick="append_setting()" >Confirm</button>
         <div id="slider_setting"></div>
     </fieldset>
     <br />
    <fieldset>
    <legend>Jumbotron (超大显示屏设定)：</legend>
     <table>
          <tr><td><label >Title: </label> </td>
        
         <td><input type="text" name="title" size="80" value="" /></td></tr>
    <tr><td><label>paragraph1: </label></td><td><input type="text" size="80" name="line1" value="" /></td></tr>
    <tr><td><label>paragraph2: </label></td><td><input type="text" size="80" name="line2" value="" /></td></tr>
    <tr><td><label>link to(optional): </label></td><td><input type="text" size="80" name="link" value="" /></td></tr>
       </table>  
     </fieldset>
        <br /><br /><br />
  <fieldset>
    <legend>Latest News | Events (最新新闻|活动数量设定)：</legend>
     <table>
          <tr><td><label >Total Display #: </label> </td>
        
         <td><input type="text" name="limit" size="80" value="" /></td></tr>
       </table>   
     </fieldset>
       <br /><br /><br />
     <button type="submit" class="btn btn-default" name="submit">Sumbit</button>
     </form>
        
zzeof;

