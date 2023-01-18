<?php
    include ('Connection.php');
    $conn->close();
    $dbconn->close();
    header("Location: log_in/index.php");
?>
