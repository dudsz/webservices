<?php

require_once 'wishFunctions.php';
$db = new Testing();
$jResponse = array("error" => FALSE);

if (isset($_POST['un']) && !empty($_POST['un']) 
	&& isset($_POST['wln']) && !empty($_POST['wln']) 
	&& isset($_POST['win']) && !empty($_POST['win'])
	&& isset($_POST['widesc']) && !empty($_POST['widesc'])
	&& isset($_POST['wiaa']) && !empty($_POST['wiaa'])) {
	// Set values from post params
	$username = $_POST['un'];
	$wishListName = $_POST['wln'];
	$wishItemName = $_POST['win'];
	$wishItemDesc = $_POST['widesc'];
	$wishItemAvailableAt = $_POST['wiaa'];

	if ($db->getWish($username, $wishListName, $wishItemName)) {
		// Wish already exists
		$jResponse["error"] = FALSE;
		$jResponse["success"] = 0;
		$jResponse["msg"] = "Wish already exists";
		echo json_encode($jResponse);
	} else {
	 	$wish = $db->addWish($username, $wishListName, $wishItemName, 
	 		$wishItemDesc, $wishItemAvailableAt);
		if ($wish) {
			$jResponse["error"] = FALSE;
			$jResponse["success"] = 1;
			$jResponse["msg"] = "Wish added";
			echo json_encode($jResponse);
		} else {
			// Failed to register
			$jResponse["error"] = FALSE;
			$jResponse["success"] = 0;
			$jResponse["msg"] = "Wish not added"; 
			echo json_encode($jResponse);
		}
	} 
} else {
	// Bad post params, no values set
	$jResponse["error"] = TRUE;
	$jResponse["success"] = 0;
	$jResponse["msg"] = "Bad parameters"; 
	echo json_encode($jResponse);
}	 
?>