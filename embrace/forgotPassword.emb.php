<?php
//start session
session_start();

//load and initialize user class
require 'dbh.emb.php';
$user = new User();




if(isset($_POST['forgotSubmitQ'])){
    //check whether email is empty
    if(!empty($_POST['email'])){
        //check whether user exists in the database
        $prevCon['where'] = array('emailUsers'=>$_POST['email']);
        $prevCon['return_type'] = 'count';
        $prevUser = $user->getRows($prevCon);
        if($prevUser > 0){
			$sql = "SELECT * FROM users WHERE emailUsers=?;";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: ../forgotPassword.php?error=sqlerror");
				 exit();
			}
			else {
				$mailuid = $_POST['email'];
				mysqli_stmt_bind_param($stmt, "s", $mailuid);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				if ($row = mysqli_fetch_assoc($result)) {

					  $_SESSION['email'] = $row['emailUsers'];
					  $_SESSION['sq1'] = $row['sq1Users'];
					  $_SESSION['sq2'] = $row['sq2Users'];
					  $_SESSION['sqa1'] = $row['sqa1Users'];
					  $_SESSION['sqa2'] = $row['sqa2Users'];
				}
			}
		}
		else {
			$sessData['status']['type'] = 'error';
			$sessData['status']['msg'] = 'Email does not exist';
		header("Location: ../forgotPassword.php");
		exit();
		}
	}
	else{
			$sessData['status']['type'] = 'error';
			$sessData['status']['msg'] = 'Email empty';
	}
    //redirect to the forgot pasword page
    header("Location: ../securityQuestions.php");
}









if(isset($_POST['forgotSubmit'])){
    //check whether email is empty
    if(!empty($_POST['email'])){
        //check whether user exists in the database
        $prevCon['where'] = array('emailUsers'=>$_POST['email']);
        $prevCon['return_type'] = 'count';
        $prevUser = $user->getRows($prevCon);
        if($prevUser > 0){
		//check security questions
			$sqa1Check = password_verify($_POST['sqa1'], $_SESSION['sqa1']);
			$sqa2Check = password_verify($_POST['sqa2'], $_SESSION['sqa2']);
			if ($sqa1Check == true && $sqa2Check == true  ) {
    
        
 
				//generat unique string
				$uniqidStr = md5(uniqid(mt_rand()));;

				//update data with forgot pass code
				$conditions = array('emailUsers'=>$_POST['email']);
				$data = array('forgot_pass_identity'=>$uniqidStr);


				$update = $user->update($data, $conditions);

				if($update){
					$resetPassLink = 'https://localhost/resetPassword.php?fp_code='.$uniqidStr;

					//get user details
					$con['where'] = array('emailUsers'=>$_POST['email']);
					$con['return_type'] = 'single';
					$userDetails = $user->getRows($con);

					//send reset password email
					$to = $userDetails['emailUsers'];
					$subject = "Password Update Request";
					$mailContent = 'Dear '.$userDetails['fnameUsers'].',
						<br />Recently a request was submitted to reset a password for your account. If this was a mistake, just ignore this email and nothing will happen.
						<br />To reset your password, visit the following link: <a href="'.$resetPassLink.'">'.$resetPassLink.'</a>
						<br /><br />Regards,
						<br />The Laughing Man';
					//set content-type header for sending HTML email
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
					//additional headers
					$headers .= 'From:theLaughingMan@naMgnihguaLeht.com>' . "\r\n";
					//send email
					mail($to,$subject,$mailContent,$headers); 

					$sessData['status']['type'] = 'success';
					$sessData['status']['msg'] = 'Please check your e-mail, we have sent a password reset link to your registered email.';
				}
				else{
				$sessData['status']['type'] = 'error';
				$sessData['status']['msg'] = 'Some problem occurred, please try again.';
				}
			}
			else if ($sqa1Check == false || $sqa2Check == false){
				$sessData['status']['type'] = 'error';
			$sessData['status']['msg'] = 'Security Question Wrong';
			}
		}
		else{
			$sessData['status']['type'] = 'error';
			$sessData['status']['msg'] = 'Given email is not associated with any account.';
		}

    }
	else{
    $sessData['status']['type'] = 'error';
    $sessData['status']['msg'] = 'Enter email to create a new password for your account.';
    }
    //store reset password status into the session
    $_SESSION['sessData'] = $sessData;
    //redirect to the forgot pasword page
    header("Location: ../forgotPassword.php");
}
	
	
	
	
	
elseif(isset($_POST['resetSubmit'])){
    $fp_code = '';
    if(!empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['fp_code'])){
		$fp_code = $_POST['fp_code'];
		//password and confirm password comparison
		if($_POST['password'] !== $_POST['confirm_password']){
			$sessData['status']['type'] = 'error';
			$sessData['status']['msg'] = 'Confirm password must match with the password.';
		}else{
			//check whether identity code exists in the database
			$prevCon['where'] = array('forgot_pass_identity' => $fp_code);
			$prevCon['return_type'] = 'single';
			$prevUser = $user->getRows($prevCon);
			if(!empty($prevUser)){
				//update data with new password
				$conditions = array(
				'forgot_pass_identity' => $fp_code
				);
				$data = array(
				'pwdUsers' => password_hash($_POST['password'], PASSWORD_DEFAULT)
				);
				$update = $user->update($data, $conditions);
				//destroy token
				$conditions = array(
				'forgot_pass_identity' => $fp_code
				);
				$data = array(
				'forgot_pass_identity' => NULL
				);
				$update = $user->update($data, $conditions);
				//status
				if($update){
				$sessData['status']['type'] = 'success';
				$sessData['status']['msg'] = 'Your account password has been reset successfully. Please login with your new password.';
				}else{
				$sessData['status']['type'] = 'error';
				$sessData['status']['msg'] = 'Some error occurred, please try again.';
				}
			}else{
			$sessData['status']['type'] = 'error';
			$sessData['status']['msg'] = 'You are not authorized to reset new password of this account.';
			}
		}
	}else{
				$sessData['status']['type'] = 'error';
				$sessData['status']['msg'] = 'All fields are mandatory, please fill all the fields.';
	}
			//store reset password status into the session
			$_SESSION['sessData'] = $sessData;
			$redirectURL = ($sessData['status']['type'] == 'success')?'../index.php':'resetPassword.php?fp_code='.$fp_code;
			//redirect to the login/reset pasword page
			//header("Location:".$redirectURL);
			header("Location: ../index.php?error=resetsuccess");
}










