<?php
//if not logged in redirect to login page
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

  <title>SPEC5 - HOME</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="styles.css" />
  <!-- <link rel="icon" href="images/soap_trap.jpeg" /> -->
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
  <div class="col-lg-10 mx-auto p-3 py-md-5 main_frame">
    <header class="d-flex align-items-center pb-3 mb-5 border-bottom text-muted fw-bold fs-2">

    </header>
    <main>

    </main>
  </div>

  <style>

  </style>

  <script>

    // Force page refresh when navigating back to the page
    window.onpageshow = function (event) {
      if (event.persisted) {
        window.location.reload();
      }
    };

    // {"jobs":[{"id":"128","elder name":"","job":"","date":"2023-03-13","carer name":"","job description":"","address":""},{"id":"129","elder name":"testing69","job":"","date":"2023-02-13","carer name":"josh","job description":"idkman","address":"omsehwre"},{"id":"130","elder name":"testing69","job":"","date":"2023-02-13","carer name":"josh","job description":"idkman","address":"omsehwre"},{"id":"131","elder name":"testing69","job":"","date":"2023-02-13","carer name":"","job description":"idkman","address":"omsehwre"},{"id":"132","elder name":"fasfdasgregqw","job":"","date":"2023-02-13","carer name":"fdsafdas","job description":"idkman","address":"omsehwre"},{"id":"133","elder name":"fasfdasgregqw","job":"","date":"2023-02-13","carer name":"fdsafdas","job description":"idkman","address":"omsehwre"},{"id":"134","elder name":"","job":"","date":"2023-03-16","carer name":"","job description":"","address":""},{"id":"135","elder name":"","job":"","date":"2023-03-16","carer name":"","job description":"","address":""},{"id":"136","elder name":"","job":"","date":"2023-03-16","carer name":"","job description":"","address":""},{"id":"137","elder name":"","job":"","date":"2023-03-16","carer name":"","job description":"","address":""}]}
    fetch("get_jobs.php").then((response) => response.json()).then((response) => {

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


        tasks = JSON.parse(response.jobs[i].tasks);
        let job_status = "Not Completed";
        let background = "#ff0000";

        if (tasks == null) {
          tasks = [];
          job_status = "No data";
          background = "#aaaaaa"
        } else {

          let job_size = tasks.length;
          let task_completed = 0;

          for (let j = 0; j < tasks.length; j++) {
            if (tasks[j][1] == true) {
              task_completed++;
            }
          }

          if (task_completed == job_size) {
            job_status = "Completed";
            background = "#00ff00";
          }
        }

        const job_complete = document.createElement("p");
        job_complete.className = "rounded";
        job_complete.idName = "completo";
        job_complete.style = "background-color: " + background;
        job_header.appendChild(job_complete);
        const complete = document.createTextNode(job_status);
        job_complete.appendChild(complete);


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

        // const timer = document.createElement("button");
        // timer.className = "btn btn-dark";
        // timer.id = "timeButton";
        // const timerBtn = document.createTextNode("Start Timer");
        // timer.addEventListener('click', function () {
        //   timerBtn.nodeValue = "Stop Timer";
        // });
        // timer.appendChild(timerBtn);
        // job_body.appendChild(timer);

        const button = document.createElement("a");
        button.className = "btn btn-dark";
        button.href = "detail.php?id=" + response.jobs[i]["id"];
        const infoBtn = document.createTextNode("Info");
        button.appendChild(infoBtn);
        job_body.appendChild(button);

        let main = document.querySelector("main");
        main.appendChild(job_card);
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

<style>

</style>

</html>