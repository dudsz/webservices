<?php

require_once 'functions.php';
$db = new Testing();
$jResponse = array("success" => 0);

if (isset($_POST['un']) && !empty($_POST['un']) 
	&& isset($_POST['pw']) && !empty($_POST['pw']) 
	&& isset($_POST['email']) && !empty($_POST['email'])) {
	// Set values from post params
	$username = $_POST['un'];
	$password = $_POST['pw'];
	$email = $_POST['email'];

	if ($db->checkUser($username)) {
		// Username used
		$jResponse["success"] = 0;
		$jResponse["msg"] = "Username already in use";
		echo json_encode($jResponse);
	} elseif ($db->checkEmail($email)) {
 		// Email used
		$jResponse["success"] = 0;
		$jResponse["msg"] = "Email already in use";
		echo json_encode($jResponse);
	} else {
		// Reg user
		$user = $db->regUser($username, $password, $email); 
		if ($user) {
			$jResponse["success"] = 1;
			$jResponse["msg"] = "User successfully registered";
			$jResponse["user"]["username"] = $user["un"];
			$jResponse["user"]["email"] = $user["email"]; 
			echo json_encode($jResponse);
		} else {
			// Failed to register
			$jResponse["success"] = 0;
			$jResponse["msg"] = "User not inserted"; 
			echo json_encode($jResponse);
		}
	}
} else {
	// Bad post params, no values set
	$jResponse["success"] = 0;
	$jResponse["msg"] = "Bad parameters";
	echo json_encode($jResponse);
}
?>
