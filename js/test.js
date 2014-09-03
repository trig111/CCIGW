function append_setting(){
    var str='';
    var size=document.getElementById("size").value;

    if(!size|| 0 === size.length||size<=0) {
        alert("please enter a integer!");
        return;
}   
//    var upload = document.getElementsByName("btnUploadImg");
//    var path = document.getElementsByName("ImgPath");
//    var del= document.getElementsByName("btnDeleteImg");
    //var insert=document.getElementsByName("btnInsertImg");
            
    for (var i = 0; i < size; i++){
            str='<label class="col-sm-2 control-label"> #'+i+':</label><br/><br/>'+'<input type="text" size="80" name="'+"slider[src][]"+'" placeholder="picture link" id="slider'+i+'"/><br /><input type="text" size="80" name="'+"slider[url][]"+'" placeholder="link to where (optional)" /><br /><input type="text" size="80" name="'+"slider[subject][]"+'" placeholder="picture title"/><br /><br />';
            str+='<input type="hidden" name="ImgPath" /><input type="button" name="btnUploadImg" value="上传" /><input type="button" name="btnInsertImg" value="插入" onclick="insertImg('+i+')"/><input type="button" name="btnDeleteImg" value="删除" onclick="delImg('+i+')"/><br /><br />';
            document.getElementById("slider_setting").innerHTML+=str;
        }
       for (var i = 0; i < size; i++) g_AjxUploadImg(document.getElementsByName("btnUploadImg")[i],document.getElementsByName("ImgPath")[i]);
}   
   
function delImg(i){
     var url="upload.php"; 
    
  $.post(url,{action:'del',key:document.getElementsByName("ImgPath")[i].value},function(data){
       if(data=='success'){
           alert(data);
           document.getElementsByName("ImgPath")[i].readOnly =false;
           document.getElementsByName("ImgPath")[i].value='';
            document.getElementsByName("ImgPath")[i].setAttribute("type", "hidden"); 
           
           document.getElementById('slider'+i).value='';
           
          
           
       }
       else{
           alert('error occured, try again');
       }
  });
    
   }
function insertImg(i){
    document.getElementById('slider'+i).value=document.getElementsByName("ImgPath")[i].value;
    
   }
   
function g_AjxUploadImg(btn,path) {
    var button = btn;
    new AjaxUpload(button, {
        action: 'upload.php',
        data: {},
        name: 'userfile',
        onSubmit: function(file, ext) {
            if (!(ext && /^(jpg|JPG|png|PNG|gif|GIF)$/.test(ext))) {
                alert("您上传的图片格式不对，请重新选择！");
                return false;
            }
        },
        onComplete: function(file, response) {
             if(!isNaN(response)){
                alert("error occured! try again!");
                return false;
            }
               path.setAttribute("type", "text"); 
               path.readOnly = "readonly";
               response=response.replace(/<div.*<\/div>/,'');
               path.value=response;
             
        }
    });
}



  
  
