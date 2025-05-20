<?php


$hn = "localhost";
$un = "ben_admin";
$pw = "DZot!*[iXcxMIV.U";
$db = "theatre";

// Create database connection
$conn = new mysqli($hn, $un, $pw, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
// else
// {
//     echo "Connection successful";
// }


?>