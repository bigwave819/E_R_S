<?php

session_start();
$conn = new mysqli('localhost','root', '', 'emp_recruitment');

if (!isset($_SESSION['userId'])) {
    header('location: login.php');
    exit();
}

if (isset($_GET['postId'])) {
    $id = $_GET['postId'];

    $conn->query("DELETE FROM candidates WHERE postId='$id'");

    $sql = "DELETE FROM post WHERE postId='$id'";

    $result = $conn->query($sql);

    if ($result) {
        header("location: view_post.php");
    }
}


?>
