<?php
// Check if the password form is submitted
if (isset($_POST['password'])) {
  $password = $_POST['password'];
  // Hardcoded password (change this to your desired password)
  $expectedPassword = '123';

  if ($password === $expectedPassword) {
    // Password is correct, set a cookie to indicate successful login
    setcookie("admin_logged_in", true, time() + 3600); // Set the cookie for 1 hour
  } else {
    echo "Invalid password. Please try again.";
  }
}

// Check if the user is already logged in
if (!isset($_COOKIE["admin_logged_in"])) {
  // User is not logged in, show the password form
  echo "
  <style>
      @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
      
      .center-div {
          display: flex;
          justify-content: center;
          align-items: center;
          height: 100vh;
      }

      .center-div form {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
    }

    .custom-input {
        display: block;
        width: 100%;
        height: calc(1.5em + .75rem + 2px);
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }

    .custom-input:focus {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 .2rem rgba(0,123,255,.25);
    }
      .center-div form label,
      .center-div form input,
      .center-div form button {
      margin: 10px 0; 
      font-family: 'Roboto', sans-serif;

      }
      .center-div form button {
        background-color: #fff;
        border: 1px solid #d5d9d9;
        border-radius: 8px;
        box-shadow: rgba(213, 217, 217, .5) 0 2px 5px 0;
        box-sizing: border-box;
        color: #0f1111;
        cursor: pointer;
        display: inline-block;
        font-family: 'Roboto', sans-serif;
        font-size: 13px;
        line-height: 29px;
        padding: 0 10px 0 11px;
        position: relative;
        text-align: center;
        text-decoration: none;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
        vertical-align: middle;
        width: 100px;
        }
        .center-div form button:hover {
          background-color: #f7fafa;

        }
        .center-div form button:focus {
          border-color: #008296;
          box-shadow: rgba(213, 217, 217, .5) 0 2px 5px 0;
          outline: 0;
        }
  </style>
  <div class='center-div'>
      <form method='POST'>
          <label for='password'>Enter the password:</label>
          <input class='custom-input' type='password' name='password' id='password'>
          <button class= 'btn btn-dark' type='submit'>Submit</button>
      </form>
  </div>
  ";
  exit(); // Stop executing the rest of the code
}

// User is logged in, continue executing the rest of the code

if (!isset($_COOKIE["username_Cookie"])) {
  header("location:login.php");
} else {
  $user = "

    ";
  echo $user;
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>SPEC5 - ADMIN</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="styles.css" />
  <link rel="icon" href="https://9e0d-134-220-251-92.eu.ngrok.io/images/soap_trap.jpeg" />
  <nav class='navbar'>
    <div class='container-fluid'>
      <div class='logo_container'>
        <a href='admin.php'>
          <img src='https://9e0d-134-220-251-92.eu.ngrok.io/1.jpg' class='logo80' />
        </a>
      </div>
      <div class='logout_container'>
        <a href='logout.php' class='btn btn-outline-light'>
          Logout
        </a>
      </div>
    </div>
  </nav>
</head>

<body>
  <div class="col-lg-10 mx-auto p-3 py-md-5 main_frame ">
    <header class="d-flex align-items-center pb-3 mb-5 border-bottom fw-bold fs-2">
      <div class="jobtn ">

        <a href="./a_add.php" class="btn btn-dark">Add new job</a>
      </div>
      </br>
    </header>
    <main>

    </main>
  </div>


  <script>
    window.onpageshow = function (event) {
      if (event.persisted) {
        window.location.reload();
      }
    };
    //{"jobs":[{"id":"128","client name":"Adam Hughes","date":"2023-03-13 07:00:00","visit_duration":"30min","carer name":"Jane Smith","job description":"Personal Care - assist the client with a full body wash in bed, as she doesn't have lower body mobility\r\nNutrition and Fluids - meals and drinks preparation as the client is bed bound\r\nAdminister Medication - administer medication as per the discharge letter\r\n\r\nAdditional Information:\r\nKeysafe number: 1234\r\nEmergency Contact number: 0123 456 7890\r\n","tasks":"{\"tasks\": [{\"Personal Care\": 0}]}","address":"123 Holy Street\r\nWolverhampton\r\nWV14 2GN"},{"id":"129","client name":"Maria Logan","date":"2023-02-13 07:45:00","visit_duration":"1hour","carer name":"Jane Smith","job description":"Personal Care - assist the client with a full body wash in bed, as she doesn't have lower body mobility\r\nNutrition and Fluids - meals and drinks preparation as the client is bed bound\r\nAdminister Medication - administer medication as per the discharge letter\r\n\r\nAdditional Information:\r\nKeysafe number: 1234\r\nEmergency Contact number: 0123 456 7890","tasks":"null","address":"124 Holy Street\r\nWolverhampton\r\nWV14 2GN"},{"id":"130","client name":"Karen Adam","date":"2023-02-13 07:00:00","visit_duration":"30min","carer name":"Marie Antoinette","job description":"Personal Care - assist the client with a full body wash in bed, as she doesn't have lower body mobility\r\nNutrition and Fluids - meals and drinks preparation as the client is bed bound\r\nAdminister Medication - administer medication as per the discharge letter\r\n\r\nAdditional Information:\r\nKeysafe number: 1234\r\nEmergency Contact number: 0123 456 7890","tasks":"null","address":"130 Holy Street\r\nWolverhampton\r\nWV14 2GN"},{"id":"131","client name":"Adam Hughes","date":"2023-02-13 13:00:00","visit_duration":"30min","carer name":"Marie Antoinette","job description":"Personal Care - assist the client with a full body wash in bed, as she doesn't have lower body mobility\r\nNutrition and Fluids - meals and drinks preparation as the client is bed bound\r\nAdminister Medication - administer medication as per the discharge letter\r\n\r\nAdditional Information:\r\nKeysafe number: 1234\r\nEmergency Contact number: 0123 456 7890\r\n","tasks":"null","address":"123 Holy Street\r\nWolverhampton\r\nWV14 2GN"},{"id":"132","client name":"fasfdasgregqw","date":"2023-02-13 00:00:00","visit_duration":"","carer name":"fdsafdas","job description":"idkman","tasks":"null","address":"omsehwre"},{"id":"133","client name":"fasfdasgregqw","date":"2023-02-13 00:00:00","visit_duration":"","carer name":"fdsafdas","job description":"idkman","tasks":"null","address":"omsehwre"},{"id":"134","client name":"","date":"2023-03-16 00:00:00","visit_duration":"","carer name":"","job description":"","tasks":"null","address":""},{"id":"135","client name":"","date":"2023-03-16 00:00:00","visit_duration":"","carer name":"","job description":"","tasks":"null","address":""},{"id":"136","client name":"","date":"2023-03-16 00:00:00","visit_duration":"","carer name":"","job description":"","tasks":"null","address":""},{"id":"137","client name":"","date":"2023-03-16 00:00:00","visit_duration":"","carer name":"","job description":"","tasks":"null","address":""}]}
    fetch("get_jobs.php").then((response) => response.json()).then((response) => {
      console.log(response);

      for (let i = 0; i < response.jobs.length; i++) {

        const job_card = document.createElement("div");
        job_card.className = "card m-1";

        const job_header = document.createElement("div");
        job_header.className = "card-header";
        job_card.appendChild(job_header);

        const job_time = document.createElement("span");
        job_time.className = "date_time";
        job_header.appendChild(job_time);
        const dateTime = document.createTextNode(response.jobs[i]["date"] + " " + response.jobs[i]["carer name"]);
        job_time.appendChild(dateTime);

        const job_body = document.createElement("div");
        job_body.className = "card-body";
        job_card.appendChild(job_body);

        const job_title = document.createElement("h5");
        job_title.className = "card-title";
        job_body.appendChild(job_title);

        const job_client = document.createElement("span");
        job_client.className = "cl_name";
        job_title.appendChild(job_client);
        const clientName = document.createTextNode(response.jobs[i]["client name"]);
        job_client.appendChild(clientName);

        // add new line
        const br = document.createElement("br");
        job_title.appendChild(br);

        const job_duration = document.createElement("span");
        job_duration.className = "duration";
        job_title.appendChild(job_duration);
        const duration = document.createTextNode(response.jobs[i]["visit_duration"]);
        job_duration.appendChild(duration);

        // for each new line in address add a new line
        for (let j = 0; j < response.jobs[i]["address"].split("\n").length; j++) {
          const job_address = document.createElement("p");
          job_address.className = "card-text";
          job_body.appendChild(job_address);
          const address = document.createTextNode(response.jobs[i]["address"].split("\n")[j]);
          job_address.appendChild(address);
        }
        const buttonWrapper = document.createElement("div");
        buttonWrapper.className = "button-wrapper1";
        job_body.appendChild(buttonWrapper);

        const infobutton = document.createElement("a");
        infobutton.className = "btn btn-dark";
        infobutton.href = "detail.php?id=" + response.jobs[i]["id"];
        const infoBtn = document.createTextNode("Info");
        infobutton.appendChild(infoBtn);
        buttonWrapper.appendChild(infobutton);  // Change this line

        const editbutton = document.createElement("a");
        editbutton.className = "btn btn-info";
        editbutton.href = "a_edit.php?id=" + response.jobs[i]["id"];
        const editBtn = document.createTextNode("Edit");
        editbutton.appendChild(editBtn);
        buttonWrapper.appendChild(editbutton);  // Change this line

        const delbutton = document.createElement("a");
        delbutton.className = "btn btn-danger";
        delbutton.href = "delete_job.php?id=" + response.jobs[i]["id"];
        const delBtn = document.createTextNode("Delete");
        delbutton.appendChild(delBtn);
        buttonWrapper.appendChild(delbutton);
        let main = document.querySelector("main");
        main.appendChild(job_card);

        // add new line
        const br2 = document.createElement("br");
        main.appendChild(br2);

      }
    }).catch((err) => {
      // Display errors in console
      console.log(err);
    });

  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>

</body>

</html>