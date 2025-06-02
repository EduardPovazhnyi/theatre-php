<?php
include 'database/config.php';
session_start();

// Validate and sanitise GET parameters
if (!isset($_GET['rid']) || !isset($_GET['sid'])) {
    $_SESSION['status_message'] = "Invalid request.";
    header("Location: review?bid=" . $rID);
    exit();
}

// cast to integer cleans the input into a number and ignores anything that isn't a number.
$rID = (int) $_GET['rid']; // Cast to integer
$showID = (int) $_GET['sid']; // Cast to integer

// Prepare and execute statement
// Using prepared statements will help prevent sql injection
$delete = $conn->prepare("DELETE FROM `review` WHERE `id` = ?;");

if ($delete) {
    $delete->bind_param("i", $rID);

    if ($delete->execute()) {
        $_SESSION['status_message'] = "Review deleted successfully!";
    } else {
        $_SESSION['status_message'] = "Error executing query: " . $conn->error;
    }

    $delete->close();
} else {
    $_SESSION['status_message'] = "Error preparing query: " . $conn->error;
}

// Redirect back to the show page
header("Location: show?sid=" . $showID);
exit();
?>