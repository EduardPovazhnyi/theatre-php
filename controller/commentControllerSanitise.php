<?php
include 'database/config.php';
session_start();

// Validate and sanitise GET parameters
if (!isset($_GET['bid']) || !isset($_GET['uid'])) {
    $_SESSION['status_message'] = "Invalid request.";
    header("Location: blog");
    exit();
}

// cast to integer cleans the input into a number and ignores anything that isn't a number.
$blogId = (int) $_GET['bid']; // Cast to integer
$userId = (int) $_GET['uid']; // Cast to integer

// Validate and sanitise POST content
if (!isset($_POST['content']) || empty(trim($_POST['content']))) {
    $_SESSION['status_message'] = "Comment cannot be empty.";
    header("Location: blog?bid=" . $blogId);
    exit();
}

$content = trim($_POST['content']);

// Further check content length
if (strlen($content) < 5 || strlen($content) > 500) {
    $_SESSION['status_message'] = "Comment must be between 5 and 500 characters.";
    header("Location: blog?bid=" . $blogId);
    exit();
}
// Prepare and execute statement
// Using prepared statements will help prevent sql injection
$insertComment = $conn->prepare("INSERT INTO comment (content, blog, user) VALUES (?, ?, ?)");

if ($insertComment) {
    $insertComment->bind_param("sii", $content, $blogId, $userId);

    if ($insertComment->execute()) {
        $_SESSION['status_message'] = "Comment added successfully!";
    } else {
        $_SESSION['status_message'] = "Error executing query: " . $conn->error;
    }

    $insertComment->close();
} else {
    $_SESSION['status_message'] = "Error preparing query: " . $conn->error;
}

// Redirect back to the blog page
header("Location: blog?bid=" . $blogId);
exit();
?>