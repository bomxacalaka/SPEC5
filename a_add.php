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

  <title>SPEC5 - ADD</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="styles.css" />
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
    <header class="d-flex align-items-center pb-3 mb-5 border-bottom fw-bold fs-1">
      <div class="container-fluid text-muted ">
    </header>

    <form id="dataForm">
      <label for="clientName">Client Name:</label>
      <input type="text" class="form-control" id="clientName" name="client_name" required><br>

      <label for="date">Date:</label>
      <input type="date" class="form-control" id="date" name="date" required><br>

      <label for="visitDuration">Visit Duration:</label>
      <input type="text" class="form-control" id="visitDuration" name="visit_duration" required><br>

      <label for="carerName">Carer Name:</label>
      <input type="text" class="form-control" id="carerName" name="carer_name" required><br>

      <label for="jobDescription">Job Description:</label>
      <input type="text" class="form-control" id="jobDescription" name="job_description" required><br>
      <label for="address">Address:</label>
      <input type="text" class="form-control" id="address" name="address" required><br>

      <label>Tasks:</label>
      <ul id="tasksList"></ul>
      <input type="text" class="form-control" id="taskInput" name="tasks">
      <button type="button" class="btn btn-primary w-50 mx-auto d-block mt-4" id="addTaskBtn">Add Task</button><br>



      <button class="btn btn-dark w-50 mx-auto d-block mt-4" type="submit">Submit</button>
    </form>
    <div id="successMessage" style="display: none;">
      <p>Job successfully submitted!</p>
    </div>


    <script>
      let tasks = [];

      document.getElementById('addTaskBtn').addEventListener('click', function () {
        const taskInput = document.getElementById('taskInput');
        const taskText = taskInput.value.trim();

        if (taskText !== '') {
          const tasksList = document.getElementById('tasksList');
          const listItem = document.createElement('li');
          listItem.textContent = taskText;

          const deleteButton = document.createElement('button');
          deleteButton.textContent = 'Delete';
          deleteButton.className = 'btn btn-danger mx-auto ml-3'
          deleteButton.addEventListener('click', function () {
            listItem.remove();

            for (let i = 0; i < tasks.length; i++) {
              if (tasks[i][0] === taskText) {
                tasks.splice(i, 1);
                break;
              }
            }
          });

          listItem.appendChild(deleteButton);
          tasksList.appendChild(listItem);
          taskInput.value = '';

          tasks.push([taskText, false]);
        }
      });

      document.getElementById('dataForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        const data = {};

        for (let [key, value] of formData.entries()) {
          data[key] = value;
        }

        data['tasks'] = tasks;

        console.log(data);

        fetch('add_job.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(data)
        })
          .then(response => {
            if (!response.ok) { // if HTTP status is not OK
              throw new Error('Network response was not ok');
            }
            return response.json();
          })
          .then(responseData => {
            console.log(responseData);
            tasks = [];

            // Redirect to admin.php
            // window.location.href = "admin.php";

            document.getElementById('successMessage').style.display = 'block';
          })
          .catch(error => {
            console.log('There has been a problem with your fetch operation: ', error);
          });
      });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"></script>

</body>

</html>