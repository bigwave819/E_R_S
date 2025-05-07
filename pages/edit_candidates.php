<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header("location: login.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'emp_recruitment');

if ($conn->connect_error) {
    echo "<script>alert('Failed to connect to the database.')</script>";
}

$postQuery = "SELECT * FROM post";
$postResult = $conn->query($postQuery);

if (isset($_GET['C_Id'])) {
    $id = $_GET['C_Id'];
    $sql = "SELECT * FROM candidates WHERE C_ID='$id'";
    $result = $conn->query($sql);
    $roww = $result->fetch_assoc();
}

if (isset($_POST['submit'])) {
    $id = $_GET['C_Id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date'];
    $phoneNumber = $_POST['phone'];
    $post = $_POST['post'];

    $updateSql = "UPDATE candidates SET 
                    C_firstname='$firstname', 
                    C_lastname='$lastname', 
                    C_Gender='$gender', 
                    C_DateOfBirth='$date_of_birth', 
                    PhoneNumber='$phoneNumber', 
                    postId='$post' 
                  WHERE C_ID='$id'";

    $updateResult = $conn->query($updateSql);

    if ($updateResult) {
        header('location: view_candidates.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Candidate</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="row mt-5">
    <div class="col-md-3"></div>
    <div class="col-md-1">
    <button class="btn btn-primary"><a href="view_candidates.php" class="text-white hello">back to home</a></button>
    </div>
    <div class="col-md-4">
        <h3 class="text-success text-center">edit candidates</h3>
        <form method="post" class="bg-white p-5 rounded mb-5">
            <label class="form-label">Firstname</label>
            <input type="text" name="firstname" class="form-control" value="<?php echo htmlspecialchars($roww['C_firstname']); ?>" /><br/>

            <label class="form-label">Lastname</label>
            <input type="text" name="lastname" class="form-control" value="<?php echo htmlspecialchars($roww['C_lastname']); ?>" /><br/>

            <label class="form-label">Gender</label>
            <select name="gender" class="form-control">
                <option value="male" >Male</option>
                <option value="female">Female</option>
            </select><br/>

            <label class="form-label">Date Of Birth</label>
            <input type="date" name="date" class="form-control" value="<?php echo $roww['C_DateOfBirth']; ?>"><br/>

            <label class="form-label">Phone</label>
            <input type="number" name="phone" class="form-control" value="<?php echo $roww['PhoneNumber']; ?>"><br/>

            <label class="form-label">Post</label>
            <select name="post" class="form-control">
                <?php while($row = $postResult->fetch_assoc()) { ?>
                    <option value="<?php echo $row['postId']; ?>">
                        <?php echo htmlspecialchars($row['postName']); ?>
                    </option>
                <?php } ?>
            </select><br/>

            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <div class="col-md-4"></div>
</div>
</body>
</html>
