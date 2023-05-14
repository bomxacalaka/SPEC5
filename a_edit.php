<?php
//if not logged in redirect to login page
if (!isset($_COOKIE["username_Cookie"])) {
  header("location:login.php");
} else {
  $user = "

  ";
  echo $user;
}
$id = $_GET['id'];

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>SPEC5 - EDIT</title>
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
    <!-- <main> -->


    <form id="editForm" class="editroom" action="edit_job.php?id=<?php echo $id; ?>" method="POST">
      <input type="hidden" class="form-control" id="id" name="id">
      <label for="client_name">Client Name:</label><br>
      <input type="text" class="form-control" id="client_name" name="client_name"><br>
      <label for="date">Date:</label><br>
      <input type="text" class="form-control" id="date" name="date"><br>
      <label for="visit_duration">Visit Duration:</label><br>
      <input type="text" class="form-control" id="visit_duration" name="visit_duration"><br>
      <label for="carer_name">Carer Name:</label><br>
      <input type="text" class="form-control" id="carer_name" name="carer_name"><br>
      <label for="job_description">Job Description:</label><br>
      <textarea class="form-control" id="job_description" name="job_description" rows="5"></textarea><br>
      <label for="address">Address:</label><br>
      <input class="form-control" type="text" id="address" name="address"><br>
      <div id="tasksContainer"></div>

      <!-- Add inputs for tasks here -->
      <input type="submit" value="Submit" class="btn btn-dark w-50 mx-auto d-block mt-4">
    </form>
    <div id="successMessage" style="display: none;">
      <p>Job successfully updated!</p>
    </div>



    <script>
      // Fetch the data from job id
      fetch('get_job.php?id=<?php echo $id; ?>')
        .then(response => response.json())
        .then(data => {
          // Populate the form with the data
          document.getElementById('id').value = data.jobs.id;
          document.getElementById('client_name').value = data.jobs['client name'];
          document.getElementById('date').value = data.jobs.date;
          document.getElementById('visit_duration').value = data.jobs.visit_duration;
          document.getElementById('carer_name').value = data.jobs['carer name'];
          document.getElementById('job_description').value = data.jobs['job description'];
          document.getElementById('address').value = data.jobs.address;

          // Parse the tasks
          const tasks = JSON.parse(data.jobs.tasks);

          // Get the tasks container
          const tasksContainer = document.getElementById('tasksContainer');

          // Clear the tasks container
          tasksContainer.innerHTML = '';

          // Generate inputs for each task
          tasks.forEach((task, index) => {
            // Create a new div to wrap each task
            const taskDiv = document.createElement('div');
            taskDiv.className = 'task';

            const taskLabel = document.createElement('label');
            taskLabel.textContent = `Task ${index + 1}:`;

            const taskInput = document.createElement('input');
            taskInput.type = 'text';
            taskInput.name = `task_${index}_name`;
            taskInput.value = task[0];
            taskInput.className = 'form-control';

            const taskCheckbox = document.createElement('input');
            taskCheckbox.type = 'checkbox';
            taskCheckbox.name = `task_${index}_completed`;
            taskCheckbox.checked = task[1];

            // Append the label and inputs to the task div
            taskDiv.appendChild(taskLabel);
            taskDiv.appendChild(taskInput);
            // taskDiv.appendChild(taskCheckbox);  // Uncomment this line if you want the checkbox

            // Append the task div to the tasks container
            tasksContainer.appendChild(taskDiv);
          });
        });

      // Handle form submission
      document.getElementById('editForm').addEventListener('submit', function (event) {
        // Prevent default form submission
        event.preventDefault();

        // Perform your AJAX request here, e.g.:
        fetch('edit_job.php?id=<?php echo $id; ?>', {
          method: 'POST',
          body: new FormData(this) // this refers to the form
        })
          .then(response => response.text())
          .then(data => {
            // Display success message
            // alert(data);
            document.getElementById('successMessage').style.display = 'block';
          })
          .catch(error => {
            // Display error message
            alert('An error occurred: ' + error);
          });
      });
    </script>




    <!-- form -->
    <!-- <form action="/action_page.php" class="form_add m-2 p-2 rounded "> 
    <legend class="" >Edit the job</legend>
    <input type="hidden" class="form-control" id="id" value="<?= $v_id; ?>">
  <div class="form-group">
    <label for="date">Date:</label>
    <input type="datetime" class="form-control" id="date" value="<?= $v_datetime; ?>">
  </div>
  <div class="form-group">
    <label for="duration">Duration (minutes):</label>
    <input type="text" class="form-control" id="duration" value="<?= $v_duration; ?>">
  </div>

  <div class="form-group">
    <label for="cl_name">Client name:</label>
    <input type="text" class="form-control" id="cl_name" value="<?= $v_clname; ?>">
  </div>
  <div class="form-group">
    <label for="cl_address">Client address:</label>
    <input type="text" class="form-control" id="cl_address" value="<?= $v_claddress; ?>">
  </div>

  <div class="form-group">
    <label for="ca_name">Carer name:</label>
    <input type="text" class="form-control" id="ca_name" value="<?= $v_caname; ?>">
  </div>

  <div class="form-group">
    <label for="description">Description:</label>
    <textarea class="form-control" aria-label="With textarea" id="description" ><?= $v_descripton; ?></textarea>
  </div>
  <div class="form-group">
    <label for="task_1">Task:</label>
    <input type="text" class="form-control" id="task_1" value="<?= $v_task; ?>">
  </div>
 

  <button type="submit" class="btn_green btn_green2 rounded">Update job</button>

</form>

  
  </main>
  </div> -->



    <!-- <script>
    window.addEventListener("load", () => {
  function sendData() {
    const XHR = new XMLHttpRequest();

    // Bind the FormData object and the form element
    const FD = new FormData(form);

    // Define what happens on successful data submission
    XHR.addEventListener("load", (event) => {
      alert(event.target.responseText);
    });

    // Define what happens in case of error
    XHR.addEventListener("error", (event) => {
      alert('Oops! Something went wrong.');
    });

    // Set up our request
    XHR.open("POST", "get.php");

    // The data sent is what the user provided in the form
    XHR.send(FD);
  }

  // Get the form element
  const form = document.getElementById("form_add");

  // Add 'submit' event handler
  form.addEventListener("submit", (event) => {
    event.preventDefault();

    sendData();
  });
});

    </script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"></script>

</body>

</html>