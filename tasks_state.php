<?php

// This will get all the tasks and their state and save it to the database
// so ["House chores", 0] will be saved as "House chores,0" in the database

// Get the application/json data from the POST request
$data = json_decode(file_get_contents('php://input'), true);

// echo the id and the tasks
$id = $data['job_id'];
$tasks = $data['tasks']; // this only contains the tasks that have been changed eg. ["House chores", 1]
$task_number = $data['task_number'];


$host = 'localhost';
$username = 'stephan';
$password = 'changeme69';
$dbname = 'SPEC5';

// $id = 131;
// $tasks = [["House chores", 1], ["Personal Care", 0], ["Meal Preparation", 0], ["Drinks Preparation", 0], ["Administer Medication", 0], ["Return key to keysafe", 0]];

// echo "id: " . $id;
// echo $tasks[0];
// echo $tasks[1];
// echo json_encode($tasks);

// Create connection = $conn
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection 
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    echo json_encode(array("jobs" => array("message" => "Connection Error")));
} else {
    // $id = mysqli_real_escape_string($conn, $_POST['id']);
    // $id = filter_var($id, FILTER_SANITIZE_STRING);

    // Get the job by id
    $sql = "SELECT * FROM jobs WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);


    // echo json_encode(json_decode($row['tasks']));
    // echo json_encode(json_decode($row['tasks'])[$task_number]);

    // replace the tasks that have been changed but keep the rest of the tasks
    $row = json_decode($row['tasks'], true);
    $row[$task_number] = $tasks;

    // echo json_encode($row);

    // echo json_encode($row);

    // save the new tasks to the database but keep the rest of the tasks
    $sql = "UPDATE jobs SET tasks = '" . json_encode($row) . "' WHERE id = $id";

    // check queery has been completed
    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("jobs" => array("message" => "Record updated successfully")));
    } else {
        echo json_encode(array("jobs" => array("message" => "Error: " . $sql . "<br>" . mysqli_error($conn))));
    }
}