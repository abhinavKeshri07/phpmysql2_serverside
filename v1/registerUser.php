<?php
	require_once '../includes/DbOperations.php';
	$response = array();
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$response['myres'] = isset($_POST["username"]);
		$response['myres2'] = empty($_POST['username']);
		if( isset($_POST['username']) and isset($_POST['email']) and isset($_POST['password']) ){
			//operate the data further
			$db = new DbOperations();
			$result = $db->createUser($_POST['username'], $_POST['password'],$_POST['email']);
			if($result == 1){
				$response['error'] = false;
				$response['message'] = "user registered successfully";
			}elseif($result==2){
				$response['error'] = true;
				$response['message'] = "some error occured";
			}elseif($result == 0){
				$response['error'] = true;
				$response['message'] = "user already exist";
			}


		}else{
			$response['error'] = true;
			$response['message'] = "Required fields are missing";
		}
	}else{
		$response['error'] = true;
		$response['message'] = "Invalid Request";
	}

	echo json_encode($response);

?>
<!--
<!DOCTYPE html>
<html>
<head>
	<title>no title</title>
</head>
<body>
	<form action="registerUser.php" method="post">
		username: <input type="text" name="username"><br>
		email: <input type="text" name="email"> <br>
		password: <input type="password" name="password"><br>
		<input type="submit" name="submit" value="Submit" >
	</form>
</body>
</html>
-->