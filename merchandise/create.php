<?php require_once 'create.code.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchandise</title>
    <link rel="stylesheet" href="create.css">
</head>

<body>

    <div class="card">
        <div class="card-header">
            <h2>New merchandise</h2>
            <p>Fill in the details below to add a new item.</p>
        </div>

        <form action="" method="POST">
            <div class="card-body">

                <div class="field">
                    <label for="name">Name</label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        placeholder="Enter merchandise name"
                        value="<?= htmlspecialchars($old['name'] ?? '') ?>" />
                    <div class="text-danger mt-1">
                        <small><?= htmlspecialchars($errors['name'] ?? '') ?></small>
                    </div>
                </div>

                <div class="field">
                    <label for="description">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        placeholder="Brief description of the item..."
                        value="<?= htmlspecialchars($old['description'] ?? '') ?>"></textarea>
                    <div class="text-danger mt-1">
                        <small><?= htmlspecialchars($errors['description'] ?? '') ?></small>
                    </div>
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
                            value="<?= htmlspecialchars($old['price'] ?? '') ?>" />
                        </div>
                        <div class="text-danger mt-1">
                            <small><?= htmlspecialchars($errors['price'] ?? '') ?></small>
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
                        value="<?= htmlspecialchars($old['stock_qty'] ?? '') ?>" />
                    <div class="text-danger mt-1">
                        <small><?= htmlspecialchars($errors['stock_qty'] ?? '') ?></small>
                    </div>
                </div>

                <div class="field">
                    <label for="image_url">Image URL</label>
                    <textarea
                        id="image_url"
                        name="image_url"
                        placeholder="Insert image url here.."
                        value="<?= htmlspecialchars($old['image_url'] ?? '') ?>"></textarea>
                    <div class="text-danger mt-1">
                        <small><?= htmlspecialchars($errors['image_url'] ?? '') ?></small>
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <a href="<?= '/merchandise/index.php'; ?>" class="btn">Cancel</a>
                <button class="btn btn-primary" type="submit" name="add_merchandise">Save item</button>
            </div>
        </form>

    </div>

</body>

</html>