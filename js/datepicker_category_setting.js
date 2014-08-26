
   function change_category(action){

  
    var url="categroty_action_script.php"; 
    if(action=="add") var key =document.getElementById("addCategory").value;
    else if(action=="delete") var key= $( "#myselect" ).val();
    else var key= -1;
    
  $.post(url,{action:action,key:key},function(data){
        $("#myselect").empty();
    $("#myselect").append(data);
  });
}

function change_content(){
    var text=$("#myselect").find("option:selected").text();
    //alert(text);
    document.getElementById("addCategory").value=text;
}

function choose_selected(){
    var selectedby =document.getElementById("addCategory").value;
         //alert(selectedby);
        if(selectedby!='')document.getElementById(selectedby).selected = "true";  
}



+function ($) { 
    'use strict';
 
$(document).ready(function(){
   change_category('show');
   setTimeout(function(){choose_selected();},100);
});

$(document).ready(function() {
   $(".form_datetime").datepicker({
    language:'zh-CN',
    format:"yyyy-mm-dd",
        todayBtn: 'linked',
        todayHighlight: true,
        autoclose: true,
        startDate: '+0d'
        
    });
});

}(jQuery);


