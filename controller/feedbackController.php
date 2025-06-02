<?php
include 'database/config.php';
session_start();

// Validate and sanitise GET parameters
if (!isset($_GET['uid'])) {
    $_SESSION['status_message'] = "Invalid request.";
    header("Location: feedback");
    exit();
}

// cast to integer cleans the input into a number and ignores anything that isn't a number.
$userId = (int) $_GET['uid']; // Cast to integer

// Validate and sanitise POST content
if (!isset($_POST['content']) || empty(trim($_POST['content']))) {
    $_SESSION['status_message'] = "Feedback cannot be empty.";
    header("Location: feedback");
    exit();
}

$content = trim($_POST['content']);

// Further check content length
if (strlen($content) < 5 || strlen($content) > 65535) {
    $_SESSION['status_message'] = "Comment must be between 5 and 65535 characters.";
    header("Location: feedback");
    exit();
}
// Prepare and execute statement
// Using prepared statements will help prevent sql injection
$insertFeedback = $conn->prepare("INSERT INTO feedback (content, user) VALUES (?, ?)");

if ($insertFeedback) {
    $insertFeedback->bind_param("si", $content, $userId);

    if ($insertFeedback->execute()) {
        $_SESSION['status_message'] = "Feedback added successfully!";
    } else {
        $_SESSION['status_message'] = "Error executing query: " . $conn->error;
    }

    $insertFeedback->close();
} else {
    $_SESSION['status_message'] = "Error preparing query: " . $conn->error;
}

// Redirect back to the blog page
header("Location: home");
exit();
?>