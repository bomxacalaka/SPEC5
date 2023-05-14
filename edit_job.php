<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$host = 'localhost';
$username = 'stephan';
$password = 'changeme69';
$dbname = 'SPEC5';

// Create connection = $conn
$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {

    // Get all values sent from the form
    $id = $_POST['id'];
    $clientName = $_POST['client_name'];
    $date = $_POST['date'];
    $visitDuration = $_POST['visit_duration'];
    $carerName = $_POST['carer_name'];
    $jobDescription = $_POST['job_description'];
    $address = $_POST['address'];

    // Construct tasks array
    $tasks = [];
    for ($i = 0; isset($_POST["task_${i}_name"]); $i++) {
        $taskName = $_POST["task_${i}_name"];
        $taskCompleted = isset($_POST["task_${i}_completed"]) ? $_POST["task_${i}_completed"] === 'on' : false;
        $tasks[] = [$taskName, $taskCompleted];
    }
    // Convert tasks to JSON string
    $tasksJson = json_encode($tasks);

    // Sanitize inputs
    $id = mysqli_real_escape_string($conn, $id);
    $clientName = mysqli_real_escape_string($conn, $clientName);
    $date = mysqli_real_escape_string($conn, $date);
    $visitDuration = mysqli_real_escape_string($conn, $visitDuration);
    $carerName = mysqli_real_escape_string($conn, $carerName);
    $jobDescription = mysqli_real_escape_string($conn, $jobDescription);
    $tasksJson = mysqli_real_escape_string($conn, $tasksJson);
    $address = mysqli_real_escape_string($conn, $address);

    // Construct the SQL query
    $sql = "UPDATE jobs SET `client name` = '$clientName', `date` = '$date', `visit_duration` = '$visitDuration', `carer name` = '$carerName', `job description` = '$jobDescription', `tasks` = '$tasksJson', `address` = '$address' WHERE `id` = $id";


    // Execute the query and get the result
    if (mysqli_query($conn, $sql)) {
        echo "Successfully updated";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}