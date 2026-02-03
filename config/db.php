<?php

$conn = get_db_connection();

function get_db_connection()
{
    $servername = 'localhost';
    $username   = 'root';
    $password   = 'Asyraffauzi14';
    $dbname     = 'movie-ticketing-system';

    //create connection
    $connection = new mysqli(
        $servername,
        $username,
        $password,
        $dbname
    );

    //check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    return $connection;
}