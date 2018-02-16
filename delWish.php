<?php

require_once 'wishFunctions.php';
$db = new Testing();
$jResponse = array("success" => 0);

if (isset($_POST['del']) && !empty($_POST['del'])
	&& isset($_POST['un']) && !empty($_POST['un'])
	&& isset($_POST['wln']) && !empty($_POST['wln'])
	&& isset($_POST['win']) && !empty($_POST['win'])) {

	// Set values from post params
	$del = $_POST['del'];
	$un = $_POST['un'];
	$wln = $_POST['wln'];
	$win = $_POST['win'];

	// Delete wish
	if ($del == 1) {
		$result = $db->delWish($un, $wln, $win);
		if ($result) {
			$jResponse["success"] = 1;
			$jResponse["msg"] = "Wish deleted successfully";
			echo json_encode($jResponse);
		} else {
			// Failed to delete
			$jResponse["success"] = 0;
			$jResponse["msg"] = "Wish not deleted";
			echo json_encode($jResponse);
		}
	} else {
		// Failed to delete
		$jResponse["success"] = 0;
		$jResponse["msg"] = "Wrong delete param";
		echo json_encode($jResponse);
	}
} else {
	// Bad post params, no values set
	$jResponse["error"] = TRUE;
	$jResponse["success"] = 0;
	$jResponse["msg"] = "Bad params";
	echo json_encode($jResponse);
}

?>
