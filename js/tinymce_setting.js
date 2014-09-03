//+function ($) {
//  'use strict';
//  
//  tinymce.init({
//        selector: "textarea",
//        plugins: [
//            "advlist autolink lists link image charmap print preview anchor",
//            "searchreplace visualblocks code fullscreen",
//            "insertdatetime media table contextmenu paste"
//     ],
//      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
//    });
//}(jQuery);



 
 
 +function ($) {
  'use strict';
tinymce.init({
  selector: "textarea",
  
  // ===========================================
  // INCLUDE THE PLUGIN
  // ===========================================
	
  plugins: [
    "advlist autolink lists link image charmap print preview anchor",
    "searchreplace visualblocks code fullscreen",
    "insertdatetime media table contextmenu paste jbimages"
  ],
	
  // ===========================================
  // PUT PLUGIN'S BUTTON on the toolbar
  // ===========================================
	
  toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
	
  // ===========================================
  // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
  // ===========================================
	
  relative_urls: false
	
});



  
}(jQuery);

 


function test(){
    var iframe = document.getElementById('body_ifr');
var frameDoc = iframe.contentDocument || iframe.contentWindow.document;
var el = frameDoc.getElementById('tinymce');
    //var div = document.getElementById('body_ifr');
    

//alert(el.value);
tinymce.EditorManager.activeEditor.insertContent('<p id="del123">'+'呵呵'+'</p>');
alert('222');
//tinymce.DOM.remove('del123');
tinymce.activeEditor.dom.remove('del12');
//div.innerHTML = div.innerHTML + '<img src="../CCIGW/images/ccigwdemo1.jpg" alt=""/>';
//Removes all paragraphs in the active editor
//tinymce.activeEditor.dom.remove(tinymce.activeEditor.dom.select('p'));
//Removes an element by id in the document
//tinymce.DOM.remove('mydiv');
}