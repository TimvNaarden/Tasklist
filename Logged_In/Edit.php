<?php
include ('..\Connection.php');



$task_id = $_GET['task_id'];
$table_name = $_GET['tablename'];
$query = "SELECT * FROM $table_name WHERE id = $task_id";
$result = $dbconn->query($query);
$task = $result->fetch_assoc();
if (isset($_GET['task_id'])) {
    $id = $_GET['task_id'];
    $tablename = $_GET['tablename'];
    $sql = "DELETE FROM $tablename WHERE id=$id";
    if ($dbconn->query($sql) === TRUE) {
    } else {
        echo "Error deleting task: " . $dbconn->error;
    }
}
echo ' <link rel="stylesheet" type="text/css" href="Style.css">';
echo '<div class="task-form">
            <form method="POST" class="form-inline" action="Add.php?tablename='. $table_name. '" enctype="multipart/form-data">
                <input type="text" class="form-control" name="task" value="'. $task['task']. '" required/>
                <input type="text" class="form-control" name="person" value="'. $task['person']. '" />
                <input value="'. $task['date']. '" name="date" class="form-control" type="text" onfocus="(this.type=\'date\')" onblur="(this.type=\'text\')"/>
                <select name="priority" class="form-control">
                    <option value="'. $task['priority']. '">'. $task['priority']. '</option>
                    <option>Uitzonderlijk</option>
                    <option>Hoog</option>
                    <option>Middel</option> 
                    <option>Laag</option>	
                </select>
                <input type="file" class="form-control" name="file[]" multiple/>
                <button class="form-control" name="add">Add Task</button>
            </form>';

$conn->close();
$dbconn->close();
?>