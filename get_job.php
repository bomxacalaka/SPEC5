<?php

$host = 'localhost';
$username = 'stephan';
$password = 'changeme69';
$dbname = 'SPEC5';


//     {
//     "visit date":"2023-03-14 23:13:14",
//     "visit duration:"90 mins",
//     "name of client":"John",
//     "name of carer":"Cam",
//     "description":"this job involves....",
//     "tasks":{"clean this":0,
//     "clean that":1},
//     }

$job_id = $_GET['id'];

// Create connection = $conn
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection 
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    echo "Connection Error";
}else{

    // send the query into the sql and grab the result
    // $query = "SELECT * FROM `jobs`";
    $query = "SELECT * FROM jobs WHERE id = $job_id";
    
    // get the result of the query and return it as an array
    $result = $conn->query($query)->fetch_assoc();    

    // once iteration has finished. encode and echo the $rows array
    echo json_encode(array("jobs" => $result));
        

    // // close connection
    mysqli_close($conn);
    $conn = null;
}
?>