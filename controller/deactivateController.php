<?php
include 'database/config.php';
session_start();

// Validate and sanitise GET parameters
if (!isset($_GET['uid'])) {
    $_SESSION['status_message'] = "Invalid request.";
    header("Location: userlist");
    exit();
}

// cast to integer cleans the input into a number and ignores anything that isn't a number.
$userID = (int) $_GET['uid']; // Cast to integer

if (!isset($_GET['action']) || !in_array($_GET['action'], ['deactivate', 'activate'])) {
    $_SESSION['status_message'] = "Invalid action.";
    header("Location: userlist");
    exit();
}

$action = $_GET['action'];



// delete all comments by selected user

if ($action == 'deactivate') {
    // delete all comments by selected user
    $cdelete = $conn->prepare("DELETE FROM `comment` WHERE `user` = ?;");
    if ($cdelete) {
        $cdelete->bind_param("i", $userID);
        $cdelete->execute();
        $cdelete->close();
    }

// $cdelete = $conn->prepare("DELETE FROM `comment` WHERE `user` = ?;");

// if ($cdelete) {
//     $cdelete->bind_param("i", $userID);

//     if ($cdelete->execute()) {
//         $_SESSION['status_message'] = "Comments deleted successfully!";
//     } else {
//         $_SESSION['status_message'] = "Error executing query: " . $conn->error;
//     }

//     $cdelete->close();
// } else {
//     $_SESSION['status_message'] = "Error preparing query: " . $conn->error;
// }

// deactivate selected user

$update = $conn->prepare("UPDATE `user` SET `status`='inactive' WHERE `id` = ?;");
    if ($update) {
        $update->bind_param("i", $userID);
        $update->execute();
        $update->close();
    }
    $_SESSION['status_message'] = "User deactivated successfully!";
} elseif ($action == 'activate') {
    // activate selected user (set status back to 'user')
    $update = $conn->prepare("UPDATE `user` SET `status`='user' WHERE `id` = ?;");
    if ($update) {
        $update->bind_param("i", $userID);
        $update->execute();
        $update->close();
    }
    $_SESSION['status_message'] = "User activated successfully!";
}

// Prepare and execute statement
// Using prepared statements will help prevent sql injection
// $delete = $conn->prepare("UPDATE `user` SET `status`='inactive' WHERE `id` = ?;");

// if ($delete) {
//     $delete->bind_param("i", $userID);

//     if ($delete->execute()) {
//         $_SESSION['status_message'] = "User deactivated successfully!";
//     } else {
//         $_SESSION['status_message'] = "Error executing query: " . $conn->error;
//     }

//     $delete->close();
// } else {
//     $_SESSION['status_message'] = "Error preparing query: " . $conn->error;
// }

// Redirect back to the user list page
header("Location: userlist");
exit();
?>