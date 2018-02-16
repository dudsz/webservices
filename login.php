<?php

require_once 'functions.php';
$db = new Testing();
$jResponse = array("success" => 0);

if (isset($_POST['un']) && !empty($_POST['un']) 
	&& isset($_POST['pw']) && !empty($_POST['pw'])) {
	// Set values from post params
	$username = $_POST['un'];
	$password = $_POST['pw'];
	// Login user
	$user = $db->loginUser($username, $password);
	if ($user) {
		$jResponse["success"] = 1;
		$jResponse["msg"] = "Login successful";
		$jResponse["user"]["username"] = $user["un"];
		$jResponse["user"]["email"] = $user["email"];
		echo json_encode($jResponse);
	} else {
		// Wrong username or password
		$jResponse["success"] = 0;
		$jResponse["msg"] = "Incorrect username or password"; 
		echo json_encode($jResponse);
	} 
} else {
	// Bad post params, no values set
	$jResponse["success"] = 0;
	$jResponse["msg"] = "Bad parameters";
	echo json_encode($jResponse);
}

?>
