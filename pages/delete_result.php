<?php
session_start();

if (!isset($_SESSION['userId'])) {
    header("location: login.php");
    exit();
}

if (isset($_GET['CR_Id'])) {
    $CR_Id = intval($_GET['CR_Id']);

    // Connect to database
    $conn = new mysqli('localhost', 'root', '', 'emp_recruitment');

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Delete query
    $sql = "DELETE FROM candidateresult WHERE CR_Id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $CR_Id);

    if ($stmt->execute()) {
        // Success — redirect to reports page
        header("Location: view_report.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // No CR_Id provided — redirect to reports page
    header("Location: view_reports.php");
    exit();
}
?>
