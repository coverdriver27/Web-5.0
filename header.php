<?php 

session_start();

?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <title></title>
   <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav class="nav-header-main">
            <a class="header-logo" href="index.php">
                <img src="img/logo.gif" alt="Group 1 logo">
            </a>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Group Members</a></li>
                <li><a href="#">About Us</a></li>
            </ul>
            <div class="header-login">
                <?php
                if (!isset($_SESSION['id'])) {
                echo '<form action="embrace/login.emb.php" method="post">
                    <input type="text" name="mailuid" placeholder="E-mail">
                    <input type="password" name="pwd" placeholder="Password">
                    <button type="submit" name="login-submit">Login</button>
                </form>
				<form action="forgotPassword.php">
				<button type="submit" name="forgotButton">Forgot Password</button>
				</form>
				<form action="signup.php">
                <button type="submit" name="signup">Sign up</button>
				</form>
				';
				
                }
                else if (isset($_SESSION['id'])) {
                echo '<form action="embrace/logout.emb.php" method="post">
                    <button type="submit" name="logout-submit">Logout</button>
                </form>';
                }
                ?>
            </div>
        </nav>
    </header>
	<style>
	    /* Optional: Makes the sample page fill the window. */
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
 /* Always set the map height explicitly to define the size of the div
 * element that contains the map. */
    #map {
        height: 100%;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</body>
</html>