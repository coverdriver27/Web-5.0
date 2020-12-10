
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
	session_start();
			require 'dbh.emb.php';
			//$user = new User();
			if(isset($_POST['twoFactor'])){
			$pass = $_POST['code'];
			if($pass == $_SESSION['2fa']){
				header("Location: ../index.php");
				exit();
			}
			else{
			$sessData['status']['type'] = 'error';
			$sessData['status']['msg'] = 'code wrong try again.';			
			}
			$_SESSION['sessData'] = $sessData;
			header("Location: ../twoFactor.php");
			exit();
		}
		if ($_GET["good"] != "pass") {
			header("Location: ../index.php?error=sadface");
            exit();
		}
        else if ($_GET["good"] == "pass"){


			$name = $_SESSION['fname'];
			$code = rand(1000,9999);
			$to = $_SESSION['email'];
			$subject = "Two Factor Authentication Request";
			$mailContent = 'Dear '.$name.',
				<br />Your two factor authentication code is: '.$code.'</a>
				<br /><br />Regards,
				<br />Ping It Crew';
			//set content-type header for sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			//additional headers
			$headers .= 'From:ping@it.com>' . "\r\n";
			//send email
			mail($to,$subject,$mailContent,$headers); 
			$_SESSION['2fa'] = $code;
			/*
			$conditions = array('emailUsers'=>$to);
			$data = array('tfa'=>$code);
			$update = $user->update($data, $conditions);
			*/
			header("Location: ../twoFactor.php");
			exit();
        }

    ?>
        
    
</body>
</html>