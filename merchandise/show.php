<?php require_once 'show.code.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchandise</title>
    <link rel="stylesheet" href="show.css">
</head>


<body>

    <div class="card">
        <div class="card-header">
            <h2>Merchandise</h2>
        </div>

        <div class="card-body">

            <div class="field">
                <label for="name">Name</label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="<?= htmlspecialchars($merchandise->name) ?>" disabled
                    style="background-color: lightgrey;" />
            </div>

            <div class="field">
                <label for="description">Description</label>
                <input
                    id="description"
                    name="description"
                    value="<?= htmlspecialchars($merchandise->description) ?>" disabled
                    style="background-color: lightgrey;" />
            </div>

            <div class="field">
                <label for="price">Price</label>
                <div class="price-wrap">
                    <span>RM</span>
                    <input
                        id="price"
                        name="price"
                        type="number"
                        min="0"
                        step="0.01"
                        placeholder="0.00"
                        value="<?= htmlspecialchars($merchandise->price) ?>" disabled
                        style="background-color: lightgrey;" />
                </div>
            </div>

            <div class="field">
                <label for="stock_qty">Stock quantity</label>
                <input
                    id="stock_qty"
                    name="stock_qty"
                    type="number"
                    min="0"
                    step="1"
                    placeholder="0"
                    value="<?= htmlspecialchars($merchandise->stock_qty) ?>" disabled
                    style="background-color: lightgrey;" />
            </div>

            <div class="field">
                <label for="image_url">Image URL</label>
                <textarea
                    id="image_url"
                    name="image_url"
                    style="background-color: lightgrey;" disabled>
                <?= htmlspecialchars($merchandise->image_url) ?>
            </textarea>
            </div>
        </div>

        <div class="card-footer">
            <a href="<?= '/merchandise/index.php'; ?>" class="button-back">Back</a>
            <a href="<?= '/merchandise/edit.php'; ?>" class="button-edit">Edit</a>
        </div>


    </div>

</body>

</html>