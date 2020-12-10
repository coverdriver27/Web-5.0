<?php
  require "header.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js" type="text/javascript"></script>


<script type="text/javascript" src="zxcvbn.js"></script>
  </head>
  <body>
  

    <main>
      <div class="wrapper-main">
        <section class="section-default">
          <h1>Signup</h1>
          <?php
		  //signup error display
          if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyfields") {
              echo '<p class="signuperror">Fill in all fields!</p>';
            }
            else if ($_GET["error"] == "invaliduidmail") {
              echo '<p class="signuperror">Invalid username and e-mail!</p>';
            }
            else if ($_GET["error"] == "invaliduid") {
              echo '<p class="signuperror">Invalid username!</p>';
            }
            else if ($_GET["error"] == "invalidmail") {
              echo '<p class="signuperror">Invalid e-mail!</p>';
            }
            else if ($_GET["error"] == "passwordcheck") {
              echo '<p class="signuperror">Your passwords do not match!</p>';
            }
            else if ($_GET["error"] == "usertaken") {
              echo '<p class="signuperror">Username is already taken!</p>';
            }
            else if ($_GET["error"] == "g-captcha") {
              echo '<p class="signuperror">Please solve captcha before submit</p>';
            }
          }
		  //sign up success
          else if (isset($_GET["signup"])) {
            if ($_GET["signup"] == "success") {
              echo '<p class="signupsuccess">Signup successful! Check your email for activation</p>';
            }
          }
          ?>
		  <!-- HTML Input with php to recall if user filled field prior or print out input if its emtpy -->
          <form class="form-signup" action="embrace/signup.emb.php" method="post">
            <?php

            if (!empty($_GET["mail"])) {
              echo '<input type="text" name="mail" placeholder="E-mail" value="'.$_GET["mail"].'" required="">';
            }
            else {
              echo '<input type="text" name="mail" placeholder="E-mail" required="">';
            }
			 if (!empty($_GET["fname"])) {
              echo '<input type="text" name="fname" placeholder="First Name" value="'.$_GET["fname"].'" required="">';
            }
            else {
              echo '<input type="text" name="fname" placeholder="First Name" required="">';
            }
			 if (!empty($_GET["lname"])) {
              echo '<input type="text" name="lname" placeholder="Last Name" value="'.$_GET["lname"].'" required="">';
            }
            else {
              echo '<input type="text" name="lname" placeholder="Last Name" required="">';
            }
			if (!empty($_GET["bday"])) {
              echo '<label for="bday">Enter your Birthday:</label><input type="date" name="bday" value="'.$_GET["bday"].'" required="">';
            }
            else {
              echo '<label for="bday">Enter your Birthday:<input type="date" name="bday" required=""></label>';
            }
			//Security Questions section
            echo '<label for="sq1">Security Question:</label><select name="sq1">';

			echo '<option value="1">What was your childhood nickname?</option>
				  <option value="2">In what city or town did your mother and father meet?</option>
				  <option value="3">What is your favorite team?</option>
				  <option value="4">What school did you attend for sixth grade?</option>
				   </select>';
			echo '<input type="text" name="sqa1" placeholder="Answer for Question 1" required="">';
            echo '<label for="sq2">Security Question:</label><select name="sq2">';

			echo '<option value="1">What is the name of your favorite childhood friend?</option>
				  <option value="2">What is the middle name of your oldest child?</option>
				  <option value="3">What is your favorite movie?</option>
				  <option value="4">What was your favorite food as a child?</option>
				   </select>';
			echo '<input type="text" name="sqa2" placeholder="Answer for Question 2" required="">';            
            ?>
			<!-- sign up HTML input  -->
			<label>Minimum of 7 characters. Should have at least one special character and one number.
            <input type="password" name="pwd" placeholder="Password" id="password" pattern="(?=.*\d)(?=.*[\W_]).{7,}" required=""></label>
			<meter max="4" id="password-strength-meter" value=""></meter>
			<p id="password-strength-text"></p>
            <input type="password" name="pwd-repeat" placeholder="Repeat password" required="">
			<div class="g-recaptcha" data-sitekey="6LdvJ3YUAAAAALaoZuOn4IW0emZ_qdF8k3F5qdD7"></div>
            <button type="submit" name="signup-submit">Signup</button>

          </form>
        </section>
      </div>
    </main>

<?php
  require "footer.php";
?>
  </body>
  	<script src="pwdStr.js" type="text/javascript"></script>
</html>