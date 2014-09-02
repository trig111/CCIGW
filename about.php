<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once("include/demoframe.php");



$css='';

$js=array('group5js/check.js');
getHeader("About",$css,$js);
output_page_menu();

echo <<<ZZEOF

	<div style="width:40%;margin:0 auto;">
		<div class="well">
                <br /><br />
		<p>Chinese Culture Institute of Great Windsor (CCIGW) is a non-profit organization.
		 It was founded in February of 2005. Based on the Children's Singing and Dancing 
		 Class, the institute now gives seven yearly running Chinese Culture related 
		 courses. The mission of Chinese Culture Institute of Great Windsor is to promote
		  the understanding and exchange in cultures between Chinese Canadian and local 
		  Canadian, to enrich the spare life of Chinese Canadian, and to help them educate
			their children with Chinese tradition and culture. *<p>
		
		<small><a href="http://chinatownwiki.com/wiki/index.php?title=Chinese_Culture_Institute_of_Great_Windsor">*Wikipedia</a></small>
		<br /><br />
		</div></div>
ZZEOF;


getFooter();

?>