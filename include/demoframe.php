<?php

/*****************************
NOTES
 * this code consists different parts for html

******************************/

//header part(name,css name, javascript name, redirect url,redirect secds)
function getHeader($title,$css = array(), $js = array()){
       $url= htmlspecialchars($url);

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
                <!--$url-->

		<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
                $link
  		
                
                <script type="application/javascript" src="js/jquery-1.11.1.min.js"></script>
                <script type="application/javascript" src="js/bootstrap.js"></script>
                $script
                
		

	</head>
ZZEOF;

	
}

//navgation part
function output_page_menu()
{
$temp='';
$login = array();
  if (is_user_logged_in())
  {
    $login['url'] = 'logout.php';
    $login['label'] = 'Logout';
    
    $temp= "useraccess.php";
    $controlpanel= '<li><a href='.$temp.'>Control Panel</a></li>';
    
  }
  else
  {
    $login['url'] = 'trylogin.php';
    $login['label'] = 'Login';
//    $login['useraccess']="useraccess.php";
    $controlpanel="";
  }

echo <<<ZZEOF
<body>
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
            $controlpanel
            <li><a href="{$login['url']}">{$login['label']}</a></li>
            <li><a href="tryregister.php">Sign Up</a></li>
            
          </ul>
        </div>
      </div>
    </div>


ZZEOF;

/*
echo <<<ZZEOF
	<body>
		<div class="header">
			<div class="title">
				<a href="index.php">
				<img src="images/logo.jpg" border="0" alt="CCIGW" /></a>
			</div>
			<table>
				<tr>
					<td><a href="{$login['url']}">{$login['label']}</a></td>
					<td><p> | </p></td>
					<td><a href="tryregister.php">Sign Up</a></td>
                                        
ZZEOF;*/
                                /*$controlpanel=''; 
                                if(!empty($temp)) 
                                $controlpanel= '<td><p> | </p></td><td><a href='.$temp.'>Control Panel</a></td>';
                                */                
                                               
                              /*          
echo <<<zzeof
                                 $controlpanel     
	
		
zzeof;*/

/*
</tr>
			</table>
		</div>
		<div class="meny">
			<h2>Menu</h2>
			<ul>
				<li><a href="index.php">Hme</a></li>
				<li><a href="about.php">About</a></li>
				<li><a href="events.php">Events</a></li>
				<li><a href="news.php">News</a></li>
				<li><a href="contact.php">Contact Us</a></li>
			</ul>
		</div>

		<div class="meny-arrow"></div>

		<div class="contents">*/
  
}




//footer part
function getFooter(){
	echo <<<ZZEOF
			<div>				</div>
			<small>
				 Disclaimer: 60-334 GROUP 5 does not own the rights to any of the content including pictures on this website.
			</small>
               
               
		
		

	</body>
</html>
ZZEOF;


}

?>