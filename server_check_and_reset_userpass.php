<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once 'include/common.php';
require_once 'dblib/db_user.php';

require_once("include/demoframe.php");


     
  $du= new Db_user();  
    //checking null or has value
if(isset($_GET['verify'])&&!isset($_POST['userpass'])&&!isset($_POST['repeat_pass'])){
    $verify    = fix_str($_GET['verify']);
    $array = explode(',',base64_decode($verify));
    
    
    $result=$du->show_user_info( $username );
    $pass=$result['userpass'];
    $checkCode = sha1($array[0].'^'.$pass);
    //compare not->exit
    if($array[1] === $checkCode){
        $css=array('layout.css', 'slideshow.css');
        $username=$array[0];

$js=array('group5js/check.js','group5js/checkName.js');
getHeader("Home",$css,$js,'',0);
output_page_menu();

        echo <<< zzeof

        <h1>Reset Password</h1>
        <div class="responsive-container">
            <div class="dummy"></div>

            <div class="form-container">
                <div class="centerer"></div>
        <form name="reset_pass" class="login_and_signup" method="post" action="server_check_and_reset_userpass.php" onSubmit="return doResetPassCheck();">
                    <fieldset>
                        <table >

                            <tr>

                                <td >Username：</td>

                                <td><input name="username" type="text" id="username" value="$username"> </td>
                                
                            </tr>



                     <tr>

                        <td>Password(&gt;=6and&lt;=30)：</td>

                        <td><input name="userpass" type="password" id="userpass"></td>

                    </tr>

                    <tr>

                        <td>Repeat Password：</td>

                        <td><input name="repeat_pass" type="password" id="repeat_pass"></td>

                    </tr>
                    

                            <tr>

                                <td colspan="2" align="center">

                                <input type="submit" name="Submit" value="Submit">

                                <input type="reset" name="Reset" value="Reset"></td>

                                </tr>

        </div>

        </table>
         </fieldset>

        </form>



zzeof;
getFooter();
exit();
    }
    else{
        $url='/client_forget_pass_form.php';
        redirect('verifyString is not correct,please request again!', $url,'Forget password');
             exit();
    }
}

 if(isset($_POST['userpass'])&&isset($_POST['repeat_pass'])&&isset($_POST['username'])){//if(isset($_POST['userpass'])&&isset($_POST['repeat_pass']))
    $userpass    = fix_str($_POST['userpass']);
    $repeat_pass = fix_str($_POST['repeat_pass']);
    $username=fix_str($_POST['username']);
    //checking password's length
    $url='/server_check_and_reset_userpass.php';
    if (strlen($userpass) < 6 || strlen($userpass) > 30) {

      redirect("password's length should be >=6 and <=30", $url,'reset password');
        unset($_POST['userpass'],$_POST['repeat_pass']);

        exit();

    }
    
    if(strcmp($userpass, $repeat_pass)!=0){
        redirect("inconsistent password and repeat password!", $url,'reset password');
        unset($_POST['userpass'],$_POST['repeat_pass']);

        exit();
    }
    
        
        
//    var_dump($_GET);
//    var_dump($_POST);
//    flush();
//    sleep(5);
     $result=$du->reset_user_pass($username,$userpass);
     
     $url='/index.php';
        if($result===True){
            redirect("password reset completed", $url,'home');
            exit();
        }
    
}
else{// if $_GET[xxx]is null then redirect to home page
    $url='/index.php';
  
   redirect('illeagal access!', $url,'home');
             exit();
}

