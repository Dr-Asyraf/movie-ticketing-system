<?php

$conn = get_db_connection();

// get_movies();

// add_movies();

// update_movie();

// get_movies();

// get_movie_by_id();

// delete_movie();

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


function get_movies()
{
    global $conn;

    echo "<h3> Movies List </h3>";

    $sql = "SELECT * FROM movie;";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();

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

function add_movies()
{
    global $conn;

    echo "<h3> Add New Movie </h3>";

    $data = [
        "title"         => "Boku no hero",
        "genre"         => array('action', 'anime'),
        "duration"      => 90,
        "rating"        => 5.5,
        "release_date"  => "2024-08-14"
    ];

    $title          = parse_title($data['title']);
    $genre          = parse_genre($data['genre']);
    $duration       = parse_duration($data['duration']);
    $rating         = parse_rating($data['rating']);
    $release_date   = parse_release_date($data['release_date']);

    $sql = "INSERT into movie (title, genre, duration, rating, release_date) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssids", $title, $genre, $duration, $rating, $release_date);
    if ($stmt->execute()) {
        echo "New Movie Added Successfully. Movie ID: " . $stmt->insert_id . "</br>";
    } else {
        echo "Error: " . $stmt->error;
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

function update_movie()
{
    global $conn;

    echo "<h3>Update Movie</h3>";

    $data = [
        "id"            => 3,
        "title"         => "Naruto",
        "genre"         => array('ninja', 'action'),
        "duration"      => 30,
        "rating"        => 10,
        "release_date"  => "2012-09-14"
    ];

    $id = (int) $data['id'];
    $title          = parse_title($data['title']);
    $genre          = parse_genre($data['genre']);
    $duration       = parse_duration($data['duration']);
    $rating         = parse_rating($data['rating']);
    $release_date   = parse_release_date($data['release_date']);

    $sql = "UPDATE movie SET title = ?, genre = ?, duration = ?, rating = ?, release_date = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssidsi", $title, $genre, $duration, $rating, $release_date, $id);
    if ($stmt->execute()) {
        echo "Movie updated successfully. Movie ID: " . $id . "</br>";
    } else {
        echo "Error updating movie. </br>" . $stmt->error;
    }
}

function get_movie_by_id()
{
    global $conn;

    echo "<h3> Get movie by id </h3>";

    $id = 2;

    $sql = "SELECT * FROM movie WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "-Title: " . format_title($row["title"]) . "</br>";
            echo "-Genre: " . format_genre($row["genre"]) . "</br>";
            echo "-Duration: " . format_duration($row["duration"]) . "</br>";
            echo "-Rating: " . format_rating($row["rating"]) . "</br>";
            echo "-Release Date: " . format_release_date($row["release_date"]) . "</br>";
            echo "</br>";
        }
    } else {
        echo "0 Result";
    }
}

function delete_movie()
{
    global $conn;

    echo "<h3> Delete Movie </h3>";

    $id = 5;

    $sql = "DELETE from movie WHERE id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "Movie deleted successfully. Movie ID: " . $id;
    } else {
        echo "Error deleting movie. </br> Error: " . $stmt->error;
    }
}
