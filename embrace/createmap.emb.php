<?php


session_start();

if (isset($_POST['createmap'])) {
	require 'dbh.emb.php';
	//variables
	$cm = $_POST['mapname'];
	$id = $_SESSION['id'];
	if (empty($cm)){
		header("Location: ../index.php?error=nomap");
		exit();
	}
	else if (!preg_match("/^[a-zA-Z]*$/", $cm)) {
		header("Location: ../index.php?error=invalidmapname");
		exit();
	}

	else {
	    //prepaired statments to enter user info into database
		$sql = "SELECT mapName FROM map WHERE mapName=?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
		  header("Location: ../index.php?error=sqlerror");
		  exit();
	    }
		else {
		  mysqli_stmt_bind_param($stmt, "s", $cm);
		  mysqli_stmt_execute($stmt);
		  mysqli_stmt_store_result($stmt);
		  $resultCount = mysqli_stmt_num_rows($stmt);
		  mysqli_stmt_close($stmt);
		  if ($resultCount > 0) {
			header("Location: ../index.php?error=maptaken");
			exit();
		  }
		  else {
		    
			//insert map
			$sql = "INSERT INTO map (mapName, mapAdmin) VALUES ( ?, ?)";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
			  header("Location: ../index.php?error=sqlerror");
			  exit();
			}
			else {
			  
			  mysqli_stmt_bind_param($stmt, 'ss', $cm, $id);
			  mysqli_stmt_execute($stmt);

			  //create marker table
			  $sql = "CREATE TABLE `".$cm."` (
				 `id` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
				`lat` FLOAT( 10, 6 ) NOT NULL ,
				`lng` FLOAT( 10, 6 ) NOT NULL ,
				`description` varchar(200) NOT NULL,
				`location_status` tinyint(1) DEFAULT '0'
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
			  $stmt = mysqli_stmt_init($conn);

			  if (!mysqli_stmt_prepare($stmt, $sql)) {
			  header("Location: ../index.php?error=sqlerror");
			  exit();
			  }
			  else {
		  mysqli_stmt_bind_param($stmt, "s", $cm);
		  mysqli_stmt_execute($stmt);
		  mysqli_stmt_store_result($stmt);
		  mysqli_stmt_close($stmt);
		  }
			  header("Location: ../user-map.php?mn=".$cm);
			  exit();
		    }
		  }
	    }
    }
	

	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}
	else {
	  header("Location: ../index.php");
	  exit();
	}


?>

	
