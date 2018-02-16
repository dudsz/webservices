<?php

require_once 'wishFunctions.php';
$db = new Testing();
$jResponse = array("error" => FALSE);

if (isset($_POST['un']) && !empty($_POST['un'])
	&& isset($_POST['wln']) && !empty($_POST['wln'])) {
	// Set values from post params
	$username = $_POST['un'];
	$wishListName = $_POST['wln'];

	if ($db->checkWishListName($username, $wishListName)) {
		// User exists
		$jResponse["error"] = FALSE;
		$jResponse["success"] = 0;
		$jResponse["msg"] = "Wish list already exists";
		echo json_encode($jResponse);
	} else {
		// Add wish list
		$wishList = $db->addWishList($username, $wishListName);
		if ($wishList) {
			$jResponse["error"] = FALSE;
			$jResponse["success"] = 1;
			$jResponse["msg"] = "Wish list successfully added";
			echo json_encode($jResponse);
		} else {
			// Failed to add wish list
			$jResponse["error"] = FALSE;
			$jResponse["success"] = 0;
			$jResponse["msg"] = "Wish list not inserted";
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
