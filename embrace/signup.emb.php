<?php
if (isset($_POST['signup-submit'])) {
  require 'dbh.emb.php';
  //recaptcha variables
  $url = 'https://www.google.com/recaptcha/api/siteverify';
  $privatekey = "6LdvJ3YUAAAAAAC0COgTS8F842LLIVA35Yd3iJPf";
  $response = file_get_contents($url."?secret=".$privatekey."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_Server['REMOTE_ADDR']);
  $data = json_decode($response);
  //variables
  $email = $_POST['mail'];
  $firstname = $_POST['fname'];
  $lastname = $_POST['lname'];
  $birthday = $_POST['bday'];
  $secQ1 = $_POST['sq1'];
  $secQ2 = $_POST['sq2'];
  $secA1 = $_POST['sqa1'];
  $secA2 = $_POST['sqa2'];
  $password = $_POST['pwd'];
  $passwordRepeat = $_POST['pwd-repeat'];
  $hash = md5( rand(0,1000) );
  //Validation and error handler 

	 if (isset($data->success) AND $data->success==true) { //<-- recaptcha check

	   if (empty($email) || empty($firstname) || empty($lastname) || empty($password) || empty($passwordRepeat)){
		header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
		exit();
	  }
	  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header("Location: ../signup.php?error=invalidmail");
		exit();
	  }
	  else if (!preg_match("/^[a-zA-Z]*$/", $firstname)) {
		header("Location: ../signup.php?error=invalidfirstname=".$firstname);
		exit();
	  }
	  else if (!preg_match("/^[a-zA-Z]*$/", $lastname)) {
		header("Location: ../signup.php?error=invalidlastname=".$lastname);
		exit();
	  }
	  else if ($password !== $passwordRepeat) {
		header("Location: ../signup.php?error=passwordcheck&mail=".$email);
		exit();
	  }

	  else {
	  //prepaired statments to enter user info into database
		$sql = "SELECT emailUsers FROM users WHERE emailUsers=?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
		  header("Location: ../signup.php?error=sqlerror");
		  exit();
		}
		else {
		  mysqli_stmt_bind_param($stmt, "s", $email);
		  mysqli_stmt_execute($stmt);
		  mysqli_stmt_store_result($stmt);
		  $resultCount = mysqli_stmt_num_rows($stmt);
		  mysqli_stmt_close($stmt);
		  if ($resultCount > 0) {
			header("Location: ../signup.php?error=usertaken&mail=".$email);
			exit();
		  }
		  else {
			$sql = "INSERT INTO users (emailUsers, fnameUsers, lnameUsers, 
			bdayUsers, sq1Users, sq2Users, sqa1Users, sqa2Users, hashUsers, 
			pwdUsers) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
			  header("Location: ../signup.php?error=sqlerror");
			  exit();
			}
			else {
			//password hash
			  $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
			  $hashedsecA1 = password_hash($secA1, PASSWORD_DEFAULT);
			  $hashedsecA2 = password_hash($secA2, PASSWORD_DEFAULT);
			  

			  mysqli_stmt_bind_param($stmt, "ssssssssss", $email, $firstname, $lastname, $birthday, $secQ1, $secQ2, $hashedsecA1, $hashedsecA2, $hash, $hashedPwd);
			  mysqli_stmt_execute($stmt);

			  //send reset password email
			  $accountActivationLink = 'https://localhost/embrace/verify.emb.php?fp_code='.$hash;
					$to = $email;
					$subject = "Account Activation Request";
					$mailContent = 'Dear '.$firstname.',
						<br />Thanks for signing up!
						<br />Your account has been created, you can login with your credentials after you have activated your account by visiting the url below.
						<br />To activate your account, visit the following link: <a href="'.$accountActivationLink.'">'.$accountActivationLink.'</a>
						<br /><br />Regards,
						<br />Ping it Crew';
					//set content-type header for sending HTML email
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
					//additional headers
					$headers .= 'From:theLaughingMan@naMgnihguaLeht.com>' . "\r\n";
					//send email
					mail($to,$subject,$mailContent,$headers); 


			  header("Location: ../signup.php?signup=success");
			  exit();


			}
		  }
		}
	  }
	}
	else { //recpatcha fail
		header("Location: ../signup.php?error=g-captcha");
		exit();
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	}
	else {
	  header("Location: ../signup.php");
	  exit();
	}


?>

	
