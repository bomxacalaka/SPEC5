<?php

$host = 'localhost';
$username = 'stephan';
$password = 'changeme69';
$dbname = 'jobs';

// 

// Create connection = $conn
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection 
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    echo "Connection Error";
}else{

    // send the query into the sql and grab the result
    $query = "SELECT * FROM `jobs`";
    $result = $conn->query($query);

    // set up an empty array to hold all rows
    $rows = array();

    // iterate through all the row results and att each result into the $rows var
    if($results->rowcount() > 0){
        
        while($row = $result->fetch()){
            $rows[] = $row;
        }

        // once iteration has finished. encode and echo the $rows array
        $json = json_encode($rows);
        echo $json;
    }else{
        echo "Please try again later for more jobs";
    }

    // // close connection
    mysqli_close($conn);
    $conn = null;
}
?>
