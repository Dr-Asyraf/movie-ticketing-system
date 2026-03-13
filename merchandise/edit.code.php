<?php

require_once '_.php';

$old = [];
$errors = [];

/* -----------------------
   GET: Load merchandise
----------------------- */
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {

    $merchandise_id = (int) $_GET['id'];
    $merchandise = get_merchandise_by_id($merchandise_id);

    if (!$merchandise) {
        header('Location: index.php?error=merchandise_not_found');
        exit;
    }
}

/* -----------------------
   POST: Update merchandise
----------------------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_merchandise'])) {

    $old = $_POST;

    $id = (int) ($_POST['id'] ?? 0);

    if ($id <= 0 || !get_merchandise_by_id($id)) {
        header('Location: index.php?error=merchandise_not_found');
        exit;
    }

    $name = sanitize_name($old['name'] ?? '', $errors);
    $description = sanitize_description($old['description'] ?? '', $errors);
    $price = sanitize_price($old['price'] ?? '', $errors);
    $stock_qty = sanitize_stock_qty_edit($old['stock_qty'] ?? '', $errors);
    $image_url = sanitize_image_url($old['image_url'] ?? '', $errors);

    if (!empty($errors)) {
        return;
    }

    $result = update_merchandise_by_id(
        $id,
        $name,
        $description,
        $price,
        $stock_qty,
        $image_url,
    );

    if (!$result) {
        $errors['general'] = 'Failed to update merchandise. Please try again.';
        return;
    }

    header('Location: index.php?success=updated');
    exit;
}
