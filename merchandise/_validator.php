<?php

function sanitize_name($name, array &$errors): string
{
    $name = trim(strip_tags($name));

    if ($name === '') {
        $errors['name'] = 'Merchandise name is required';
    }

    return $name;
}

function sanitize_description($description, array &$errors): ?string
{
    $description = trim($description);

    if ($description === '') {
        $errors['description'] = 'Description is required';
        return null;
    }

    return $description;
}

function sanitize_price($price, array &$errors): ?float
{
    if ($price === '' || $price === null) {
        return null;
    }

    if (!is_numeric($price) || $price < 0) {
        $errors['price'] = 'Price must be more than RM 0';
        return null;
    }

    return (float) $price;
}

function sanitize_stock_qty($stock_qty, array &$errors): ?int
{
    if ($stock_qty === '') {
        $errors['stock_qty'] = 'Stock quantity is required';
        return null;
    }

    $stock_qty = filter_var($stock_qty, FILTER_VALIDATE_INT);

    if ($stock_qty === false || $stock_qty <= 0) {
        $errors['stock_qty'] = 'Stock quantity must be more than 0';
        return null;
    }

    return $stock_qty;
}

function sanitize_image_url($image_url, array &$errors): ?string
{
    $image_url = trim($image_url);

    if ($image_url === '') {
        $errors['image_url'] = 'Image URL is required';
        return null;
    }

    return $image_url;
}

function sanitize_is_active($is_active, array &$errors): ?int
{
    if ($is_active === '') {
        $errors['is_active'] = 'Active status is required';
        return null;
    }

    $options = [
        'options' => [
            'min_range' => 0,
            'max_range' => 1
        ]
    ];

    $is_active = filter_var($is_active, FILTER_VALIDATE_INT, $options);

    if ($is_active === false) {
        $errors['stock_qty'] = 'Stock quantity must be either 0 or 1';
        return null;
    }

    return $is_active;
}