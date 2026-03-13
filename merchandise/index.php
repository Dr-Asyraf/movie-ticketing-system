<?php require_once 'index.code.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchandise</title>
</head>

<!-- BODY -->

<body>
    <!-- Body Header -->

    <h2 style="margin: 10px; font-family: Segoe UI;">Merchandise</h2>

    <a href="/merchandise/create.php" class="button-add" style="margin: 5px 0px 0px 10px;">Add New Merchandise</a>

    <!-- Body Content-->
    <div class="container">
        <?php foreach ($merchandises as $index => $merchandise) : ?>
            <div>
                <div class="header">
                    <img
                        src="<?php echo htmlspecialchars($merchandise->image_url); ?>"
                        alt=""
                        class="merchandise-image">
                </div>

                <div class="content">
                    <h5><?php echo htmlspecialchars($merchandise->name); ?></h5>
                    <p style="margin-top: 10px; font-size: 20px;"><?php echo htmlspecialchars($merchandise->description); ?></p>
                    <br>
                    <p><?php echo htmlspecialchars($merchandise->created_at); ?></p>
                </div>

                <div class="footer">
                    <?php if ($merchandise->stock_qty == 0 || $merchandise->is_active == 0) : ?>
                        <span class="badge">OUT OF STOCK</span>
                    <?php else : ?>


                        <span><?php echo htmlspecialchars($merchandise->price); ?></span>
                    <?php endif; ?>

                    <div>
                        <a href="<?php echo '/merchandise/show.php?id=' . urlencode($merchandise->id); ?>" class="button-view">View</a>
                        <a href="<?php echo '/merchandise/edit.php?id=' . urlencode($merchandise->id); ?>" class="button-edit">Edit</a>
                        <form action="/merchandise/delete.php" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this merchandise?');">
                            <input type="hidden" name="id" value="<?= $merchandise->id ?>">
                            <button type="submit" name="delete_merchandise" value="1" class="button-delete">Delete</button>
                        </form>
                    </div>

                </div>


                </tr>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>