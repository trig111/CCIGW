<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once('include/PHPMailer/class.phpmailer.php');
include("include/PHPMailer/class.smtp.php"); 
require_once("include/demoframe.php");

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
    
    


    
    
    
    // for page auto-redirecting
    function redirect($message,$url,$to){
        //do_page_prerequisites();
        $url=  fix_str($url);
        $host= 'http://'.$_SERVER['HTTP_HOST'];
        
       
        
        $css=array('layout.css', 'slideshow.css');

        $js=array('jquery-1.3.1.min.js','meny.js');
        $url=$host.$url;
        //echo'lalalalalal';
        //sleep (4);
        getHeader("Home",$css,$js,$url,2);
        output_page_menu();
        echo <<<zzeof
        <div class="redirect" align=center>$message please wait to redirect to the $to page</div>
zzeof;
        getFooter();
        
    }
    
    
?>
    
