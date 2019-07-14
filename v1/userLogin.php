<?php
	requre_once '../includes/DbOperations.php';
	$response = array();
	if($_SERVER['REQUEST_METHOD']== 'POST'){
		if(isset($_POST['username'])and isset($_POST('password'))){
			$db = new DbOperations();
			if($db->userLogin($_POST['username'], $_POST['password'])){
				$user = $db->getUserByUsername();
				$response['error'] = false;
				$response['id'] = $user['id'];
				$response['email'] = $user['email'];
				$response['username'] = $user['username'];
			}else{
				$response['error'] = true;
				$response['message'] = "Username or password is incorrect."
			}
		}else{
			$response['error'] = true;
			$response['message'] = "Required fields are missing";
		}
	}
	echo json_encode($response);