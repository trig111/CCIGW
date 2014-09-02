<?php
//var_dump(is_dir($_SERVER['DOCUMENT_ROOT'].'CCIGW/upload/')); 
require_once 'include/common.php';
$css=array('fileuploader.css');
$js=array('fileuploader.js');

getHeader("Home",$css,$js);
output_page_menu();

echo <<< zzeof
 <script type="text/javascript">     
$(function(){
    new qq.FileUploader({
        element: $("#upload")[0]
        ,action: 'upload.php'
        ,allowedExtensions:['jpg','jpeg','rar','zip','png','gif','bmp']
        ,onComplete: function(id,filename,json){
            console.log(id);
            console.log(filename);
            console.log(json);
        }
   });
});
  </script>  
      
<div id="upload"></div>

zzeof;
getFooter();

