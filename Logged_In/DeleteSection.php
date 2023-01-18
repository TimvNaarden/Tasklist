<?php
    include ('..\Connection.php');
    session_start();
    if(isset($_POST['delete'])) {
        $sections = $_SESSION['username']."sections";
        //Get the tablename from the form
        $tablename = $_POST['pageName'];
        //SQL query to drop the table
        $sql = "DROP TABLE $tablename";
        //If the table is dropped successfully, delete the corresponding row from the sections table
        echo $sections;
        if ($dbconn->query($sql) === TRUE) {
            echo $sql;
            $query = "DELETE FROM $sections WHERE `$sections`.`sectionname` = '$tablename'";
            echo $query;
            if ($dbconn->query($query)) {
                header("Location: ../logged_in/Index.php?tablename=". $_SESSION['username'] . "main");
            }
        }

        $dbconn->close();
    } else {

    }


?>
<link rel="stylesheet" type="text/css" href="Style.css">
<div class="task-form">
    <form  class="form-inline"method="POST" action="DeleteSection.php">
        <label>Page to Delete:</label>
        <select class="form-control" name="pageName" required>
            <option disabled selected>Select Page</option>
            <?php
            $sections = $_SESSION['username'] . "Sections";
            $Query = $dbconn->query("SELECT * FROM $sections");
            while ($Fetch = $Query->fetch_array()) {
                $name = str_replace($_SESSION['username'], "", $Fetch['sectionname']);
                echo '<option>' . $Fetch['sectionname'] . '</option>';
            }
            ?>
        </select>
        <button type="submit" name="delete">Delete</button>
    </form>
</div>



