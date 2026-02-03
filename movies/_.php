<?php

require_once '../config/db.php';

// CRUD functions
function get_movies()
{
    global $conn;

    $sql = "SELECT * FROM movie;";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();

    $stmt->close();

    $movies = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $movie = new stdClass;
            $movie->id              = (int) $row['id'];
            $movie->title           = format_title($row['title']);
            $movie->duration        = format_duration($row['duration']);
            $movie->rating          = format_rating($row['rating']);
            $movie->release_date    = format_release_date($row['release_date']);
            $movie->genre           = format_genre($row['genre']);

            $movies[] = $movie;
        }
    }

    return $movies;
}
