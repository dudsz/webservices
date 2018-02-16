<?php

require_once 'wishFunctions.php';
$db = new Testing();
$jResponse = array("success" => 0);

//Make sure that the content type of the POST request has been set to application/json
$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
if(strcasecmp($contentType, 'application/json') != 0) {
	$jResponse["msg"] = "Content type error";
	echo json_encode($jResponse);
}

$json_data = json_decode(file_get_contents('php://input'), true);

//If json_decode failed, the JSON is invalid.
if (!is_array($json_data)) {
	$jResponse["msg"] = "Bad json data";
	echo json_encode($jResponse);
}

$username = $json_data["un"];
$wishListName = $json_data["wln"];
$shareList = $json_data["sun"];

$result = array();
foreach ($shareList as $sUn) {
	if ($db->checkUser($sUn)) {
		if (!$db->checkSharing($username, $wishListName, $sUn)) {
			$shared = $db->shareWishList($username, $wishListName, $sUn);
			if (!$shared) {
				$shareResult["shareToUser"] = $sUn;
				$shareResult["msg"] = "Error sharing list, error: " . $shared;
				$result[] = $shareResult;
			}
		} else {
			$shareResult["shareToUser"] = $sUn;
			$shareResult["msg"] = "List already shared with user";
			$result[] = $shareResult;
		}
	} else {
		$shareResult["shareToUser"] = $sUn;
		$shareResult["msg"] = "User does not exist";
		$result[] = $shareResult;
	}
}
$jResponse["success"] = 1;
$jResponse["msg"] = "Successfully shared list";
$jResponse["friends"] = $result;
echo json_encode($jResponse);
?>
