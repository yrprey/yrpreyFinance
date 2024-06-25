<?php

$conn = mysqli_connect('localhost', 'root', '', 'yrpreyfinance');

/* Check connection before executing the SQL query */
if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();
}

?>