<?php 
    //Set the valuables
    $Server = "localhost";
    $User = "TimAdmin";
    $Pass = "TimAdmin";
    $Database = "Computers";

    //Create connection
    $Conn = mysqli_connect($Server, $User, $Pass, $Database);
    //Check the connection
    if (!$Conn) {
        die("<script>alert('Connection Failed.')</script>");
    }

?>