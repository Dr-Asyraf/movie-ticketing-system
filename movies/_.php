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

// Helper functions
function format_title($title)
{
    return ucwords(strtolower($title));
}

function format_genre($genre) : array
{
    if (!$genre) return [];

    $json_genre = json_decode($genre, true);

    if (!is_array($json_genre)) return [];

    return array_column($json_genre, 'name');
}

function format_genre_string($genre) : string
{
    if (!$genre) return 'N/A';

    $json_genre = json_decode($genre, true);

    if (!is_array($json_genre)) return 'N/A';

    $arr_genre = array_column($json_genre, 'name');
    
    return ucwords(strtolower(implode(", ", $arr_genre)));
}

function format_duration($duration) : int
{
    return $duration;
}

function format_duration_string($duration) : string
{
    $hours = floor($duration / 60);
    $minutes = $duration % 60;
    return "{$hours}h" . " {$minutes}m";
}


function format_rating($rating) : float
{
    return (float) $rating;
}

function format_rating_string($rating)
{
    return "{$rating}/10";
}

function format_release_date($release_date) : ?string
{
    if (!$release_date) return null;

    $timestamp = strtotime($release_date);

    return $timestamp ? date("Y-m-d", $timestamp) : null;
}

function format_release_date_string($release_date) : ?string
{
    if (!$release_date) return null;

    $timestamp = strtotime($release_date);

    return $timestamp ? date("F j, Y", $timestamp) : null;
}

function parse_title($title)
{
    return strtolower(trim($title));
}

function parse_genre($genre) : string
{
    if (!is_array($genre)) {
        return json_encode([]);
    }

    return json_encode(array_map(function ($g) {
        return ['name' => trim($g)];
    }, $genre));
}

function parse_duration($duration) : int
{
    return (int) $duration;
}

function parse_rating($rating) : ?string
{
    if ($rating) {
        return is_numeric($rating) ? (float) $rating : null;
    } else {
        return null;
    }
}

function parse_release_date($release_date) : ?string
{
    $release_date = trim($release_date);
    $dateObj = DateTime::createFromFormat('Y-m-d', $release_date);
    return $dateObj ? $dateObj->format('Y-m-d') : null;
}
