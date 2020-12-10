<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
</head>
<body>

</body>
</html>

<?php 

//start session
session_start();

//load and initialize user class
require 'dbh.emb.php';
$user = new User();




    $fp_code = '';
    if(!empty($_REQUEST['fp_code'])){
		$fp_code = $_REQUEST['fp_code'];
		//password and confirm password comparison
		
			//check whether identity code exists in the database
			$prevCon['where'] = array('hashUsers' => $fp_code);
			$prevCon['return_type'] = 'single';
			$prevUser = $user->getRows($prevCon);
			if(!empty($prevUser)){
				//update data with new password
				$conditions = array(
				'hashUsers' => $fp_code
				);
				$data = array(
				//'pwdUsers' => md5($_POST['password'])
				'active' => 1
				);
				$update = $user->update($data, $conditions);
				//delete hash
				$conditions = array(
				'hashUsers' => $fp_code
				);
				$data = array(
				'hashUsers' => null
				);
				$update = $user->update($data, $conditions);

				if($update){
				$sessData['status']['type'] = 'success';
				$sessData['status']['msg'] = 'Your account has been activated successfully. You may now login.';
				}else{
				$sessData['status']['type'] = 'error';
				$sessData['status']['msg'] = 'Some error occurred, please try again.';
				}
			}else{
			$sessData['status']['type'] = 'error';
			$sessData['status']['msg'] = 'You are not authorized to activate this account.';
			}
		
	}else{
				$sessData['status']['type'] = 'error';
				$sessData['status']['msg'] = 'No....';
	}
			//store reset password status into the session
			$_SESSION['sessData'] = $sessData;
			$redirectURL = ($sessData['status']['type'] == 'success')?'../verify.php':'verify.php?fp_code='.$fp_code;
			//redirect to the login/reset pasword page
			header("Location:../".$redirectURL);



?>