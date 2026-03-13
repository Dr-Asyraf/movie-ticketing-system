<?php require_once 'create.code.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchandise</title>
</head>

<body>
    <div>
        <div>
            <div>
                <h2>New Merchandise</h2>
            </div>
            <form action="">
                <div>
                    <div>
                        <label for="name">
                            Name
                        </label>
                        <input
                            id="name"
                            type="text"
                            placeholder="Enter merchandise name" />
                    </div>

                    <div>
                        <label for="description">
                            Description
                        </label>
                        <input
                            id="description"
                            type="text"
                            placeholder="Enter description" />
                    </div>

                    <div>
                        <label for="price">
                            Price
                        </label>
                        <input
                            id="price"
                            type="float"
                            placeholder="Enter price" />
                    </div>
                </div>

                <div>
                    <button
                        type="button">
                        Cancel
                    </button>
                    <button
                        type="submit">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>