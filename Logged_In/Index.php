<?php
    include ('..\Connection.php');
    session_start();
    $sections = $_SESSION['username']."Sections";

    $tablename = $_GET['tablename'];
    $checkinserted = "SHOW TABLES IN `$database` WHERE `Tables_in_$database` = '$tablename'";

    $exists = FALSE;

    $Result = $conn->query($checkinserted);
    //Set variable if table exists
    if($Result !== false) {
        if (!($Result->num_rows > 0)) {
            $exists = TRUE;
        }
    }
    //create the table if it doesn't exist

    $sql = "CREATE TABLE IF NOT EXISTS $tablename (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    task VARCHAR(300) NOT NULL,
    person VARCHAR(30) NOT NULL,
    date DATE NOT NULL,
    priority VARCHAR(30) NOT NULL,
    filename VARCHAR(3000) NOT NULL,
    status VARCHAR(30) NOT NULL
    )";

    $sections = $_SESSION['username']."Sections";
    $sectiontable = "CREATE TABLE IF NOT EXISTS $sections (
    sectionname VARCHAR(30) PRIMARY KEY NOT NULL
    )";

    if ($dbconn->query($sql) === TRUE) {
    } else {
        echo "Error creating table: " . $conn->error;
    }
    if ($dbconn->query($sectiontable) === TRUE) {
    } else {
        echo "Error creating table: " . $conn->error;
    }


    if($exists) {
        $insertinto =  "INSERT INTO `$sections` (`sectionname`) VALUES ('$tablename');";
        if ($dbconn->query($insertinto) === TRUE) {
        } else {
            echo "Error creating table: " . $conn->error;
        }
    }


    echo ' <link rel="stylesheet" type="text/css" href="Style.css">';

    echo '
    <div class="dropdown">
        <a href="#" class="dropbtn">Page Options</a>
        <div class="dropdown-content">';
		    $Query = $dbconn->query("SELECT * FROM $sections" );
		    //Call a function to print all the tack sections
		    while($Fetch = $Query->fetch_array()) {
                $name = str_replace($_SESSION['username'],"", $Fetch['sectionname']);
                echo  '<a  href="Index.php?tablename='. $Fetch['sectionname'].  '">'.$name. '</a>';
		    }
            echo '<a href="NewSection.php">Create Page</a>';
            echo '<a href="DeleteSection.php">Delete Page</a>';
        echo
        '</div> 
       </div>';

        echo '<center>'.str_replace($_SESSION['username'], "", $tablename). '</center>';

    //display task list
    $table_name = $tablename;
    $query = "SELECT * FROM $table_name";
    $result = $dbconn->query($query);

    echo '<div class="task-form">
            <form method="POST" class="form-inline" action="Add.php?tablename='. $table_name. '" enctype="multipart/form-data">
                <input type="text" class="form-control" name="task" placeholder="Task" required/>
                <input type="text" class="form-control" name="person" placeholder="Person:" />
                <input placeholder="Deadline" name="date" class="form-control" type="text" onfocus="(this.type=\'date\')" onblur="(this.type=\'text\')"/>
                <select name="priority" class="form-control">
                    <option disabled selected> Priority:</option>
                    <option>Uitzonderlijk</option>
                    <option>Hoog</option>
                    <option>Middel</option> 
                    <option>Laag</option>	
                </select>
                <input type="file" class="form-control" name="file[]" multiple/>
                <button class="form-control" name="add">Add Task</button>
            </form>
            <br />	
            <table class="task-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Task</th>
                    <th>Person</th>
                    <th>Deadline</th>
                    <th>Priority</th>
                    <th>Files</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';

    $count = 1;
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td class="number">'. $count++ .'</td>';
        echo '<td class="row">'. $row['task']. '</td>';
        echo '<td class="row">'. $row['person']. '</td>';
        echo '<td class="row">'. $row['date']. '</td>';
        echo '<td class="row">'. $row['priority']. '</td>';
        echo '<td class="row">'. $row['filename']. '</td>';
        echo '<td class="row">'. $row['status']. '</td>';
        echo '<td colspan="2" class="action">';
        if($row['status'] != "Done"){
            echo '<a href="MarkAsDone.php?task_id='.$row['id']. '&tablename='. $tablename. '"><img src="..\Images/Mark_as_done_resized.jpg" alt="" height=25px width=25px></a>    ';
        }
        echo '<a href="Delete.php?task_id='.$row['id']. '&tablename='. $table_name. '"><img src="..\Images/Delete_resized.png" alt="" height=27px width=27px></a>';
        echo '<a href="Edit.php?task_id='.$row['id']. '&tablename='. $table_name. '"><img src="..\Images/Edit_resized.png" alt="" height=23px width=23px></a>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>
        </table>
        </div>';

    $conn->close();
    $dbconn->close();
?>


