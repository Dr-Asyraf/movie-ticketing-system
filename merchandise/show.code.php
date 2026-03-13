<?php

require_once '_.php';

$merchandise_id = (int) ($_GET['id'] ?? 0);

if ($merchandise_id <= 0) {
    header('Location: index.php?error=merchandise_not_found');
    exit;
}

$merchandise = get_merchandise_by_id($merchandise_id);

if (!$merchandise) {
    header('Location: index.php?error=merchandise_not_found');
    exit;
}