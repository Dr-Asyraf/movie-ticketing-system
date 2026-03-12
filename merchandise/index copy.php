<?php require_once 'index.code.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchandise</title>
</head>

<body>
    <!-- Header -->
    <div>
        <h3>Merchandise</h3>
    </div>


    <!-- Body -->
    <div>
        <?php foreach ($merchandises as $index => $merchandise) : ?>
            <tr>
                <td scope="row"><?= $index + 1 ?></td>
                <td><?php echo htmlspecialchars($merchandise->name); ?></td>
                <td><?php echo htmlspecialchars($merchandise->description); ?></td>
                <td><?php echo htmlspecialchars($merchandise->price); ?></td>
                <td><?php echo htmlspecialchars($merchandise->stock_qty); ?></td>
                <td><?php echo htmlspecialchars($merchandise->image_url); ?></td>
                <td><?php echo htmlspecialchars($merchandise->is_active); ?></td>
                <td><?php echo htmlspecialchars($merchandise->created_at); ?></td>
            </tr>
        <?php endforeach; ?>
    </div>
</body>

</html>