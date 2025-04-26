<?php
session_start();
$conn =new mysqli("localhost", "root", "", "emp_recruitment");
if (!$conn) {
    echo "<script>window.alert('failed to connect to the database')</script>";
}

if (isset($_POST['submit'])) {
    $username = $_POST['username']; // Correctly get the username
    $password = $_POST['password'];

    $checkUser = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($checkUser);

    if ($result->num_rows > 0) {
        echo "<script>alert('Username already taken! Please choose another one.'); window.history.back();</script>";
        exit();
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $insertUser = "INSERT INTO users(username, password) VALUES('$username', '$hashedPassword')";
        if ($conn->query($insertUser)) {
            header("Location: /hirwa/pages/home.php");
            exit();
        } else {
            echo "<script>alert('Error registering user: " . $conn->error . "'); window.history.back();</script>";
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Sign Up</title>
</head>
<body class="bg">
    <div class="">
        <div class="flex justify-content-center items-center">
            <form class="bg-white p-5 shadow-lg rounded" method="POST">
                <h2>Sign Up User</h2>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-2">
                    already have an account ?<a href="login.php">Login</a>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>

