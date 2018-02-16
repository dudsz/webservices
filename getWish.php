<?php

require_once 'wishFunctions.php';
$db = new Testing();
$jResponse = array("error" => FALSE);

if (isset($_POST['un']) && !empty($_POST['un']) 
	&& isset($_POST['wl']) && !empty($_POST['wl'])
	&& isset($_POST['wn']) && !empty($_POST['wn'])) {
	// Set values from post params
	$username = $_POST['un'];
	$wishlist = $_POST['wl'];
	$wishName = $_POST['wn'];
	// Login user
	$wish = $db->getWish($username, $wishlist, $wishName);
	if ($wish) {		
		$jResponse["error"] = FALSE;
		$jResponse["success"] = 1;
		$jResponse["wish"]["wID"] = $wish["wID"];
		$jResponse["wish"]["wishName"] = $wish["wishName"];
		$jResponse["wish"]["wishDesc"] = $wish["wishDesc"];
		$jResponse["wish"]["wishPlace"] = $wish["wishPlace"];
		echo json_encode($jResponse);
	} else {
		// Failed to register
		$jResponse["error"] = FALSE;
		$jResponse["success"] = 0;
		$jResponse["msg"] = "Wish not found"; 
		echo json_encode($jResponse);
	} 
} else {
	// Bad post params, no values set
	$jResponse["error"] = TRUE;
	$jResponse["success"] = 0;
	$jResponse["msg"] = "Bad parameters"; 
	echo json_encode($jResponse);
}

?>