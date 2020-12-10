<?php

require  "header.php";
?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
</head>
<body>
<?php


$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
?>

<?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
<div class="container">
    <div class="wrapper-main">
        <section class="section-default">
		<h1>Answer Security Questions</h1>
        <form class="form-signup" action="embrace/forgotPassword.emb.php" method="post">
            <?php 
				echo '<input type="hidden" name="email" value="'.$_SESSION['email'].'" required="">';
				echo '<p>Email: '.$_SESSION['email'].'</p>';
				if ($_SESSION['sq1'] == '1'){
					echo '<p>What was your childhood nickname?</p>';
					echo '<input type="text" placeholder="Answer" name="sqa1">';
				}
			    else if ($_SESSION['sq1'] == '2'){
					echo '<p>In what city or town did your mother and father meet?</p>';
					echo '<input type="text" placeholder="Answer" name="sqa1">';
				}
			    else if ($_SESSION['sq1'] == '3'){
					echo '<p>What is your favorite team?</p>';
					echo '<input type="text" placeholder="Answer" name="sqa1">';
				}
			    else if ($_SESSION['sq1'] == '4'){
					echo '<p>What school did you attend for sixth grade?</p>';
					echo '<input type="text" placeholder="Answer" name="sqa1">';
				}
			    if ($_SESSION['sq2'] == '1'){
					echo '<p>What is the name of your favorite childhood friend?</p>';
					echo '<input type="text" placeholder="Answer" name="sqa2">';
				}
			    else if ($_SESSION['sq2'] == '2'){
					echo '<p>What is the middle name of your oldest child?</p>';
					echo '<input type="text" placeholder="Answer" name="sqa2">';
				}
			    else if ($_SESSION['sq2'] == '3'){
					echo '<p>What is your favorite movie?</p>';
					echo '<input type="text" placeholder="Answer" name="sqa2">';
				}
			    else if ($_SESSION['sq2'] == '4'){
					echo '<p>What was your favorite food as a child?</p>';
					echo '<input type="text" placeholder="Answer" name="sqa2">';
				}
			?>
			
            <div class="send-button">
                <button type="submit" name="forgotSubmit" >Submit</button>
            </div>
        </form>
		</section>
    </div>
</div>
	


</body>
</html>