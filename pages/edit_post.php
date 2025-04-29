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

$post = "SELECT * FROM post";
$postResult = $conn->query($post);

if (isset($_GET['postId'])) {
    $id = $_GET['postId'];
    $sql = "SELECT * FROM post WHERE postId='$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if (isset($_POST['submit'])) {

    $id = $_GET['postId'];
    $post = $_POST['post'];

    $sql = "UPDATE post SET postName='$post' WHERE postId='$id'";
    $result = $conn->query($sql);

    if ($result) {
        header("location: view_post.php");
    }
    else {
     echo"<script>window.alert('post not updated')<script/>";
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
            <input type="text" name="post" class="form-control mb-2" value="<?php echo $row['postName'] ?>"/>
            <button type="submit" name="submit" class="btn btn-primary">insert post</button>
        </form>
        </div>
        <div class="col-md-4"></div>
</body>
</html>