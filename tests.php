<!-- 
  This file is part of a group work from 5CS024/UM1: Collaborative Development (Wolverhampton City Campus), by:
  Petronela Lazar, Yousef Bin Madi, Stephen Worrall, Joshua Hipkiss, Daniele Pistilli, Swopnil Sapkota, Jorge Eduardo Dal Santo Caetano.
  Year - 2023


  This file is used for testing checkin.php
  it will ease on the testing and developing of the API to login and register
  User and passwords are arbitrary but version and mode must match to select the right function to run.
  At the moment the only version available is 0.0.0 which will return a default user, hashed password, and message as a json
  While no version results in only a string of message to return(that being the first ever version)
  Option determines wheather to parse those user and password details to a login function or register function
  Login function will check for existing user and then check its password and return a message with login details
  Register will check for existing user and add it to the database in case it's available and return a message with login details 
-->
<?php
echo date("H:i:s") . " kek <br>";
?>

<html>
  <!-- STYLING -->
<style>
input[type=text] {
  border: 1px solid #eee;
  border-radius: 10px;
  font-size: 16px;
  padding: 10px 0px 10px 10px;
  margin: 10px 0px 10px 0px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
  width: 70%;
}

input[type=submit]:hover
{
  background-color: #ffcccc;
  width: 100%;
}

input[type=submit] {
  background-color: #ffaaaa;
  border: none;
  border-radius: 10px;
  color: white;
  cursor: pointer;
  font-size: 16px;
  padding: 10px 0px 10px 10px;
  margin: 10px 0px 10px 0px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
  width: 70%;
}

.button {
  background-color: #ffaaaa;
  border: none;
  border-radius: 10px;
  color: white;
  cursor: pointer;
  font-size: 16px;
  padding: 10px 0px 10px 10px;
  margin: 10px 0px 10px 0px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
  width: 35%;
}


input[type=title] {
  font-size: 20px;
  padding: 10px 0px 10px 10px;
  margin: 10px 0px 10px 0px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
  width: 70%;
}

.center {
  text-align: center;
}


.btn-group button {
  color: white; /* White text */
  padding: 10px 24px; /* Some padding */
  cursor: pointer; /* Pointer/hand icon */
  float: middle; /* Float the buttons side by side */
}

/* Clear floats (clearfix hack) */
.btn-group:after {
  content: "";
  clear: both;
  display: table;
}

.btn-group button:not(:last-child) {
  border-right: none; /* Prevent double borders */
}

/* Add a background color on hover */
.btn-group button:hover {
  background-color: #ffcccc;
  width: 40%;
}

.btnwar-group button:hover {
  background-color: #ff0000;
  width: 40%;
}

</style>
<body>

<!-- $elder_name = $_POST['elder_name'];
    $job = $_POST['job'];
    $date = $_POST['date'];
    $carer_name = $_POST['carer_name'];
    $job_description = $_POST['job_description'];
    $address = $_POST['address']; -->


<!-- FORM FOR POST -->
<br>
<div class="center">
<form method="post" action="https://9e0d-134-220-251-92.eu.ngrok.io/add_job.php">
  <div class="center" style="border-bottom:1px solid #eee;">
    <h2>POST TESTING</h2>
  </div><br>
  <input type="text" placeholder="Elder Name" name="elder_name"><br>
  <input type="text" placeholder="Job" name="job"><br>
  <input type="text" placeholder="Date" name="date"><br>
  <input type="text" placeholder="Carer Name" name="carer_name"><br>
  <input type="text" placeholder="Job Description" name="job_description"><br>
  <input type="text" placeholder="Address" name="address"><br>
  <input type="submit">
</form>

<!-- CLEAR TABLE BUTTON -->
<div class="btn-group btnwar-group">
<button class="button" onclick="clearTable()">Clear table</button>
  </div>
  <p id="deleteoutcome"></p>


  <!-- AUTO TESTING ZONE -->
<div class="center" style="border-bottom:1px solid #eee;">
    <h2 style="padding: 50px 0px 0px 0px">AUTO TESTING</h2>
  </div><br>

  <div class="btn-group">
<button class="button" onclick="autoTest()">Auto Test</button>
<button class="button" id="reset" onclick="resetTest()">Reset user</button>
  </div>


<p id="outcome"></p>


<p id="add job">Register: </p>
<!-- <p id="login test">Login: </p>
<p id="version test">Version: </p>
<p id="mode test">Option: </p> -->
</div>

<script>
// sorry for not documenting this, it's just a quick test to see if the API works
// it will send a forms as a post to add_job.php...
// and will display the json result in the html page

function clearTable() {
  // pop warning message with input for password

  // let password = prompt("Password needed to clear table.")
  let password = "hardcodedpassword"

  if (password) {
    // delete table
    if (fetch("https://9e0d-134-220-251-92.eu.ngrok.io/clear_jobs_table.php",
      {
        method: "POST",
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: "password=" + password
      }
      ).then((response) => response.json())
  .then((data) => {
    document.getElementById("deleteoutcome").innerHTML = data.message;
  })
  .catch((error) => {
    console.error("Error:", error);
  })
  ){
    document.getElementById("deleteoutcome").innerHTML = data.message + "2";
  }

  } else {
    document.getElementById("deleteoutcome").innerHTML = data.message + "3";
  }
}

// example of JSON data tasks with list of tasks
// [["House chores", 0], ["Personal Care", 0], ["Meal Preparation", 0], ["Drinks Preparation", 0], ["Administer Medication", 0], ["Return key to keysafe", 0]]

function resetTest() {
  var task_data = {
          "tasks": [["hehe boi", "0"]],
          "id": "129"
        };

  document.getElementById("outcome").innerHTML = "";
fetch("tasks_state.php", {
  method: "POST",
  headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
    body: JSON.stringify({"id":129, "tasks":[["House chores", 1], ["Personal Care", 1], ["Meal Preparation", 0], ["Drinks Preparation", 0], ["Administer Medication", 0], ["Return key to keysafe", 0]]}),
}
  )
  .then((response) => response.json())
  .then((data) => {
    // document.getElementById("outcome").innerHTML = JSON.parse(data.jobs[0].tasks)[1][0];
    // data.jobs[0].tasks = JSON.parse(data.jobs[0].tasks);
    console.log(data);
    document.getElementById("outcome").innerHTML = JSON.stringify(data);
  })
  .catch((error) => {
    console.error("Error:", error);
  });
}


function autoTest() {

  document.getElementById("register test").innerHTML = "Register: ";
  document.getElementById("login test").innerHTML = "Login: ";
  document.getElementById("version test").innerHTML = "Version: ";
  document.getElementById("mode test").innerHTML = "Option: ";

// check to see if the p is empty
if (document.getElementById("login test").innerHTML == document.getElementById("login test").textContent) {

  let successCount = 0;
  var task_data = {
          "tasks": [task_name, task_state],
          "id": task_id
        };

fetch("tasks_state.php", {
  method: "POST", // or 'PUT'
  headers: {'Content-Type':'application/x-www-form-urlencoded'}, // this line is important, if this content-type is not set it wont work
    body: JSON.parse(task_data)
})
  .then((response) => response.json())
  .then((data) => {
    console.log("Success:", data);
    // document.getElementById("register test").innerHTML = 
    // document.getElementById("register test").textContent + "<br>" + dataRegister + "<br>" + JSON.stringify(data) + "<br>";

  })
  .catch((error) => {
    console.error("Error:", error);
  });

  


  const dataLogin = 
"user=test1&" + 
"password=test1&" +
"version=0.0.0&" + 
"mode=login";

fetch("https://7d75-134-220-250-238.eu.ngrok.io/checkin.php", {
  method: "POST", // or 'PUT'
  headers: {'Content-Type':'application/x-www-form-urlencoded'}, // this line is important, if this content-type is not set it wont work
    body: dataLogin
})
  .then((response) => response.json())
  .then((data) => {
    console.log("Success:", data);
    document.getElementById("login test").innerHTML = 
    document.getElementById("login test").textContent + "<br>" + dataLogin + "<br>" + JSON.stringify(data) + "<br>";
  })
  .catch((error) => {
    console.error("Error:", error);
  });



const dataVersion =
"user=test1&" +
"password=test1&" +
"version=0.0.kek&" +
"mode=login";

fetch("https://7d75-134-220-250-238.eu.ngrok.io/checkin.php", {
  method: "POST", // or 'PUT'
  headers: {'Content-Type':'application/x-www-form-urlencoded'}, // this line is important, if this content-type is not set it wont work
    body: dataVersion
})
  .then((response) => response.json())
  .then((data) => {
    console.log("Success:", data);
    document.getElementById("version test").innerHTML = 
    document.getElementById("version test").textContent + "<br>" + dataVersion + "<br>" + JSON.stringify(data) + "<br>";
  })
  .catch((error) => {
    console.error("Error:", error);
  });


const dataOption =
"user=test1&" +
"password=test1&" +
"version=0.0.0&" +
"mode=wrongOption";

fetch("https://7d75-134-220-250-238.eu.ngrok.io/checkin.php", {
  method: "POST", // or 'PUT'
  headers: {'Content-Type':'application/x-www-form-urlencoded'}, // this line is important, if this content-type is not set it wont work
    body: dataOption
})
  .then((response) => response.json())
  .then((data) => {
    console.log("Success:", data);
    document.getElementById("mode test").innerHTML = 
    document.getElementById("mode test").textContent + "<br>" + dataOption + "<br>" + JSON.stringify(data) + "<br>";
  })
  .catch((error) => {
    console.error("Error:", error);
  });
}

// if (successCount == 4) {
//   document.getElementById("outcome").innerHTML = "All tests passed";
// } else {
//   document.getElementById("outcome").innerHTML = successCount + "/4 tests passed";
// }
}
</script>
</body>
</html>
