<?php

//Helper functions
function format_name($name): string
{
    return ucwords(strtolower($name));
}

function format_description($description): string
{
    return ucfirst(strtolower($description));
}

function format_price_string($price): string
{
    if ($price === null){
        return "N/A";
    }
    
    $price = (float) $price;

    return "RM {$price}";
}

function format_stock_qty_string($stock_qty): string
{
    if ($stock_qty === null){
        return "N/A";
    }

    $stock_qty = (float) $stock_qty;
    return "{$stock_qty}";
}

function format_image_url($image_url): string
{
    return "{$image_url}";
}

function format_is_active($is_active): bool
{
    return $is_active;
}

function format_created_at_string($created_at): ?string
{
    if (!$created_at) return null;

    $timestamp = strtotime($created_at);

    return $timestamp ? date("j F Y", $timestamp) : null;
}