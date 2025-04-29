<?php

session_start();
if (!isset($_SESSION['userId'])) {
    header("location: login.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'emp_recruitment');

if (!$conn) {
    echo "<script>alert('alert failed to connect')</script>";
}

if (isset($_POST['submit'])) {
    $posts = $_POST['post'];

    $sql = "INSERT INTO post(postName) VALUES('$posts')";
    $result=$conn->query($sql);
    if ($result) {
        echo"<script>window.alert('posst has been added ')</script>";
    }
    else {
        echo"<script>window.alert('failed to add new post')</script>";
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<div class="p-5">
        <a href="view_post.php" class="btn btn-primary">View candidates</a>
    </div>
    <div class="row mt-5">
        <div class="col-md-4"></div>
        <div class="col-md-4">
        <form method="POST" class="bg-white p-5 shadow-md">
            <label class="form-group">postName</label>
            <input type="text" name="post" class="form-control mb-2"/>
            <button type="submit" name="submit" class="btn btn-primary">insert post</button>
        </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</body>
</html>