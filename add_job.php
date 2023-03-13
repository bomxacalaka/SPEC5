<?php

$host = '0.tcp.eu.ngrok.io';
$username = 'stephan';
$password = 'changeme69';
$dbname = 'Person';

// Create connection = $conn
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection 
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    echo "Connection Error";
} else{
    echo "Connection Successful";
}

// Prepare the SQL statement to retrieve the maximum ID number and increment it by 1
$sql = 'SELECT MAX(id) as max_id FROM Person'; 
$stmt = $pdo->prepare($sql); 
$stmt->execute();
$result = $stmt->fetch(); 
$id = $result['max_id'] + 1; 
echo "id = $id";

// grab values from the HTML
$nameElder = mysqli_real_escape_string($conn, $_POST['elder_name']);
$job = mysqli_real_escape_string($conn, $_POST['job_name']);
$date = mysqli_real_escape_string($conn, $_POST['date_']);
$jobDescription = mysqli_real_escape_string($conn, $_POST['job_description']);
$address = mysqli_real_escape_string($conn, $POST['']);

// Validate All Data
if(!$date){
    $date = date('Y-m-d');
    echo "Using todays date";
}

// sanitise data
$address = filter_var($address, FILTER_SANITIZE_STRING);
$nameElder = filter_var($nameElder, FILTER_SANITIZE_STRING);
$job = filter_var($job, FILTER_SANITIZE_STRING);
$date = filter_var($date, FILTER_SANITIZE_STRING);
$jobDescription = filter_var($jobDescription, FILTER_SANITIZE_STRING);
$address = filter_var($address, FILTER_SANITIZE_STRING);


// insert data into SQL table
$sql = "INSERT INTO Person (`id`, `elder name`, `job`, `date`, `job description`, `address`) 
    VALUES ('$id', '$nameElder', '$job', '$date', '$jobDescription', '$address')";

// check queery has been completed
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close connection
mysqli_close($conn);

?>