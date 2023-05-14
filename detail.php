<?php
// {"jobs":{"id":"128","client name":"Adam Hughes","date":"2023-03-13 07:00:00","visit_duration":"30min","carer name":"Jane Smith","job description":"Personal Care - assist the client with a full body wash in bed, as she doesn't have lower body mobility\r\nNutrition and Fluids - meals and drinks preparation as the client is bed bound\r\nAdminister Medication - administer medication as per the discharge letter\r\n\r\nAdditional Information:\r\nKeysafe number: 1234\r\nEmergency Contact number: 0123 456 7890\r\n","tasks":"[[\"House chores\", 0], [\"Personal Care\", 0], [\"Meal Preparation\", 0], [\"Drinks Preparation\", 0], [\"Administer Medication\", 0], [\"Return key to keysafe\", 0]]","address":"123 Holy Street\r\nWolverhampton\r\nWV14 2GN"}}
$id = $_GET['id'];

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

  <title>SPEC5 - INFO</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="styles.css" />
  <link rel="icon" href="images/soap_trap.jpeg" />
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
  <div class="container-big">
    <div class="details-container">
      <header class="d-flex align-items-center pb-3 mb-5 border-bottom fw-bold fs-2">
        <div class="container-fluid text-muted ">
          Info
          <span class="fs-4" id="date_time">- date time</span>
          <!-- <a id="completo"  class="rounded" >Not completed</a> -->
          <p id="status" class="status">Status</p>
        </div>
      </header>

      <main>
        <h1> <span id="cl_name" class="fs-5">name</span></h1>
        <p class="fs-5 col-md-8"><span id="description"> Description.</span></p>


        <div class="col-md-6">
          <!-- <h2 class="fs-5" >To do      -->

          </h2>
          <p class="fs-5">Task needed to be done</p>
          <ul id="tasks" class="icon-list fs-5">
          </ul>
        </div>

        <hr class="col-3 col-md-2 mb-5">
      </main>
    </div>
  </div>
  <iframe
    src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d720.8382986204622!2d-2.1250182646354143!3d52.57681988434165!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2snl!4v1684027639958!5m2!1sen!2snl"
    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
    referrerpolicy="no-referrer-when-downgrade"></iframe>
  <script>
    fetch('get_job.php?id=<?php echo $id; ?>')
      .then(response => response.json())
      .then(response => {
        console.log(response);
        document.getElementById("cl_name").innerHTML = response.jobs["client name"];
        document.getElementById("description").innerHTML = response.jobs["job description"];
        document.getElementById("date_time").innerHTML = response.jobs["date"];

        var tasks = JSON.parse(response.jobs["tasks"]);

        // send the tasks state to the database from a chekbox list (all the tasks are sent to the database even if they are not changed)
        var tasks_list = document.getElementById("tasks");

        // console.log(tasks[0][0]);

        // [["House chores", false], ["Personal Care", false], ["Meal Preparation", false], ["Drinks Preparation", false], ["Administer Medication", false], ["Return key to keysafe", false]]

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

        // document.getElementById("status").innerHTML = job_status;
        // document.getElementById("status").style.backgroundColor = "background-color: "+  background;

        document.getElementById("status").innerHTML = job_status;
        document.getElementById("status").style.backgroundColor = "background-color: " + background;

        for (var i = 0; i < tasks.length; i++) {
          var task = tasks[i];
          var task_name = task[0];
          var task_state = task[1];
          var task_li = document.createElement("li");
          var task_checkbox = document.createElement("input");
          task_checkbox.type = "checkbox";
          task_checkbox.value = task_name;
          task_checkbox.id = i;
          task_checkbox.checked = task_state;
          task_checkbox.addEventListener("change", function () {
            // console.log(this.value);
            var task_name = this.value;
            var task_state = this.checked;
            var task_id = response.jobs["id"];
            // console.log("task name is " + task_name);
            // console.log("task state is " + task_state);
            // console.log("task id is " + task_id);
            var task_data = {
              "tasks": [task_name, task_state],
              "job_id": response.jobs["id"],
              "task_number": this.id
            };
            console.log(task_data);
            fetch('tasks_state.php', {
              headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
              },
              method: 'POST',
              body: JSON.stringify(task_data)
            })
              .then(response => response.json())
              .then(response => {
                console.log("updated task state " + task_name + " to " + task_state);
                console.log(response.jobs.message);
              })
              .catch(err => {
                // Display errors in console
                console.log("testing wrong");
                console.log(err);
              });
            // check if all the tasks are completed and if so change element with id "completo" to "Completed"
            var tasks = document.getElementById("tasks");
            var tasks_list = tasks.getElementsByTagName("li");
            var completed = true;
            for (var i = 0; i < tasks_list.length; i++) {
              var task = tasks_list[i];
              var task_checkbox = task.getElementsByTagName("input")[0];
              if (task_checkbox.checked == false) {
                completed = false;
              }
            }
            if (completed == true) {
              // add a button to mark the job as completed
              // var completo = document.getElementById("completo");

              job_status = "Completed";
              background = "#00ff00";
              document.getElementById("status").innerHTML = job_status;
              document.getElementById("status").style.backgroundColor = "background-color: " + background;
              completo.innerHTML = "Completed";
              // completo.href = "completed.php?id=" + task_id;
              completo.style = "background-color: rgb(145, 255, 101);";

            }
            else {
              // remove the button to mark the job as completed
              // var completo = document.getElementById("completo");
              // completo.innerHTML = "Not completed";
              // completo.style = "background-color: #FF4500;";
              job_status = "Not Completed";
              background = "#ff0000";
              document.getElementById("status").innerHTML = job_status;
              document.getElementById("status").style.backgroundColor = "background-color: " + background;
              completo.innerHTML = "Completed";
            }
          });
          var task_label = document.createElement("label");
          task_label.htmlFor = task_name;
          task_label.appendChild(document.createTextNode(task_name));
          task_li.appendChild(task_checkbox);
          task_li.appendChild(task_label);
          tasks_list.appendChild(task_li);
        }
      }
      )
      .catch(err => {
        // Display errors in console
        console.log(err);
      });

  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

</html>