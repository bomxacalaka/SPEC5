<?php
  // Include header.php
  include_once 'header.php';
?>

<!-- HTML sign up form -->
<div class="box">

<h1 class="maintitle">Spec5</h1>

  <form action="includles/signup.inc.php" method="post">
    <h1 class="title">Sign up/<a href='login.php' class='link'>Login</a></h1>   

    <div class="inputContainer">
      <input class="input" type="text" name="name">
      <label class="label">Full name</label>
    </div>

    <div class="inputContainer">
      <input class="input" type="text" name="email">
      <label class="label">Email</label>
    </div>

    <div class="inputContainer">
      <input class="input" type="text" name=uid>
      <label class="label">Username</label>
    </div>

    <div class="inputContainer">
      <input class="input" type="password" name="pwd">
      <label class="label">Password</label>
    </div>

    <div class="inputContainer">
      <input class="input" type="password" name="pwdrepeat">
      <label class="label">Repeat Password</label>
    </div>

    <button class="btn" type="submit" name="submit">Sign up</button>
 

<?php
  // Check for errors in signup process
  if (isset($_GET["error"])) {
    if ($_GET["error"] == "emptyinput") {
      echo "<p>&#128683; Fill in all fields &#128683;</p>";
    }
    elseif ($_GET["error"] == "invalidUid") {
      echo "<p>&#128683; Invalid username &#128683;</p>";
    }
    elseif ($_GET["error"] == "invalidEmail") {
      echo "<p>&#128683; Invalid email &#128683;</p>";
    }
    elseif ($_GET["error"] == "pwdMatchFail") {
      echo "<p>&#128683; Your passwords do not match &#128683;</p>";
    }
    elseif ($_GET["error"] == "pwdLengthFail") {
      echo "<p>&#128683; Password is too short &#128683;</p>";
    }
    elseif ($_GET["error"] == "uidTaken") {
      echo "<p>&#128683; Username or email are already in use &#128683;</p>";
    }
    elseif ($_GET["error"] == "stmtfailed") {
      echo "<p>&#128683; Something went wrong, try again &#128683;</p>";
    }
    
    elseif ($_GET["error"] == "None") {
      echo "<p>&#127881; You are signed up congrats! &#127881;</p>";
    }
  }
?>

   </form>
</div>

<?php
  // Include footer.php
  include_once 'footer.php';
?> 
