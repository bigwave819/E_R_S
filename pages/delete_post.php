<?php

session_start();
$conn = new mysqli('localhost', 'root', '', 'emp_recruitment');

if (!isset($_SESSION['userId'])) {
    header('location: login.php');
    exit();
}

if (isset($_GET['postId'])) {
    $id = $_GET['postId'];

    // Step 1: Get all candidate IDs related to this post
    $candidateResult = $conn->query("SELECT C_ID FROM candidates WHERE postId='$id'");

    while ($row = $candidateResult->fetch_assoc()) {
        $c_id = $row['C_ID'];

        // Step 2: Delete related records from candidateresult table
        $conn->query("DELETE FROM candidateresult WHERE C_ID='$c_id'");
    }

    // Step 3: Delete candidates for this post
    $conn->query("DELETE FROM candidates WHERE postId='$id'");

    // Step 4: Now delete the post
    $sql = "DELETE FROM post WHERE postId='$id'";
    $result = $conn->query($sql);

    if ($result) {
        header("location: view_post.php");
        exit();
    } else {
        echo "Failed to delete post: " . $conn->error;
    }
}

?>
