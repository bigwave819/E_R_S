<?php

session_start();
$conn =new mysqli("localhost", "root", "", "emp_recruitment");
if (!$conn) {
    echo "<script>window.alert('failed to connect to the database')</script>";
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['userId'] = $user['userId'];
            $_SESSION['username'] = $user['username'];
            header("Location:pages/home.php");
            exit();
        } else {
            echo "<script>alert('Incorrect username or password'); window.history.back();</script>";
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
    <link rel="stylesheet" href="auth/style.css">
    <title>Login</title>
</head>
<body class="bg">
    <div class="w-full h-full">
        <div class="flex justify-content-center items-center">
        <form class="bg-white p-5 shadow-lg enable-rounded" method="POST">
            <h2>Login User</h2>
            <div class="mb-3">
                <label class="form-label">UserName</label>
                <input type="text" name="username" class="form-control" >
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="mb-2">
                don't have an account? <a href="auth/signup.php">SignUp</a>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Login</button>
        </form>
        </div>
    </div>
</body>
</html>

