<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'database/config.php';

// Adding a check
if (!isset($user_id)) {
    $_SESSION['statusMsg'] = "User not logged in!";
    header("Location: addblog.php?bid=$blogID");
    exit;
}


$user_id = $_SESSION['id']; // User's ID (stored in session)

// Validate and sanitise GET parameters
if (!isset($_GET['bid'])) {
    $_SESSION['status_message'] = "Invalid request.";
    header("Location: userlist");
    exit();
}

// cast to integer cleans the input into a number and ignores anything that isn't a number.
$blogID = (int) $_GET['bid']; // Cast to integer


if($blogID == 0) {
    $targetDir = "assets/images/shows/";
    $fileName = basename($_FILES["image_url"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_FILES["image_url"]["error"] == 0) {
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }

            if (move_uploaded_file($_FILES["image_url"]["tmp_name"], $targetFilePath)) {
                $addBlog = $conn->prepare("INSERT INTO `blog` (`title`, `content`, `show`, `user`, `image_url`) VALUES(?, ?, ?, ?, ?)");
                $addBlog->bind_param('ssiis', $_POST['title'], $_POST['content'], $_POST['show'], $user_id, $fileName);
    
                if ($addBlog->execute()) {
                    $_SESSION['statusMsg'] = "The file " . $fileName . " has been uploaded and blog added successfully.";
                } 
            } else {
                $_SESSION['statusMsg'] = "Error moving uploaded file.";
            }
        } else {
            $_SESSION['statusMsg'] = "Invalid file type: " . $fileType;
        }
    } else {
        $_SESSION['statusMsg'] = "File upload error: " . $_FILES["image_url"]["error"];
    }   
} else {
        $editBlog = $conn->prepare("UPDATE `blog` SET `show` = ?,`title` = ?,`content` = ? WHERE `id` = $blogID;");
        $editBlog->bind_param('iss', $_POST['show'], $_POST['title'], $_POST['content']);
        $editBlog->execute();
}

header("Location: addblog?bid=$blogID");
exit;