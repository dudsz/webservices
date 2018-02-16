<?php

require_once 'functions.php';
$db = new Testing();
$jResponse = array("error" => FALSE);

if (isset($_POST['delete']) && !empty($_POST['delete']) 
	&& isset($_POST['un']) && !empty($_POST['un'])) {
	// Set values from post params
	$username = $_POST['un'];

	if (!$db->checkUser($username)) {
		// User exists
		$jResponse["success"] = 0;
		$jResponse["msg"] = "User does not exist"; 
		echo json_encode($jResponse);
	} else {
		// Reg user
		$result = $db->delUser($username); 
		if ($result) {
			$jResponse["success"] = 1;
			$jResponse["msg"] = "User deleted successfully"; 
			echo json_encode($jResponse);
		} else {
			// Failed to register
			$jResponse["success"] = 0;
			$jResponse["msg"] = "User not deleted"; 
			echo json_encode($jResponse);
			//echo "Error occurred while registering \n";
		}
	} 
} else {
	// Bad post params, no values set
	$jResponse["error"] = TRUE;
	$jResponse["success"] = 0;
	$jResponse["msg"] = "Bad params"; 
	echo json_encode($jResponse);
}

?>