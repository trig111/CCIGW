<?php

if (!isset($_SESSION)) {
    session_start();
}
require_once('dblib/db_news.php');
require_once('dblib/db_user.php');
require_once("include/demoframe.php");
require_once("include/common.php");
require_once('event_action.php');

//do_page_prequisites();
$css = array('layout.css');
//$js=array('meny.js', 'group5js/check.js');
$js = array('meny.js', 'tinymce/tinymce.min.js');
//require_once('/form/form_admin.php');
getHeader("Events", $css, $js, '', 0);

output_page_menu();


if ( !( isset($_GET["newsid"]) && is_numeric($_GET["newsid"]) )  ) {
    echo '<h1>400 Bad request</h1>';
}
else{
      $this_news_id = fix_str($_GET["newsid"]); // prevent html injection

    $news_handle = new Db_news();
    $user_handle = new Db_user();
    $aNews = $news_handle->show_single_news($this_news_id);
    //print_r($aNews);
    if (empty($aNews)) {
        echo '<h1>400 Page not found!</h1>';
    } else {
        echo '
        <script type="text/javascript">
tinymce.init({
    selector: "textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script> ';
        echo'<form action="news_action.php" method="POST">';

        echo '<h1>', '<input type="text" name="news_title" size=80 value="', $aNews["subject"], '">', '</h1> ';
        echo '<div > <table > <tr> <td>',
        '<textarea type="text" name="news_body"  cols="80" rows="20" > ', $aNews["body"], '</textarea>',
        '</td></tr></table></div>';

        echo '<input type="submit" name="submit_modify" value="Modify" />';
        echo '<input type="hidden" name="news_id" value="', $this_news_id, '"/>';
        //echo '<input type="hidden" name="event_uid" value="', $user_handle->get_uid_by_name($_SESSION['username'])  , '">';
        echo '<input type="hidden" name="news_uid" value="', 1, '">';
        echo '</form>';

        echo '<div >',
        'createtime:', $aNews["createtime"], ' lastedit:', $aNews["lastedit"]
        , '</div>';
       
    }
}
   

// replay form
getFooter();
?>
