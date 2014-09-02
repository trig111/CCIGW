<?php

/*****************************
NOTES
 * this code consists different parts for html

******************************/

function getSidebarHeader(){
    echo <<< zzeof
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                 <li class="sidebar-brand">
                    <a href="#">
                        ADMINISTRATION
                    </a>
                </li>
                <li>
                    <a href="admin_home.php">Manage HOME Page</a>
                </li>
                <li>
                    <a href="admin_user.php?pg=1">Manage Users</a>
                </li>
                <li>
                    <a href="admin_events.php?pg=1">Manage Events</a>
                </li>
                <li>
                    <a href="admin_registration.php?pg=1">Manage Registration</a>
                </li>
                <li>
                    <a href="admin_news.php?pg=1">Manage News</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
zzeof;
}

function getSidebarFooter(){
    echo <<<zzeof
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
zzeof;
}

//header part(name,css name, javascript name, redirect url,redirect secds)
function getHeader($title,$css = array(), $js = array()){
       //$url= htmlspecialchars($url);

	$title = htmlspecialchars($title);

  $link = '';
  if(!empty($css)){
  foreach ($css as $cssFile)
    $link .= '<link rel="stylesheet" type="text/css" href="css/'.$cssFile.'" />';
  }
  $script = '';
  if(!empty($js)){
  foreach ($js as $jsFile)
    $script .= '<script type="application/javascript" src="js/'.$jsFile.'"></script>';
  }
  //if($url!='')$url='<meta http-equiv="refresh" content="'.$sec.';url='.$url.'"/>'; 
                    

	echo <<<ZZEOF
		<!DOCTYPE html>


	<head>
		<meta charset="utf-8">

		<title>CCIGW - $title</title>

		<meta name="viewport" content="width=800, user-scalable=no">
                
                
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
                
                $link
  		<link rel="stylesheet" type="text/css" href="css/sticky-footer.css" />
                
                <script type="application/javascript" src="js/jquery-1.11.1.min.js"></script>
                <script type="application/javascript" src="js/bootstrap.js"></script>
                $script
                
		

	</head>
ZZEOF;

	
}

//navgation part
function output_page_menu()
{

$login = array();
  if (isset($_SESSION['username'],$_SESSION['uid'],$_SESSION['accessid']))
  {
    $login['url'] = 'logout.php';
    $login['label'] = 'Logout';
    $is_admin="";
    $temp= "tpl_control_panel.php?uid={$_SESSION['uid']}&action=show";
    $controlpanel= '<li><a href='.$temp.'>Control Panel</a></li>';
    if($_SESSION['accessid']>=3){
        $is_admin="<li><a href='admin_home.php'>Administration</a></li>";
    }
  }
  else
  {
    $login['url'] = 'trylogin.php';
    $login['label'] = 'Login';
//    $login['useraccess']="useraccess.php";
    $controlpanel="";
     $is_admin="";
  }

echo <<<ZZEOF
<body>
  <div id="wrap">
 <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">CCIGW</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="events.php?pg=1">Events</a></li>
            <li><a href="news.php?pg=1">News</a></li>
            <li><a href="contact.php">Contact Us</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
           $is_admin
            $controlpanel
            <li><a href="{$login['url']}">{$login['label']}</a></li>
            <li><a href="tryregister.php">Sign Up</a></li>
            
          </ul>
        </div>
      </div>
    </div>


ZZEOF;

  
}




//footer part
function getFooter(){
	echo <<<ZZEOF
    <br /><br /><br /><br /><br /></div>
			<div id="footer" style="text-align: center;font-size: 150%;">
      
                        
				<ul class="list-inline" style="margin: 0;padding: 0;">
                <li style="padding-top: 20px;">
                    <a href="http://www.windsorpie.com/portal.php" >Partner site</a>
                  
                </li>
                <li style="padding-top: 20px;">
                  <a href="mailto:notify.ccigw@gmail.com">Email Us</a>
                </li>
               
                  <li="copy" style="float: right;padding-top: 20px;margin-right: 10px;color:#428bca;">
                     2014 -CCIGW Team
                  
    </li>
    </ul>
			
      
    </div>
			
               
               
		
		

	</body>
</html>
ZZEOF;


}

?>