<?php
  require "header.php";
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" href="style.css">
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
					<h2>Two Factor Authentication</h2>';
						echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; 
							echo '<form class="form-signup" action="embrace/twoFactor.emb.php" method="post">
								<label>Input your two factor Authentication code: 
								<input type="number" min="1000" max="9999" name="code" require=""> 
								<div class="send-button">
									<button type="submit" name="twoFactor" >Submit</button>
								</div>
							</form>
				</section>
			</div>';
?>
    
</main>
    
</body>
</html>