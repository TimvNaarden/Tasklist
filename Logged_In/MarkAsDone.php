<?php
    include('../Connection.php');
    if (isset($_GET['task_id'])) {
        $mark_id = $_GET['task_id'];
        $tablename = $_GET['tablename'];
        $sql = "UPDATE $tablename SET status='Done' WHERE id=$mark_id";
        if ($dbconn->query($sql) === TRUE) {
        } else {
            echo "Error marking task as done: " . $dbconn->error;
        }
    }
    header('location:index.php?tablename='.$_GET['tablename']);
?>

