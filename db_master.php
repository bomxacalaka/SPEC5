<?php

$host = 'localhost';
$username = 'stephan';
$password = 'changeme69';
$dbname = 'SPEC5';


// command
$q = $_GET['q'];

// Create connection = $conn
$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    echo "Connection Error";
}

// if q equals add_table then add table to database
if ($q === "add_table"){
$sql = "CREATE TABLE IF NOT EXISTS jobs2 (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `elder name` VARCHAR(30) NOT NULL,
    job VARCHAR(30) NOT NULL,
    date VARCHAR(30) NOT NULL,
    jobDescription VARCHAR(30) NOT NULL,
    `carer name` VARCHAR(30) NOT NULL,
    address VARCHAR(30) NOT NULL,
    tasks VARCHAR(30) NOT NULL
    )";
} elseif ($q === "add_row") {
    $sql = "INSERT INTO jobs (id, `elder name`, job, date, jobDescription, `carer name`, address, tasks)
    VALUES ('1', 'John', 'Clean', '2021-01-01', 'Clean the house', 'Stephan', '123 Fake Street', 'Clean the house')";
} elseif ($q === "delete_table") {
    $sql = "DROP TABLE jobs";
} elseif ($q === "delete_row") {
    $sql = "DELETE FROM jobs WHERE id=1";
} elseif ($q === "update_row") {
    $sql = "UPDATE jobs SET `elder name`='John' WHERE id=1";
} elseif ($q === "select_row") {
    $sql = "SELECT * FROM jobs WHERE id=1";
} else {
    echo "<h1>Database Master</h1><br><p>Use the following commands to interact with the database</p><br><p>add_table</p><p>add_row</p><p>delete_table</p><p>delete_row</p><p>update_row</p><p>select_row</p>";
}


// Execute the query and get the result
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

?>


