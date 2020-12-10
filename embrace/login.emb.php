<?php
if (isset($_POST['login-submit'])) {

  require 'dbh.emb.php';

  $mailuid = $_POST['mailuid'];
  $password = $_POST['pwd'];


  if (empty($mailuid) || empty($password)) {
    header("Location: ../index.php?error=emptyfields&mailuid=".$mailuid);
    exit();
  }
  else {

    $sql = "SELECT * FROM users WHERE emailUsers=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../index.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $mailuid);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $pwdCheck = password_verify($password, $row['pwdUsers']);
		if ($row['active']==0) {
			header("Location: ../index.php?error=notactive");
			exit();
		}
        if ($pwdCheck == false) {
          header("Location: ../index.php?error=wrongpwd");
          exit();
        }
        else if ($pwdCheck == true) {
		  //set session variables
          session_start();
          $_SESSION['id'] = $row['idUsers'];
          $_SESSION['email'] = $row['emailUsers'];
		  $_SESSION['fname'] = $row['fnameUsers'];
		  $_SESSION['lname'] = $row['lnameUsers'];
		  $_SESSION['nlog'] = $row['nlogUsers'];
		  $_SESSION['date'] = $row['logdate'];

		  //update login count
		  $log = $_SESSION['id'];
		  $sql="UPDATE users SET nlogUsers=nlogUsers+1 WHERE idUsers=$log";
		  if(mysqli_query($conn, $sql)){
          echo "Records were updated successfully.";
		  }
		  else {
		  echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
		  }	
		  
		  //update login date
		  date_default_timezone_set("America/Los_Angeles");
		  $log = $_SESSION['id'];
		  $date = date('Y-m-d H:i:s');
		  $sql="UPDATE users SET logdate='$date' WHERE idUsers=$log";
		  if(mysqli_query($conn, $sql)){
			  echo "Records were updated successfully.";
		  }
		  else {
			  echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
		  }		  
          header("Location: twoFactor.emb.php?good=pass");
          exit();
        }
      }
      else {
        header("Location: ../index.php?login=wronguidpwd");
        exit();
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else {
  header("Location: ../signup.php");
  exit();
}


