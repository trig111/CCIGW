<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once("include/demoframe.php");
require_once("include/common.php");

global $url;
$url='contact.php';
if(isset($_POST['email'])&&isset($_POST['title'])&&isset($_POST['comment'])){
    // if all the fileds are not null
    if(empty($_POST['email'])||empty($_POST['title'])||empty($_POST['comment'])){
        //if any one of inputs is empty
        redirect('missing one or more fileds!', $url,'contact',5,false);
        unset($_POST);
        exit();
    }
     
    $pattern = "/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/";
    $email=  fix_str($_POST['email']); 
    if (!preg_match($pattern, $email)) {
//checking email
        redirect('invalid email address!', $url,'contact',5,false);
        
        exit();

    }
    //else send email
    
    $title='User Feedback from '.$email." : ".fix_str($_POST['title']); 
    $comment=fix_str($_POST['comment']);
    $body='User Feedback from <a href="mailto:'.$email.'">'.$email.'</a><br/><br/><br/>';
    $body.="comment:<br/><br/><br/>".$comment."<br/><br/><br/>"."********end*********";
    sendMail($title, $body,'notify.ccigw@gmail.com');
    unset($_POST);
    $url='index.php';
    redirect('feedback is sent completed !', $url,'HOME',1,true);
}

else{
//else print the html page
    
$css='';

$js=array('group5js/check.js');
getHeader("Contact Us",$css,$js);
output_page_menu();


	echo <<<ZZEOF
<div style="width:40%;margin:0 auto;">
<br /><br />
		<h1>Contact Us</h1>
		
		
    		<div class="form-group"></div>

    		
        		
				<form name="commentform" class="login_and_signup" method="post" action="contact.php" >
        
 
                    
             
                     <label> Email: </label>
                   <textarea rows="1" cols="50" name="email" class="form-control"></textarea>
                   
                    <label>Title:</label>
                    
                        <textarea rows="1" cols="50" name="title" class="form-control"></textarea>
                   
                        <label>Your Comment:</label>
	           <textarea rows="4" cols="50" name="comment" class="form-control"></textarea>
            
                    <button type="submit" class="btn btn-default" name="Submit" value="Submit">Submit</button>

                    <button type="reset" class="btn btn-default" name="Reset" value="Reset">Reset</button>

    

</form>
<br/><br/>
</div>
ZZEOF;




getFooter();

}
?>