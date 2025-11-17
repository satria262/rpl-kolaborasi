<?php 
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'collab_database';
    $conn = mysqli_connect($host, $user, $pass, $db);
    $conn->set_charset("utf8");

    if ($conn) {
        // echo 'ada';
    }
    $query = mysqli_query($conn,' SELECT * FROM landing');
    // convert ke array
    while($row = (array) mysqli_fetch_array($query)) {
        // echo $row['title'];
    }

?>