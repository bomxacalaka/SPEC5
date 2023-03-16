<?php

$host = 'localhost';
$username = 'stephan';
$password = 'changeme69';
$dbname = 'SPEC5';

// {"jobs":[
//     {
//     "visit date":"2023-03-14 23:13:14",
//     "visit duration:"90 mins",
//     "name of client":"John",
//     "name of carer":"Cam",
//     "description":"this job involves....",
//     "tasks":{"clean this":0,
//     "clean that":1},
//     },
//     {
//     "visit date":"2022-03-14 23:13:14",
//     "visit duration:"30 mins",
//     "name of client":"John2",
//     "name of carer":"Cam2",
//     "description":"this job involves2....",
//     "tasks":{"clean this2":0,
//     "clean that":0},
//     }
//     ]}

// Create connection = $conn
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection 
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    echo "Connection Error";
}else{

    // send the query into the sql and grab the result
    // $query = "SELECT * FROM `jobs`";
    $query = "SELECT * FROM jobs";
    $result = $conn->query($query);

    // set up an empty array to hold all rows
    $rows = array();


    if($result->num_rows > 0){
    // iterate through all the row results and att each result into the $rows var
    while($row = $result->fetch_assoc()){
        $rows[] = $row;
    }

        // once iteration has finished. encode and echo the $rows array
        echo json_encode(array("jobs" => $rows));
        
    }else{
        echo "Please try again later for more jobs";
    }

    // // close connection
    mysqli_close($conn);
    $conn = null;
}
?>
