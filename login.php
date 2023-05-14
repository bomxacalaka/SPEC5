<?php
  // Include the header file
  include_once 'header.php';
?>

<!-- Create a div to contain the login form -->
<div class="box">

  <h1 class="maintitle">SPEC5</h1>

  <!-- Create the form element and set the action and method attributes -->
  <form action="includles/login.inc.php" method="post">
    <!-- Create a title for the form -->
    <h1 class="title">Log in/<a href='signup.php' class='link'>Signup</a> </h1>  

    <!-- Create a container for the username/email input field -->
    <div class="inputContainer">
      <input type="text" name="uid" class="input">
      <label class="label">Username/Email...</label>
    </div>

    <!-- Create a container for the password input field -->
    <div class="inputContainer">
      <input type="password" name="pwd" class="input">
      <label class="label">Password...</label>
    </div>

    <!-- Create a button for submitting the form -->
    <button class= btn type="submit" name="submit">Log in</button>
  
		<?php
		  // Check if the "error" query string parameter is set
		  if (isset($_GET["error"])){
			// If the parameter is set to "emptyinput", display an error message
			if ($_GET["error"] == "emptyinput"){
			  echo "<p>&#128683; Fill in all fields &#128683;</p>";
			}
			// If the parameter is set to "loginFail", display an error message
			else if($_GET["error"] == "loginFail"){
			  echo "<p>&#128683; Wrong username or password &#128683;</p>";
			}  
		  }
		?>
	</form>
</div>

<?php
  // Include the footer file
  include_once 'footer.php';
?> 
