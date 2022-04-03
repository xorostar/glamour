<?php
// Simple page redirect
function redirect($page = '')
{
    header('LOCATION: ' . URLROOT . '/' . $page);
}

// Echo Prepared Link
function getLink($uri)
{
    echo URLROOT . '/' . $uri;
}

function sortbyurl($fieldname){
	$sorturl = "?sortby=" . $fieldname . "&sortorder=";
	$sorttype = "asc";
	if(isset($_GET['sortby']) && $_GET['sortby'] == $fieldname){
		if(isset($_GET['sortorder']) && $_GET['sortorder'] == "asc"){
			$sorttype = "asc";
		}
	}
	$sorturl .= $sorttype;
	return $sorturl;
}

// generating orderby and sort url
function sortorderurl($order){
	$fieldname = '';
	if(isset($_GET['sortby'])){
		$fieldname = $_GET['sortby'];
	}else{
		$fieldname = 'position';
	}
	$sorturl = "?sortby=" . $fieldname . "&sortorder=";
	$sorttype = $order;
	$sorturl .= $sorttype;
	return $sorturl;
}
