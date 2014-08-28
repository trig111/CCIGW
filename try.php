<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once("include/demoframe.php");
require_once("include/common.php");



$css=array('datepicker.css',);

$js=array('bootstrap-datepicker.js','bootstrap-datepicker.zh-CN.js','datepicker_category_setting.js');
getHeader("Events", $css, $js);

output_page_menu();

echo <<< zzeof
           

            
<select id="myselect">
</select>
 <input type="text" id="addCategory" value=""/><button type="button" onclick="change_category('add');">add</button>

<br />
<button type="button" onclick="change_category('delete');">delete</button>
<br />

<input size="20" type="text" value="" class="form_datetime" readonly>
 


zzeof;

getFooter();
?>
