<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once("include/demoframe.php");
require_once("include/common.php");

global $url;
$url='/contact.php';
if(isset($_POST['email'])&&isset($_POST['title'])&&isset($_POST['comment'])){
    // if all the fileds are not null
    if(empty($_POST['email'])||empty($_POST['title'])||empty($_POST['comment'])){
        //if any one of inputs is empty
        redirect('missing one or more fileds!', $url,'contact');
        unset($_POST);
        exit();
    }
     
    $pattern = "/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/";
    $email=  fix_str($_POST['email']); 
    if (!preg_match($pattern, $email)) {
//checking email
        redirect('invalid email address!', $url,'contact');
        unset($_POST);
        exit();

    }
    //else send email
    
    $title='User Feedback from '.$email." : ".fix_str($_POST['title']); 
    $comment=fix_str($_POST['comment']);
    $body='User Feedback from <a href="mailto:'.$email.'">'.$email.'</a><br/><br/><br/>';
    $body.="comment:<br/><br/><br/>".$comment."<br/><br/><br/>"."********end*********";
    sendMail($title, $body,'notify.ccigw@gmail.com');
    unset($_POST);
    $url='/index.php';
    redirect('feedback is sent completed !', $url,'HOME');
}

else{
//else print the html page
    
$css='';

$js=array('group5js/check.js');
getHeader("Contact Us",$css,$js,'',0);
output_page_menu();


	echo <<<ZZEOF
            <h4>40px</h4>

		<h1>Contact Us</h1>
		
		<div class="responsive-container">
    		<div class="dummy"></div>

    		<div class="form-container">
        		<div class="centerer"></div>
				<form name="commentform" class="login_and_signup" method="post" action="contact.php" >
            	<fieldset>
                <table >
 
                    
                    <tr>
                        <td>Email:</td>
                    <tr>
                    <tr>
                         <td><textarea rows="1" cols="50" name="email"></textarea></td>
                    </tr>
                    <tr>
                        <td>Title:</td>
                    <tr>
                    <tr>
                         <td><textarea rows="1" cols="50" name="title"></textarea></td>
                    </tr>
                    <tr>
                        <td>Your Comment:</td>
					</tr>
					<tr>
                        <td><textarea rows="4" cols="50" name="comment"></textarea></td>
                    </tr>
                   	 <tr>

                        <td colspan="2" align="right">

                        <input type="submit" name="Submit" value="Submit">

                        <input type="reset" name="Reset" value="Reset"></td>

                    </tr>
  				</div>
		</div>
               
	</table>
 </fieldset>

</form>


ZZEOF;




getFooter();
}
?>