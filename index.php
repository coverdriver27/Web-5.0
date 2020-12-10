

<?php
  require "header.php";
  require 'embrace/dbh.emb.php';
?>

<main>
    <div class="wrapper-main">
        <section class="section-default">
            <?php


			//visual error output
			if (isset($_GET["error"])) {
            if ($_GET["error"] == "notactive") {
              echo '<p class="signuperror">Account not activated! Check email.</p>';
            }
            else if ($_GET["error"] == "wrongpwd") {
              echo '<p class="signuperror">Password is not correct!</p>';
            }
			else if ($_GET["error"] == "resetsuccess") {
            echo '<p class="signuperror">Password is reset! Log in with new password.</p>';
            }
			else if ($_GET["error"] == "sadface") {
            echo '<p class="signuperror">You did an error :( </p>';
            }
			else if ($_GET["error"] == "nomap") {
            echo '<p class="signuperror">Map name is empty :( </p>';
            }
			else if ($_GET["error"] == "invalidmapname") {
            echo '<p class="signuperror">Not a valid map name use only A-Z characters :( </p>';
            }
			else if ($_GET["error"] == "sqlerror") {
            echo '<p class="signuperror">sqlerror</p>';
            }
			else if ($_GET["error"] == "maptaken") {
            echo '<p class="signuperror">Map name already exists</p>';
            }
			}
            if (!isset($_SESSION['id'])) {
            echo '<p class="login-status">Welcome Guest</p>';
			//display maps
			$sql = "SELECT mapName FROM map";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
			echo "<a href=guest-map.php?mn=".$row["mapName"].">".$row["mapName"]. " Map  </a>";
			 }
}			else {
			 echo "0 results";
				}
			$conn->close();
			//end display maps
			?>




          </form>
		  <?php

            }
            else if (isset($_SESSION['id']) && !isset($_SESSION['tfa'])) {
            echo '<p class="login-status">Hi, '.$_SESSION['fname'].' '.$_SESSION['lname'].'</p>';
			echo '<p class="login-status"> You have logged in '.$_SESSION['nlog'].' times </p>';
			echo '<p class="login-status"> Last login date: '.$_SESSION['date'].'</p>';
					  			//display maps
			$sql = "SELECT mapName FROM map";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {

			echo "<a href=user-map.php?mn=".$row["mapName"].">".$row["mapName"]. " Map  </a>";
			 }
}			else {
			 echo "0 results";
				}
			$conn->close();
			//end display maps

            }
            ?>
			<form class="form-signup" action="embrace/createmap.emb.php" method="post">
            <?php
            if (isset($_SESSION['id'])){ 
			echo '<input type="text" name="mapname" placeholder="Map Name" required="">';
			echo '<button type="submit" name="createmap">Create Map</button>';}
			?>
            
        </section>
        <body>

</body>
    </div>

</main>

<?php
  require "footer.php";
?>


