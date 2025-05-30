<?php
include 'database/config.php';
session_start();

// Validate and sanitise GET parameters
if (!isset($_GET['cid']) || !isset($_GET['bid'])) {
    $_SESSION['status_message'] = "Invalid request.";
    header("Location: blog?bid=" . $blogId);
    exit();
}

// cast to integer cleans the input into a number and ignores anything that isn't a number.
$cID = (int) $_GET['cid']; // Cast to integer
$blogId = (int) $_GET['bid']; // Cast to integer

// Prepare and execute statement
// Using prepared statements will help prevent sql injection
$delete = $conn->prepare("DELETE FROM `comment` WHERE `id` = ?;");

if ($delete) {
    $delete->bind_param("i", $cID);

    if ($delete->execute()) {
        $_SESSION['status_message'] = "Comment added successfully!";
    } else {
        $_SESSION['status_message'] = "Error executing query: " . $conn->error;
    }

    $delete->close();
} else {
    $_SESSION['status_message'] = "Error preparing query: " . $conn->error;
}

// Redirect back to the blog page
header("Location: blog?bid=" . $blogId);
exit();
?>