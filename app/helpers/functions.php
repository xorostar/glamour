<?php
$db = new Database;

function loadMenu(){
	global $db;
	$db->query('SELECT * FROM menu_items ORDER BY menu_item_order ASC;');
	$results = $db->fetchAll();
	return $results;
}

function loadSubmenu($menu_item){
	global $db;
	$db->query("SELECT * FROM submenu_items WHERE menu_item_id = {$menu_item->menu_item_id} ORDER BY submenu_item_order ASC");
	$results = $db->fetchAll();
	return $results;
}


function loadStoreData(){
	global $db;
	$db->query("SELECT * FROM store");
	$results = $db->fetchOne();
	return $results;
}

function getCartItemsCount(){
	global $db;
	if(isset($_SESSION['user_id'])){
		$user_id = $_SESSION['user_id'];
		$db->query("SELECT COUNT(*) AS count FROM cart_items AS ci, cart AS c WHERE ci.cart_id = c.cart_id AND c.customer_id = {$user_id}");
		$results = $db->fetchOne();
		return $results->count;
	}else{
		return 0;
	}
}

function getCartItemsTotal(){
	global $db;
	if(isset($_SESSION['user_id'])){
		$user_id = $_SESSION['user_id'];
		$db->query("SELECT SUM(ci.total_price) AS sum FROM cart_items AS ci, cart AS c WHERE ci.cart_id = c.cart_id AND c.customer_id = {$user_id}");
		$results = $db->fetchOne();
		return $results->sum;
	}else{
		return 0;
	}
}

	function customSanitizer($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

?>
