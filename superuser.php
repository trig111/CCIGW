<?php

if (!isset($_SESSION)) {
    session_start();
}
require_once("include/demoframe.php");
require_once('dblib/db_events.php');
require_once('dblib/db_user.php');
require_once("userlist.php");
require_once 'include/common.php';
//require_once('/form/form_admin.php');
$css = '';

$js = array('group5js/check.js');
getHeader("Superuser", $css, $js, '', 0);
output_page_menu();
if (!isset($_SESSION['username'])) {
    redirect('<h1>Your are currently not logged in</h1> ', "/login.php", 'Login');
} else {
    $this_user_name = fix_str($_SESSION['username']);

    $user_handle = new Db_user();
    $this_access = $user_handle->show_single_user_access($this_user_name);
    if ($this_access < 3) { // what if a normal usr try to access the super user page
        echo 'Nice try, but you are not a superuser! :D ';
    } else {
        echo ' Hello Dear Superuser ';
        echo '</br></br></br><h4>Users Table</h4>';
        show_users_list();
        echo '</br></br></br><h4>Events Table</h4>';
        show_event_list();
        echo '</br></br></br><h4>News Table</h4>';
        show_news_list();
        echo '</br></br></br></br>';
    }
}
getFooter();
?>


