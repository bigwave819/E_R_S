<?php

session_start();
$conn = new mysqli('localhost','root', '', 'emp_recruitment');

if (!isset($_SESSION['userId'])) {
    header('location: login.php');
    exit();
}

if (isset($_GET['C_Id'])) {
    
    $id = $_GET['C_Id'];
    $deleteResultSql = "DELETE FROM candidateresult WHERE C_ID = '$id'";
    mysqli_query($conn, $deleteResultSql);

    // Now, delete the candidate
    $sql = "DELETE FROM candidates WHERE C_Id='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('location: view_candidates.php');
        exit();
    } else {
        echo "<script>window.alert('failed to delete')</script>";
    }
}

?>