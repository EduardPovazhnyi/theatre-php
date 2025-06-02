<?php
include 'database/config.php';
session_start();

// Validate and sanitise GET parameters
if (!isset($_GET['bid'])) {
    $_SESSION['status_message'] = "Invalid request.";
    header("Location: adminBloglist");
    exit();
}

// cast to integer cleans the input into a number and ignores anything that isn't a number.
$blogId = (int) $_GET['bid']; // Cast to integer


// delete all comments on selected blog

$cdelete = $conn->prepare("DELETE FROM `comment` WHERE `blog` = ?;");

if ($cdelete) {
    $cdelete->bind_param("i", $blogId);

    if ($cdelete->execute()) {
        $_SESSION['status_message'] = "Comment added successfully!";
    } else {
        $_SESSION['status_message'] = "Error executing query: " . $conn->error;
    }

    $cdelete->close();
} else {
    $_SESSION['status_message'] = "Error preparing query: " . $conn->error;
}

// delete selected blog

// Prepare and execute statement
// Using prepared statements will help prevent sql injection
$delete = $conn->prepare("DELETE FROM `blog` WHERE `id` = ?;");

if ($delete) {
    $delete->bind_param("i", $blogId);

    if ($delete->execute()) {
        $_SESSION['status_message'] = "Blog deleted successfully!";
    } else {
        $_SESSION['status_message'] = "Error executing query: " . $conn->error;
    }

    $delete->close();
} else {
    $_SESSION['status_message'] = "Error preparing query: " . $conn->error;
}

// Redirect back to the admin bloglist page
header("Location: adminBloglist");
exit();
?>