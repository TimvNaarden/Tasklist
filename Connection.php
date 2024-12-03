<?php
    $server = "localhost";
    $user = "Tim";
    $pass = "Welkom123@!@!";
    $database = "Computers";
    // Create connection
    $conn = new mysqli($server, $user, $pass);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create database if not exists
    $Sql = "CREATE DATABASE IF NOT EXISTS Computers";
    if ($conn->query($Sql) === TRUE) {
    } else {
        echo "Error creating database: " . $conn->error;
    }
    // Create connection
    $dbconn = new mysqli($server, $user, $pass, $database);

    // Check connection
    if ($dbconn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if there is a usertable
    $sql = "SHOW TABLES IN `$database` WHERE `Tables_in_Computers` = 'Users'";
    $alter = FALSE;
    $result = $conn->query($sql);
    if ($result !== false) {
        if (!($result->num_rows > 0)) {
            $alter = TRUE;
        }
    }

    // SQL to create table
    $sql = "CREATE TABLE IF NOT EXISTS Users (
                    `id` int(11) NOT NULL,
                    `username` varchar(255) NOT NULL,
                    `password` varchar(255) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    // SQL to modify user table
    $sql2 = "ALTER TABLE Users ADD PRIMARY KEY (`id`);";
    $sql3 = "ALTER TABLE Users MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;";

    // Create user table if not exists
    if (!($dbconn->query($sql) === TRUE)) {
        echo "Error creating table: " . $dbconn->error;
    }

    // Alter usertable if table didn't exist
    if ($alter === TRUE) {
        if (!($dbconn->query($sql2) === TRUE)) {
            echo "Error creating table: " . $dbconn->error;
        }
        if (!($dbconn->query($sql3) === TRUE)) {
            echo "Error creating table: " . $dbconn->error;
        }
    }

    // Reset all variables
    $alter = false;
?>

