<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

$host = 'localhost';
$username = 'stephan';
$password = 'changeme69';
$dbname = 'SPEC5';

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die(json_encode(array("jobs" => array("message" => "Connection failed: " . mysqli_connect_error()))));
} else {
    $sql = 'SELECT MAX(id) as max_id FROM jobs';
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $id = $row['max_id'] + 1;

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $client_name = mysqli_real_escape_string($conn, $data['client_name']);
    $date = mysqli_real_escape_string($conn, $data['date']);
    $visit_duration = mysqli_real_escape_string($conn, $data['visit_duration']);
    $carer_name = mysqli_real_escape_string($conn, $data['carer_name']);
    $jobDescription = mysqli_real_escape_string($conn, $data['job_description']);
    $tasks = json_encode($data['tasks']);
    $address = mysqli_real_escape_string($conn, $data['address']);

    if (!$date) {
        $date = date('Y-m-d');
    }

    $sql = "INSERT INTO jobs (`id`, `client name`, `date`, `visit_duration`, `carer name`, `job description`, `tasks`, `address`)
            VALUES ('$id', '$client_name', '$date', '$visit_duration', '$carer_name', '$jobDescription', '$tasks', '$address')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("jobs" => array("message" => "Successfully added")));
    } else {
        echo json_encode(array("jobs" => array("message" => "Error adding job")));
    }

    mysqli_close($conn);
}
?>