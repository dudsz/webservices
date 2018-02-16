<?php

require_once 'wishFunctions.php';
$db = new Testing();
$jResponse = array("success" => 0);

if (isset($_POST['un']) && !empty($_POST['un'])) {
	// Set values from post params
	$username = $_POST['un'];
	// User whose list we are getting
	$fList = $db->getFriendList($username);
	if ($fList) {
		$jResponse["success"] = 1;
		$jResponse["msg"] = "Friends found";
		$list = array();
		foreach ($fList as $friend) {
			$list[] = $friend["shareToUser"];
		}
		$jResponse["friends"] = $list;
		echo json_encode($jResponse);
	} else {
		// Failed to find a list for specifed user
		$jResponse["success"] = 0;
		$jResponse["msg"] = "No friends found";
		echo json_encode($jResponse);
	}
} else {
	// Bad post params, no values set
	$jResponse["success"] = 0;
	$jResponse["msg"] = "Bad parameters";
	echo json_encode($jResponse);
}
?>
