<?php

$conn = get_db_connection();

get_movies($conn);

add_movies($conn);

get_movies($conn);

/* 1. add movie function
2. tambah dummy data
3. format dummy data
4. panggil balik get movies function */

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

function add_movies($conn)
{

    $data = [
        "title"     => "Boku no hero",
        "genre"     => array('action', 'anime'),
        "duration"  => 90,
        "rating"    => 5.5,
        "release_date"  => "2024-08-14"
    ];

    $title = parse_title($data['title']);
    $genre = parse_genre($data['genre']);
    $duration = parse_duration($data['duration']);
    $rating = parse_rating($data['rating']);
    $release_date   = parse_release_date($data['release_date']);

    $sql = "INSERT into movie (title, genre, duration, rating, release_date) VALUES ('$title', '$genre', $duration, $rating, '$release_date')";
    if (mysqli_query($conn, $sql)){
        echo "New Movie Added Successfully. Movie ID: " . mysqli_insert_id($conn) . "</br>";
    } else {
        echo "Error: " . $sql . "</br>" . mysqli_error($conn);
    }
}

function parse_title($title)
{
    return strtolower(trim($title));
}

function parse_genre($genre)
{
    return json_encode(array_map(function ($g) {
        return ['name' => trim($g)];
    }, $genre));
}

function parse_duration($duration)
{
    return (int) $duration;
}

function parse_rating($rating)
{
    if ($rating) {
        return is_numeric($rating) ? (float) $rating : null;
    } else {
        return null;
    }
}

function parse_release_date($release_date)
{
    $dateObj = DateTime::createFromFormat('Y-m-d', $release_date);
    if (!$dateObj || $dateObj->format('Y-m-d') != $release_date) {
        throw new Exception("Invalid date format");
    }

    return $release_date;
}

//test
