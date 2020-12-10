<?php
require "header.php"; 
?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
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
		<h1>Account Activated</h1>';
echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; 
echo '

    </section>
</div>';

?>
</main>
</body>
</html>