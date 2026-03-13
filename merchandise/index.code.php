<?php

require_once '_.php';

$merchandises = get_merchandise();

if (isset($_GET['success'])) {
    if ($_GET['success'] == 'created')
        $success = "Merchandise created successfully";

    if ($_GET['success'] == 'updated')
        $success = "Merchandise updated successfully";

    if ($_GET['success'] == 'deleted')
        $success = "Merchandise deleted successfully";
}

if (isset($_GET['error'])) {
    if ($_GET['error'] == 'merchandise_not_found')
        $error = "Merchandise not found";

    if ($_GET['error'] == 'delete_failed')
        $error = "Failed to delete merchandise";
}