<?php
require "header.php"; 
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <title></title>

</head>
<body>
<main>
<?php


$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
?>



<?php 

if (isset($_SESSION['email'])){
session_destroy();
session_start();
}
echo '

      <div class="wrapper-main">
        <section class="section-default">
		<h1>Enter the Email of Your Account to Reset New Password</h1>';
echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; 
echo '
        <form class="form-signup" action="embrace/forgotPassword.emb.php" method="post">
            <input type="email" name="email" placeholder="EMAIL" required="">
            <div class="send-button">
                <button type="submit" name="forgotSubmitQ" value="CONTINUE">Submit</button>
            </div>
        </form>
    </section>
</div>';

?>
</main>
</body>
</html>

