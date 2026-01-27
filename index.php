<?php

$conn = get_db_connection();

get_movies($conn);

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


function get_movies($conn)
{
    $sql = "SELECT * FROM movie;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        //output data for each row
        while ($row = $result->fetch_assoc()) {
            echo "-Title: " . format_title($row["title"]) . "</br>";
            echo "-Genre: " . format_genre($row["genre"]) . "</br>";
            echo "-Duration: " . format_duration($row["duration"]) . "</br>";
            echo "-Rating: " . format_rating($row["rating"]) . "</br>";
            echo "-Release Date: " . format_release_date($row["release_date"]) . "</br>";
            echo "</br>";
        }
    } else {
        echo "0 result";
    }
}

function format_title($title)
{
    return ucwords(strtolower($title));
}

function format_genre($genre)
{
    return implode(", ", array_column(json_decode($genre, true), "name"));
}

function format_duration($duration)
{
    $hours = floor($duration / 60);
    $minutes = $duration % 60;
    return "{$hours}h" . " {$minutes}m";
}

function format_rating($rating)
{
    return "{$rating}/10";
}

function format_release_date($release_date)
{
    return date("d-M-Y", strtotime($release_date));
}
