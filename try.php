<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once("include/demoframe.php");
require_once("include/common.php");



$css=array('datepicker.css',);

$js=array('bootstrap-datepicker.js','bootstrap-datepicker.zh-CN.js','tinymce/tinymce.min.js');
getHeader("Events", $css, $js, '' , 0);

output_page_menu();

echo <<< zzeof
           
//<script type="text/javascript">
// 
//function change_category(action){
//
//  
//    var url="categroty_action_script.php"; 
//    if(action=="add") var key =document.getElementById("addCategory").value;
//    else if(action=="delete") var key= $( "#myselect" ).val();
//    else var key= -1;
//    
//  $.post(url,{action:action,key:key},function(data){
//        $("select").empty();
//    $("select").append(data);
//  });
//}
//
//
//
//$(document).ready(change_category('show'));
//</script> 
            
<select id="myselect">
</select>
 <input type="text" id="addCategory" value=""/><button type="button" onclick="javascript:change_category('add');">add</button>

<br />
<button type="button" onclick="javascript:change_category('delete');">delete</button>
<br />

<input size="20" type="text" value="" class="form_datetime" readonly>
 
<script type="text/javascript">

    $(".form_datetime").datepicker({
    language:'zh-CN',
    format:"dd-mm-yyyy",
        todayBtn: 'linked',
        todayHighlight: true,
        autoclose: true,
        startDate: '+0d'
        
    });
</script>   

zzeof;

getFooter();
?>
