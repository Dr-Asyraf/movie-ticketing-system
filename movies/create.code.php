<?php

require_once '_.php';

$old    = [];
$errors = [];

$allowed_genres = [
    'action',
    'adventure',
    'comedy',
    'fantasy',
    'horror',
    'romance',
    'sci-fi'
];

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['add_movie'])) {
    return;
}

$old = $_POST;
$old['genres'] = $_POST['genres'] ?? [];

$title = sanitize_title($old['title'] ?? '', $errors);
$genres = sanitize_genres($old['genres'], $allowed_genres, $errors);
$release_date = sanitize_release_date($old['release_date'] ?? '', $errors);
$rating       = sanitize_rating($old['rating'] ?? null, $errors);
$duration     = sanitize_duration($old['duration'] ?? '', $errors);

if (!empty($errors)) {
    return;
}

$movieId = add_movie(
    $title,
    $genres,
    $duration,
    $rating,
    $release_date
);

if (!$movieId) {
    $errors['general'] = 'Failed to save movie. Please try again.';
    return;
}

header('Location: index.php?success=created');
exit;