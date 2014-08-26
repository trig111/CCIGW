<?php
require_once('dblib/db_events.php');

$sql = "SELECT COUNT(eventsid) FROM `db_events`";
$row = mysqli_fetch_row($query);

$rows = $row[0];

$page_rows = 10;

$last = ceil($rows/$page_rows);

if($last < 1){
	$last = 1;
}

$pagenum = 1;

if(isset($_GET['pn'])){
	$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
}

if ($pagenum < 1) { 
    $pagenum = 1; 
} else if ($pagenum > $last) { 
    $pagenum = $last; 
}

$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;

$sql = "SELECT `eventsid`, `subject`, `body`, `categoryid`, `createtime`, `startime`, `endtime`, `maxmember`, `lastedit` FROM `db_events` ORDER BY eventsid DESC $limit";

$textline1 = "Testimonials (<b>$rows</b>)";
$textline2 = "Page <b>$pagenum</b> of <b>$last</b>";

$paginationCtrls = '';

if($last != 1){

	if ($pagenum > 1) {
        $previous = $pagenum - 1;
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'">Previous</a> &nbsp; &nbsp; ';
		
		for($i = $pagenum-4; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
			}
	    }
    }
	
	$paginationCtrls .= ''.$pagenum.' &nbsp; ';
	
	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
		if($i >= $pagenum+4){
			break;
		}
	}
	
    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'">Next</a> ';
    }
}
$list = '';
while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
	$eventsid = $row["eventsid"];
	$subject = $row["subject"];
	$body = $row["body"];
	$createtime = $row["createtime"];
	$createtime = strftime("%b %d, %Y", strtotime($createtime));
	$list .= '<p><a href="events.php?id='.$eventsid.'">'.$subjecy.' Testimonial</a> - Click the link to view this testimonial<br>Written '.$createtime.'</p>';
}
?>