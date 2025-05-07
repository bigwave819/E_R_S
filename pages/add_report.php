<?php
session_start();

if (!isset($_SESSION['userId'])) {
    header("location: login.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'emp_recruitment');

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Fetch available posts for dropdown
$postQuery = "SELECT * FROM post";
$postResult = $conn->query($postQuery);

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date'];
    $phoneNumber = $_POST['phone'];
    $postId = $_POST['post'];

    // Insert candidate
    $insertSql = "INSERT INTO candidates (C_firstname, C_lastname, C_Gender, C_DateOfBirth, PhoneNumber, postId)
                  VALUES ('$firstname', '$lastname', '$gender', '$date_of_birth', '$phoneNumber', '$postId')";

    $insertResult = $conn->query($insertSql);

    if ($insertResult) {
        header('location: view_candidates.php');
        exit();
    } else {
        echo "<script>alert('Failed to add candidate: " . $conn->error . "')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Candidate</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="mb-3">
        <a href="view_candidates.php" class="btn btn-primary">Back to Candidates</a>
    </div>
    <h3 class="text-success text-center mb-4">Add New Candidate</h3>

    <form method="post" class="bg-white p-5 rounded shadow">
        <label class="form-label">Firstname</label>
        <input type="text" name="firstname" class="form-control" required><br/>

        <label class="form-label">Lastname</label>
        <input type="text" name="lastname" class="form-control" required><br/>

        <label class="form-label">Gender</label>
        <select name="gender" class="form-control" required>
            <option value="" disabled selected>-- Select Gender --</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select><br/>

        <label class="form-label">Date of Birth</label>
        <input type="date" name="date" class="form-control" required><br/>

        <label class="form-label">Phone Number</label>
        <input type="text" name="phone" class="form-control" required><br/>

        <label class="form-label">Post</label>
        <select name="post" class="form-control" required>
            <option value="" disabled selected>-- Select Post --</option>
            <?php while($row = $postResult->fetch_assoc()) { ?>
                <option value="<?php echo $row['postId']; ?>">
                    <?php echo htmlspecialchars($row['postName']); ?>
                </option>
            <?php } ?>
        </select><br/>

        <button type="submit" name="submit" class="btn btn-success w-100">Add Candidate</button>
    </form>
</div>

</body>
</html>
