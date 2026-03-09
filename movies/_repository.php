<?php

//CRUD functions
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
            $movie->duration        = format_duration_string($row['duration']);
            $movie->rating          = format_rating_string($row['rating']);
            $movie->release_date    = format_release_date_string($row['release_date']);
            $movie->genre           = format_genre_string($row['genre']);

            $movies[] = $movie;
        }
    }

    return $movies;
}

function get_movie_by_id($id): ?stdClass
{
    global $conn;

    $sql = "SELECT * FROM movie WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();

    $stmt->close();

    $movie = null;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $movie = new stdClass;
        $movie->id = (int) $row["id"];
        $movie->title = format_title($row["title"]);
        $movie->genre = format_genre($row["genre"]);
        $movie->duration = format_duration($row["duration"]);
        $movie->rating = format_rating($row["rating"]);
        $movie->release_date = format_release_date($row["release_date"]);
    }
    return $movie;
}

function add_movie(string $title, array $genre, int $duration, float $rating, string $release_date): ?int
{
    global $conn;


    $title          = parse_title($title);
    $genre          = parse_genre($genre);
    $duration       = parse_duration($duration);
    $rating         = parse_rating($rating);
    $release_date   = parse_release_date($release_date);

    $sql = "INSERT into movie (title, genre, duration, rating, release_date) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssids", $title, $genre, $duration, $rating, $release_date);

    $movie_id = null;
    if ($stmt->execute()) {
        $movie_id = $stmt->insert_id;
    }

    $stmt->close();

    return $movie_id;
}

function update_movie_by_id($id, $title, $genre, $duration, $rating, $release_date): ?int
{
    global $conn;

    $id = (int) $id;
    $title          = parse_title($title);
    $genre          = parse_genre($genre);
    $duration       = parse_duration($duration);
    $rating         = parse_rating($rating);
    $release_date   = parse_release_date($release_date);

    $sql = "UPDATE movie SET title = ?, genre = ?, duration = ?, rating = ?, release_date = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssidsi", $title, $genre, $duration, $rating, $release_date, $id);

    $movie_id = null;
    if ($stmt->execute()) {
        $movie_id = $id;
    }

    $stmt->close();

    return $movie_id;
}

function delete_movie_by_id($id): bool
{
    global $conn;

    $sql = "DELETE from movie WHERE id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $result = true;
    } else {
        $result = false;
    }

    $stmt->close();

    return $result;
}