<?php
    include ('..\Connection.php');
    session_start();
    if (isset($_POST['pageName'])) {
        $tablename = $_SESSION['username'].$_POST['pageName'];
        $sections = $_SESSION['username']."Sections";

        $sql = "CREATE TABLE IF NOT EXISTS $tablename (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        task VARCHAR(300) NOT NULL,
        person VARCHAR(30) NOT NULL,
        date DATE NOT NULL,
        priority VARCHAR(30) NOT NULL,
        filename VARCHAR(3000) NOT NULL,
        status VARCHAR(30) NOT NULL
        )";
    if ($dbconn->query($sql) === TRUE) {
        $insertinto = "INSERT INTO `$sections` (`sectionname`) VALUES ('$tablename');";
        if($dbconn->query($insertinto) === True) {
            header ("Location: Index.php?tablename=". $tablename);
        }
    }



    }
?>

<link rel="stylesheet" type="text/css" href="Style.css">
<div class="task-form">
    <form method="POST" class="form-inline" action="NewSection.php">
        <label>New Page Name:</label>
        <input class="form-cotrol" type="text" name="pageName" required>
        <button type="submit" name="create">Create</button>
    </form>
</div>
