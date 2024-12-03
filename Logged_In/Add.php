<?php
    include('..\Connection.php');
    if(isset($_POST['add'])) {
        $trans = array(" " => "%20");
        $task = $_POST['task'];
        $person = $_POST['person'];
        $date = $_POST['date'];
        $priority = $_POST['priority'];
        $table_name = $_GET['tablename'];
        $files = "";
        $total = count($_FILES['file']['name']);
        for ($i = 0; $i < $total; $i++) {
            $filename = $_FILES['file']['name'][$i];
            $target_file = '../uploads/' . $filename;
            move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_file);
            $filename1 = strtr($filename, $trans);
            $link = "<a href=Download.php?tablename=".$table_name ."&file=". $filename1 .">". $filename . " </a>";
            $files = $files . " " . $link;

        }
        $Query = ("INSERT INTO $table_name VALUES('', '$task', '$person', '$date', '$priority','$files' , '')");
        $Run = mysqli_query($dbconn, $Query);
        if ($Run) {
        } else {
            echo "error" . mysqli_error($dbconn);
        }
        header('location:index.php?tablename='.$_GET['tablename']);
    } else {
        echo 'No task typed';
        header('location:index.php?tablename='.$_GET['tablename']);
    }
?>
