<?php

// this code takes in POST data from the html / javascript code and
// executes the deletion of a single row. this rows id number has to match the number
// recieved from POST

// my SQL credentials
$host = 'localhost';
$username = 'stephan';
$password = 'changeme69';
$dbname = 'SPEC5';

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection 
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    echo "Connection Error";
} else {
    // recieve the ID number from a POST message
    $id = $_GET['id'];


    //  construct the query and execute the deletion by id number recieved from POST
    $query = "DELETE FROM jobs WHERE id = $id";
    $result = $conn->query($query);
   
    // Check for errors
    if (!$result) {
        die("Query failed: " . $conn->error);
    }else{

        echo "Successfully deleted";
        header('Location: /admin.php');
    }

    // Close connection
    mysqli_close($conn);
    $conn = null;
}


?>