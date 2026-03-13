<?php

require_once '_.php';

$old    = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['add_merchandise'])) {
    return;
}

$old = $_POST;

$name = sanitize_name($old['name'] ?? '', $errors);
$description = sanitize_description($old['description'] ??'', $errors);
$price = sanitize_price($old['price'] ??'', $errors);
$stock_qty = sanitize_stock_qty($old['stock_qty'] ??'', $errors);
$image_url = sanitize_image_url($old['image_url'] ??'', $errors);
// $is_active = sanitize_is_active($old['is_active'] ??'', $errors);

if (!empty($errors)) {
    return;
}

$merchandiseId = add_merchandise(
    $name,
    $description,
    $price,
    $stock_qty,
    $image_url,
    // $is_active
);

if (!$merchandiseId) {
    $errors['general'] = 'Failed to save merchandise. Please try again.';
    return;
}

header('Location: index.php?success=created');
exit;