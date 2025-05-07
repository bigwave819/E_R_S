<?php
session_start();

if (!isset($_SESSION['userId'])) {
    header("location: login.php");
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'emp_recruitment');

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Fetch existing result by CR_Id
if (isset($_GET['CR_Id'])) {
    $CR_Id = intval($_GET['CR_Id']);

    $sql = "SELECT * FROM candidateresult WHERE CR_Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $CR_Id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        // If result not found
        header("Location: view_reports.php");
        exit();
    }
    $stmt->close();
}

// Update result on form submit
if (isset($_POST['update'])) {
    $examDate = $_POST['exam_date'];
    $marks = $_POST['marks'];
    $decision = $_POST['decision'];

    $updateSql = "UPDATE candidateresult SET ExamDate = ?, CR_marks = ?, CR_decision = ? WHERE CR_Id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("sdsi", $examDate, $marks, $decision, $CR_Id);

    if ($stmt->execute()) {
        header("Location: view_reports.php");
        exit();
    } else {
        echo "Failed to update result: " . $conn->error;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Candidate Result</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h3 class="text-success text-center mb-4">Edit Candidate Result</h3>
    <form method="POST" class="bg-light p-4 rounded">
        <div class="mb-3">
            <label class="form-label">Exam Date</label>
            <input type="date" name="exam_date" class="form-control" value="<?php echo htmlspecialchars($row['ExamDate']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Marks</label>
            <input type="number" step="0.01" name="marks" class="form-control" value="<?php echo htmlspecialchars($row['CR_marks']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Decision</label>
            <input type="text" name="decision" class="form-control" value="<?php echo htmlspecialchars($row['CR_decision']); ?>" required>
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update Result</button>
        <a href="view_report.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

</body>
</html>
