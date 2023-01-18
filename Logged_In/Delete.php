<?php
    include("../Connection.php");
    // DELETE task
    if (isset($_GET['task_id'])) {
        $id = $_GET['task_id'];
        $tablename = $_GET['tablename'];
        $sql = "DELETE FROM $tablename WHERE id=$id";
        if ($dbconn->query($sql) === TRUE) {
        } else {
            echo "Error deleting task: " . $dbconn->error;
        }
    }
    header('location:index.php?tablename='.$_GET['tablename']);
?>