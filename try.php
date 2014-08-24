<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once 'include/common.php';
require_once('include/PHPMailer/class.phpmailer.php');
//var_dump($_POST);
//if(isset($_POST['email'])&&isset($_POST['title'])&&isset($_POST['comment'])){
////    if(empty($_POST['email'])||$_POST['title']||$_POST['comment']){
////        echo"missing one or more filed";
////    }
//    $email=  fix_str($_POST['email']); 
//    $title=fix_str($_POST['email']); 
//    $comment=fix_str($_POST['email']);
//        $to ="notify.ccigw@gmail.com";
////		$headers = 'From: ccigw feedback' . "\r\n" .
////			'Reply-To: ' . $email . "\r\n";
//			
//		$message = "Name: $name \n" .
//					"Email: $email \n" .
//					
//					"Subject: $comment\n" .
//					"Message: \n\n";
//					
//					
//
//		if(mail($to, $title, $message)) echo"yes";
//                else"no";
//    
//}
//echo"lalalal";





$mail = new PHPMailer;
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsSMTP();                                      // Set mailer to use SMTP
//$mail->Host = 'localhost';  // Specify main and backup server
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'notify.ccigw@gmail.com';                            // SMTP username
$mail->Password = 'liu11121adminadmin';                           // SMTP password
//$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
$mail->IsHTML(true);                                  // Set email format to HTML

$mail->From = '499811099@qq.com';
$mail->FromName = '499811099@qq.com';
$mail->AddAddress('notify.ccigw@gmail.com', '499811099@qq.com');  // Add a recipient    

$mail->Subject = 'Here is the subject';
$mail->Body    = 'lalalalalallala';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->Send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}

echo 'Message has been sent';
?>

