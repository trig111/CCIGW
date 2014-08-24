<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once("include/demoframe.php");



$css=array('layout.css');

$js=array('jquery-1.3.1.min.js','meny.js','group5js/check.js');
getHeader("About",$css,$js,'',0);
output_page_menu();

echo <<<ZZEOF
	<div class="about">
		<svg width="100%" height="30%" version="1.1"
			xmlns="http://www.w3.org/2000/svg">

			<g transform="translate(10,10)"> 
				<text id="TextElement" x="150" y="0" style="font-family:Verdana;font-size:24; visibility:hidden">About Us
				<set attributeName="visibility" attributeType="CSS" to="visible" begin="1s" dur="5s" fill="freeze"/>
				<animateMotion path="M 0 0 L 100 100" begin="1s" dur="5s" fill="freeze"/>
				<animateTransform attributeName="transform" attributeType="XML" type="rotate" from="-30" to="0" begin="1s" dur="1s" fill="freeze"/> 
				<animateTransform attributeName="transform" attributeType="XML" type="scale" from="1" to="3" additive="sum" begin="1s" dur="2s" fill="freeze"/> 
				</text> 
			</g> 

		</svg>

		<p>Chinese Culture Institute of Great Windsor (CCIGW) is a non-profit organization.
		 It was founded in February of 2005. Based on the Children's Singing and Dancing 
		 Class, the institute now gives seven yearly running Chinese Culture related 
		 courses. The mission of Chinese Culture Institute of Great Windsor is to promote
		  the understanding and exchange in cultures between Chinese Canadian and local 
		  Canadian, to enrich the spare life of Chinese Canadian, and to help them educate
			their children with Chinese tradition and culture. *<p>
		
		<small><a href="http://chinatownwiki.com/wiki/index.php?title=Chinese_Culture_Institute_of_Great_Windsor">*Wikipedia</a></small>
		</div>
ZZEOF;


getFooter();

?>