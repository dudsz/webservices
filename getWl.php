<?php

require_once 'wishFunctions.php';
$db = new Testing();
$jResponse = array("success" => 0);

if (isset($_POST['un']) && !empty($_POST['un']) 
	&& isset($_POST['wl']) && !empty($_POST['wl'])) {
	// Set values from post params
	$username = $_POST['un'];
	$wishlist = $_POST['wl'];
	// Login user
	$wl = $db->getWishList($username, $wishlist);
	if ($wl) {		
		$jResponse["success"] = 1;
		$jResponse["username"] = $username;
		$jResponse["wishList"] = $wishList;
		$jResponse["wishes"] = $wl;
		echo json_encode($jResponse);
	} else {
		// Failed to find wishList
		$jResponse["success"] = 0;
		$jResponse["msg"] = "Wishlist not found"; 
		echo json_encode($jResponse);
	} 
} else {
	// Bad post params, no values set
	$jResponse["success"] = 0;
	$jResponse["msg"] = "Bad parameters"; 
	echo json_encode($jResponse);
}

?>
