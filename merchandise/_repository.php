<?php

function get_merchandise(): array
{
    global $conn;

    $sql = "SELECT * FROM merchandise;";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $merchandises = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $merchandise = new stdClass();
            $merchandise->id = (int) $row['id'];
            $merchandise->name = format_name($row['name']);
            $merchandise->description = format_description($row['description']);
            $merchandise->price = format_price_string($row['price']);
            $merchandise->stock_qty = format_stock_qty_string($row['stock_qty']);
            $merchandise->image_url = format_image_url_string($row['image_url']);
            $merchandise->is_active = format_is_active($row['is_active']);
            $merchandise->created_at = format_created_at_string($row['created_at']);
            $merchandise->updated_at = $row['updated_at'];

            $merchandises[] = $merchandise;
        }
    }

    return $merchandises;
}

function get_merchandise_by_id($id): ?stdClass
{
    global $conn;

    $sql = "SELECT * FROM merchandise WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();

    $stmt->close();

    $merchandise = null;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $merchandise = new stdClass;
        $merchandise->id = (int) $row["id"];
        $merchandise->name = format_name($row["name"]);
        $merchandise->description = format_description($row["description"]);
        $merchandise->price = format_price($row["price"]);
        $merchandise->stock_qty = format_stock_qty($row["stock_qty"]);
        $merchandise->image_url = format_image_url($row["image_url"]);
    }
    return $merchandise;
}

function add_merchandise(string $name, string $description, float $price, int $stock_qty, string $image_url) : ?int
{
    global $conn;

    $name = parse_name($name);
    $description = parse_description($description);
    $price = parse_price($price);
    $stock_qty = parse_stock_qty($stock_qty);
    $image_url = parse_image_url($image_url);
    // $is_active = parse_is_active($is_active);

    $sql = "INSERT into merchandise (name, description, price, stock_qty, image_url) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdis", $name, $description, $price, $stock_qty, $image_url);

    $merchandise_id = null;
    if ($stmt->execute()) {
        $merchandise_id = $stmt->insert_id;
    }

    $stmt->close();

    return $merchandise_id;

}

function update_merchandise_by_id($id, $name, $description, $price, $stock_qty, $image_url): ?int
{
    global $conn;

    $id = (int) $id;
    $name        = parse_name($name);
    $description = parse_description($description);
    $price       = parse_price($price);
    $stock_qty   = parse_stock_qty($stock_qty);
    $image_url   = parse_image_url($image_url);

    $sql = "UPDATE merchandise SET name = ?, description = ?, price = ?, stock_qty = ?, image_url = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdisi", $name, $description, $price, $stock_qty, $image_url, $id);

    $merchandise_id = null;
    if ($stmt->execute()) {
        $merchandise_id = $id;
    }

    $stmt->close();

    return $merchandise_id;
}