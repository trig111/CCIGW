<?php

/*
 * import the XML and XSLT files, then transfor the XML file according the XSLT
 * 
 */

header('Content-Type: text/xml');

$xmlFile = new DOMDocument();
$xmlFile->load('simple.xml');

$xslFile = new DOMDocument();
$xslFile->load('products_to_table.xsl');

$proc = new XSLTProcessor();
$proc->importStylesheet($xslFile);
echo $proc->transformToXML($xmlFile);

?>
