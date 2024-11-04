<?php

function db_connect()
{
    // $conn = mysqli_connect('localhost', 'front_end', '123456789', 'xampp_db');
    $conn = mysqli_connect('localhost', 'root', '', 'xampp_db');

    if (!$conn) {
        echo 'Connection error: ' . mysqli_connect_error();
    }

    return $conn;
}

// db_connect();
// function db_query($sql, $conn)
// {
//     $res = mysqli_query($conn, $sql);
//     return $res;
// };
