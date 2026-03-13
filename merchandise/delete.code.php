<?php

require_once '_.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['delete_merchandise'])) {
    header('Location: index.php');
    exit;
}

$id = (int) ($_POST['id'] ?? 0);

if ($id <= 0) {
    header('Location: index.php?error=merchandise_not_found');
    exit;
} 

$merchandise = get_merchandise_by_id($id);

if (!$merchandise) {
    header('Location: index.php?error=merchandise_not_found');
    exit;
}

if (!delete_merchandise_by_id($id)) {
    header('Location: index.php?error=merchandise_not_found');
    exit;
}

header('Location: index.php?success=deleted');
exit;