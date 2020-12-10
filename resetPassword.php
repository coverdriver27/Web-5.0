<?php

require  "header.php";
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <title></title>
	<style>

	</style>
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
		echo '<div class="wrapper-main">
				<section class="section-default">
					<h2>Reset Your Account Password</h2>';
						echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; 
							echo '<form class="form-signup" action="embrace/forgotPassword.emb.php" method="post">
								<label>Minimum of 7 characters. Should have at least one special character and one number.
								<input type="password" name="password" placeholder="PASSWORD" pattern="(?=.*\d)(?=.*[\W_]).{7,}" required=""></label>
								<input type="password" name="confirm_password" placeholder="CONFIRM PASSWORD" pattern="(?=.*\d)(?=.*[\W_]).{7,}" required="">
								<div class="send-button">
									<input type="hidden" name="fp_code" value="'.$_REQUEST['fp_code'].'"/>
									<button type="submit" name="resetSubmit" >Submit</button>
								</div>
							</form>
				</section>
			</div>';
?>
</main>
</body>
</html>

