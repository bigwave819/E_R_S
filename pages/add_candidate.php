<?php

$conn =new mysqli("localhost", "root", "", "emp_recruitment");

if (!$conn) {
    echo "<script>window.alert('failed to connect to the database')</script>";
}

session_start();
if (!isset($_SESSION['userId'])) {
    header("Location: /hirwa/auth/login.php");
    exit();
}

$postQuery = "SELECT * FROM post";
$postResult = $conn->query($postQuery);

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $birth = $_POST['birth'];
    $phone = $_POST['phone'];
    $postId = $_POST['postId'];

    $query = "INSERT INTO candidates(c_firstname, c_lastname, c_gender, c_dateOfBirth, phoneNumber, postId) VALUES('$firstname', '$lastname', '$gender', '$birth', '$phone', '$postId')";

    if ($conn->query($query) === TRUE) {
        echo "<script>alert('candidate added sucessively!') window.location.href='view_candidates.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <!-- FontAwesome Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="candidate.css">
    <title>Add Candidates</title>
</head>
<body>
    <div class="all">
<div class="p-3">
<a href="view_candidates.php" class="btn btn-primary">
      view Candidates
    </a>
</div>
<div class="container mt-5">
  <div class="card shadow-sm">
    <div class="card-body">
      <h4 class="card-title mb-4 text-center">Add Candidate</h4>
      <form method="POST">

        <div class="mb-3">
          <label class="form-label">Firstname</label>
          <input type="text" name="firstname" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Lastname</label>
          <input type="text" name="lastname" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Gender</label>
          <select name="gender" class="form-select" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Date of Birth</label>
          <input type="date" name="birth" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Phone</label>
          <input type="number" name="phone" class="form-control" required>
        </div>

        <div class="mb-4">
          <label class="form-label">Select Post</label>
          <select name="postId" class="form-select" required>
            <?php while ($row = $postResult->fetch_assoc()) { ?>
              <option value="<?php echo $row['postId']; ?>"><?php echo $row['postName']; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="d-grid">
          <button type="submit" name="submit" class="btn btn-primary btn-lg">Add Candidate</button>
        </div>

      </form>
    </div>
  </div>
</div>

        <script>
  function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    if (window.innerWidth <= 768) {
      sidebar.classList.toggle("sidebar-open");
    } else {
      if (sidebar.style.marginLeft === "-250px") {
        sidebar.style.marginLeft = "0";
        document.getElementById("content").style.marginLeft = "250px";
      } else {
        sidebar.style.marginLeft = "-250px";
        document.getElementById("content").style.marginLeft = "0";
      }
    }
  }
</script>
</body>
</html>