<?php
include 'database/config.php';
session_start();

// Validate and sanitise GET parameters
if (!isset($_GET['sid']) || !isset($_GET['uid'])) {
    $_SESSION['status_message'] = "Invalid request.";
    header("Location: show");
    exit();
}

// cast to integer cleans the input into a number and ignores anything that isn't a number.
$showID = (int) $_GET['sid']; // Cast to integer
$userId = (int) $_GET['uid']; // Cast to integer

// Validate and sanitise POST content
if (!isset($_POST['content']) || empty(trim($_POST['content']))) {
    $_SESSION['status_message'] = "Review cannot be empty.";
    header("Location: show?sid=" . $showID);
    exit();
}

$content = trim($_POST['content']);

// Further check content length
if (strlen($content) < 5 || strlen($content) > 5000) {
    $_SESSION['status_message'] = "Review must be between 5 and 5000 characters.";
    header("Location: show?sid=" . $showID);
    exit();
}

// Prepare and execute statement
// Using prepared statements will help prevent sql injection
$insertReview = $conn->prepare("INSERT INTO `review`(`content`, `show`, `user`) VALUES (?,?,?);");

if ($insertReview) {
    $insertReview->bind_param("sii", $content, $showID, $userId);

    if ($insertReview->execute()) {
        $_SESSION['status_message'] = "Review added successfully!";
    } else {
        $_SESSION['status_message'] = "Error executing query: " . $conn->error;
    }

    $insertReview->close();
} else {
    $_SESSION['status_message'] = "Error preparing query: " . $conn->error;
}

// Redirect back to the show page
header("Location: show?sid=" . $showID);
exit();
?>