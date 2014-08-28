<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once('include/PHPMailer/class.phpmailer.php');
include("include/PHPMailer/class.smtp.php"); 
require_once("include/demoframe.php");

function is_legal_access($uid){
    //if(!isset($uid)||empty($uid)) return false;
    if(is_user_logged_in()){
        if(is_admin()) return true;
        else{
            if($_SESSION['uid']==$uid) return true;
        }
    }
    return false;
    
}

//checking whether user is logged in
function is_user_logged_in()
{
  return isset($_SESSION['username']);
}

function is_admin(){
    if($_SESSION['accessid']<4)return false;
    else return true;
}

function clean($method,$keys){
    if(strcmp($method,'post')==0){
        if(!isset($_POST))return false;
        if(empty($keys)){
            foreach($_POST as $key => $value){
                $_POST[$key]=  fix_str($_POST[$key]);
            }
        }
        else{
            foreach($keys as $key => $value){
                $_POST[$key]=  fix_str($_POST[$key]);
            }
        }
    }
    if(strcmp($method,'get')==0){
        if(!isset($_POST))return false;
        if(empty($keys)){
            foreach($_GET as $key => $value){
                $_GET[$key]=  fix_str($_GET[$key]);
            }
        }
        else{
            foreach($keys as $key => $value){
                $_GET[$key]=  fix_str($_POST[$key]);
            }
        }
   
    }
     return true;
}
function utf8_strlen($str){
   return mb_strlen($str,'utf8');
}

//preventing sql injection, any keywords in this array can not be added to database
function isDataIllegal()

{
    $words = array();

    $words[]    = "add";

    $words[]    = "count";

    $words[]    = "create";

    $words[]    = "delete";

    $words[]    = "drop";

    $words[]    = "from";

    $words[]    = "grant";

    $words[]    = "insert";

    $words[]    = "select";

    $words[]    = "truncate";

    $words[]    = "update";

    $words[]    = "use";

    $words[]    = "--";

     

    

    foreach($_REQUEST as $str) {

        $str= strtolower($str); 

        foreach($words as $word) {

            if (strstr($str, $word)) {

               

                return FALSE;

            }

        }
        return TRUE;

    }
}
    //this function is especially for any function that are using the execute method to return
    //if return type is bool means sql operation is completed successfully
    // it will return a error message which is a string
    function isBoolOrString($result){
        if(is_bool($result))return TRUE;
        else return FALSE;
    }
    
    //this function is for preventing html injections
    function fix_str($str){
        $str=trim($str);
        
     return  htmlentities(stripslashes($str)); 
        
    }
    
    //this function is for activation which gerenate random codes
    function generateCode($num) { 
    $code = ""; 
        for ($i = 0; $i < $num; $i++) { 
        $code .= rand(0, 9); 
         }
    return $code;
    }
    
    //using PHPMailer class to send a email
    function sendMail($subject, $body, $to) { 
    
    $mail  = new PHPMailer(); 
    
    $mail->CharSet = 'UTF-8'; 
    
    $mail->IsSMTP(); 
     
    //$mail->SMTPDebug = 1;
    $mail->SMTPAuth = TRUE; 
    
    $mail->SMTPSecure = "ssl"; 
     
   
    $mail->Host       = "smtp.googlemail.com";      
    $mail->Port       = 465;            
    $mail->Username = 'notify.ccigw@gmail.com'; 
    $mail->Password = "liu11121adminadmin"; 
    
    $mail->SetFrom('notify.ccigw@gmail.com', 'CCIGW Register'); 
    
    $mail->Subject = $subject; 
     
    $mail->MsgHTML($body); 
    
    $mail->AddAddress($to); 
    
//    foreach ($ccs as $cc) { 
//        $mail->AddCC($cc); 
//    } 
    if(!$mail->Send()) { 
        echo "error info：" . $mail->ErrorInfo; 
    } 
    
    
} 

//includes all the message need for sending an notifaction to user
function send_activation_email($username,$userpass,$verifycode,$email){
    $username=  fix_str($username);
    $host= 'http://'.$_SERVER['HTTP_HOST'];
        $verifyurl=$host;
       $verifyurl.="/active.php?username=$username&identifier=$verifycode";
       
       $subject="Dear, $username weclome to CCIGW";
       $body="Hi, $username<br/><br/>";
       $body.="Congratulations and thanks for joining CCIGW.<br/><br/>";
       $body.="In order to active your account, please visit:<br/><br/>".$verifyurl."<br/><br/>";
       $body.="<b>If you can't click the link please copy and paste it into your browser.<br/><br/>Current Profile Information:<br/><br/>";        
       $body.="username: $username <br/><br/>";
       $body.="password: $userpass <br/><br/><br/>";
       $body.="Due to the security reason,Please delete this email after your activation is complete.<br/><br/>";
       $body.="Thanks <br/><br/><br/><br/>";
       $body.='-CCIGW TEAM'."</b>";
       $to=$email;
       sendMail($subject, $body, $to);
        
    }
    
    function send_reset_userpass_email($username,$encryptedstring,$email){
    $username=  fix_str($username);
    $host= 'http://'.$_SERVER['HTTP_HOST'];
        $verifyurl=$host;
       $verifyurl.="/server_check_and_reset_userpass.php?verify=$encryptedstring";
       
       $subject="CCIGW-Reset your password";
       $body="Hi, $username<br/><br/>";
       
       $body.="In order to reset your password, please visit:<br/><br/>".$verifyurl."<br/><br/>";
       $body.="<b>If you can't click the link please copy and paste it into your browser.<br/><br/>";        
       
       $body.="Due to the security reason,Please delete this email after your activation is complete.<br/><br/>";
       $body.="Thanks <br/><br/><br/><br/>";
       $body.='-CCIGW TEAM'."</b>";
       
       sendMail($subject, $body, $email);
        
    }
    
    function pagination($num, $pagesize){
        if(array_key_exists('pg', $_GET) && is_numeric($_GET['pg'])){
                         $current_pages =  $_GET['pg'] ;
         }else{
        header('Location:index.php');
        }   
        $offset = ($current_pages -1)* $pagesize;

        $total_pages = ceil($num/$pagesize);

        if($total_pages<1){
          $total_pages = 1;
        }

        //prev and next
        if ( $current_pages -1 <1 ) {
          $prev = 1;
         }elseif ($current_pages-1> $total_pages) {
          $prev = $total_pages;
         }else{
          $prev = $current_pages -1;
         }

         if ( $current_pages +1 <1 ) {
          $next = 1;
         }elseif ($current_pages +1> $total_pages) {
          $next = $total_pages;
         }else{
          $next = $current_pages +1;
         }

//         if($_GET['pg'] < 1 || $_GET['pg'] > $total_pages){
//                    header('Location:index.php');
//         }
         

         
         $pagefooter='<ul class="pagination"><li><a href="events.php?pg='.$prev.'">&laquo;</a></li>';
         
	for($i=1; $i<=$total_pages; $i++){
            if($i==$current_pages)$pagefooter.='<li class="active"><a href="events.php?pg='.$i.'">'.$i.'<span class="sr-only"></span></a></li>';
            
	    else $pagefooter.='<li><a href="events.php?pg='.$i.'">'.$i.'</a></li>';
	}
	$pagefooter.='<li><a href="events.php?pg='.$next.'">&raquo;</a></li></ul>';

        $result=array($offset,$pagefooter);

        return $result;
    }


    
    
    
    // for page auto-redirecting
    function redirect($message,$url,$to,$sec,$status){
        $url=  fix_str($url);
        $host= 'http://'.$_SERVER['HTTP_HOST'].'/';
        $js='';
        $url=$host.$url;
        $sec=$sec*1000;
        getHeader("redirect",'','');
        output_page_menu();
        if($status)$status='';
        else $status="<strong><h1>Oops...Error Occured!</h1></strong><br/>";
        echo <<<zzeof
        <script type="text/javascript">

            function delayer(){
            window.location = "$url";
        }
        $(document).ready(function(){
            setTimeout('delayer()', $sec);
        });

        </script>
        <div class= redirect_and_error>
            <p>$status $message</p>
             <br /><br /><br /><br />
             <strong>IF your browser does not support the redirection , click <u><a href="$url">here</a></u> to redirect to the $to page </strong>   
        </div> 
   
zzeof;
        getFooter();
        
    }
?>