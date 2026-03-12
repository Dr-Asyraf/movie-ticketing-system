<?php require_once 'index.code.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchandise</title>
</head>

<!-- CSS -->
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html,
    body {
        font-family: monospace;
    }

    .container {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        background-color: dodgerblue;
        padding: 10px;
        gap: 10px;
    }

    .container div {
        background-color: #f1f1f1;
        /* border: 1px solid black; */
        padding: 10px;
        font-size: 30px;
        text-align: center;
        margin: 3px;
        border-radius: 12px;
    }

    .container div.header {
        grid-area: header;
        text-align: center;
    }

    .container div.content {
        grid-area: content;
    }

    .content h5 {
        margin: 0;
    }

    .container div.footer {
        grid-area: footer;
        text-align: center;
    }

    .merchandise-image {
        max-width: 200px;
        margin: auto;
    }

    .disabled-grid {
        pointer-events: none;
        /* Prevents all click, hover, and other pointer events */
        opacity: 0.5;
        /* Visually "greys out" the container to indicate it's disabled */
        cursor: not-allowed;
        /* Changes the cursor to indicate the non-interactive state */
    }

    p {
        margin: 0;
    }

    .button-add {
        display: inline-block;
        outline: none;
        cursor: pointer;
        font-weight: 600;
        border-radius: 3px;
        padding: 12px 24px;
        border: 0;
        color: #000021;
        background: #1de9b6;
        line-height: 1.15;
        font-size: 16px;
        /* font-family: monospace; */
        text-decoration: none;

        :hover {
            transition: all .1s ease;
            box-shadow: 0 0 0 0 #fff, 0 0 0 3px #1de9b6;
        }
    }

    .badge {
        color: white;
        background-color: red;
        padding: 4px 10px;
        border-radius: 12px;
        text-align: center;

    }
</style>

<body>
    <!-- Body Header -->
    <div>
        <h2>Merchandise</h2>
    </div>

    <div>
        <a href="" class="button-add">Add New Merchandise</a>
    </div>


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
                        <a href="" class="button-add">View</a>
                        <a href="" class="button-add">Edit</a>
                        <a href="" class="button-add">Delete</a>
                    </div>

                </div>


                </tr>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>