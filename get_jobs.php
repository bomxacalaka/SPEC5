<?php

$host = 'localhost';
$username = 'stephan';
$password = 'changeme69';
$dbname = 'SPEC5';

try {
    // Create connection = $conn
    $conn = mysqli_connect($host, $username, $password, $dbname);

    // Check connection 
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        echo "Connection Error";
    } else {
        // send the query into the sql and grab the result
        $query = "SELECT * FROM jobs";
        $result = $conn->query($query);

        // set up an empty array to hold all rows
        $rows = array();

        // iterate through all the row results and add each result into the $rows var
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        // encode and echo the $rows array
        $json = json_encode(array("jobs" => $rows));
        echo $json;
    }

    // close connection
    mysqli_close($conn);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>