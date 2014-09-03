/* */

//function getData()
//{
//var objS = document.getElementById("msg");
//  //var selectid = objS.options[objS.selectedIndex].value;
//  //var o1=document.getElementById("op1").value;
//  //var o2=document.getElementById("op2").value;
////  var which=document.getElementsByName('todo[]')[0].value;
//  //document.getElementsByName('x')[0].value
////  alert(which);
//
//
//
//  
//  if(document.getElementById("op1"))getData1();
//  else if(document.getElementById("op1"))getData2();
//
////  if(o1 == "1")
////    {
////
////        getData1();
////    }else if(o2 == "2")
////    {
////        getData2();
////    }
//    function getData1(){
//        alert("111111");
//  var httpReq = null;
//
//  if (window.XMLHttpRequest)
//    httpReq = new XMLHttpRequest();
//  else if (window.ActiveObject)
//    httpReq = new ActiveXObject("Microsoft.XMLHTTP");
//  else
//    return false;
//    document.getElementById("op1").value=null;
//
//  httpReq.onreadystatechange = function()
//  {
//    var obj = document.getElementById("msg");
//    obj.innerHTML = httpReq.responseText;}
//    //obj.innerHTML = "";
//  
//
//  httpReq.open("GET",'products_in_table.php',true);
//  httpReq.send();
//}
//    function getData2(){
//  var httpReq = null;
//        alert("22222222");
//
//  if (window.XMLHttpRequest)
//    httpReq = new XMLHttpRequest();
//  else if (window.ActiveObject)
//    httpReq = new ActiveXObject("Microsoft.XMLHTTP");
//  else
//    return false;
//document.getElementById("op2").value=null;
//
//  httpReq.onreadystatechange = function()
//  {
//    var obj = document.getElementById("msg");
//    obj.innerHTML = httpReq.responseText;
//    //obj.innerHTML = "";
//  }
//
//  httpReq.open("GET",'products_in_table1.php',true);
//  httpReq.send();
//}
//}





function changeFunc() {
    var selectBox = document.getElementById("area");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    //alert(selectedValue);
    
     if(selectedValue=="1")getData1();
     else getData2();
    
    
    function getData1(){
     //   alert("111111");
  var httpReq = null;

  if (window.XMLHttpRequest)
    httpReq = new XMLHttpRequest();
  else if (window.ActiveObject)
    httpReq = new ActiveXObject("Microsoft.XMLHTTP");
  else
    return false;
    //document.getElementById("op1").value=null;

  httpReq.onreadystatechange = function()
  {
    var obj = document.getElementById("msg");
    obj.innerHTML = httpReq.responseText;}
    //obj.innerHTML = "";
  

  httpReq.open("GET",'products_in_table.php',true);
  httpReq.send();
}
    function getData2(){
  var httpReq = null;
       // alert("22222222");

  if (window.XMLHttpRequest)
    httpReq = new XMLHttpRequest();
  else if (window.ActiveObject)
    httpReq = new ActiveXObject("Microsoft.XMLHTTP");
  else
    return false;
//document.getElementById("op2").value=null;

  httpReq.onreadystatechange = function()
  {
    var obj = document.getElementById("msg");
    obj.innerHTML = httpReq.responseText;
    //obj.innerHTML = "";
  }

  httpReq.open("GET",'products_in_table1.php',true);//get the data from ",'products_in_table1.php
  httpReq.send();
}
    
    
    
   }

