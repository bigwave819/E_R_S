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


$sql = "SELECT * FROM post";
$result = $conn->query($sql);


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
    <div class="row">
        <div class="col-md-4 ms-0">
        <div id="sidebar">
                <h4>EMP Recruit</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                    <a class="nav-link" href="home.php"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="view_candidates.php"><i class="fas fa-user-edit"></i>Candidate</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="view_candidates.php"><i class="fas fa-users"></i> post</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="view_candidates.php"><i class="fas fa-users"></i> report</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="../auth/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </li>
                </ul>
                </div>

                <!-- Toggle Button -->
                <button class="btn btn-outline-secondary btn-sm btn-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
                </button>
        </div>
        <div class="col-md-8 p-5">
            <div class='p-5'>
                <a href="add_post.php" class="btn btn-primary">add post</a>
            </div>
        <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>Post Name</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
             ?>
                
                <tr>
                    <td><?php echo htmlspecialchars($row['postId']) ?></td>
                    <td><?php echo htmlspecialchars($row['postName']) ?></td>
                    <td><a href="edit_post.php?postId=<?php echo $row['postId'] ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                    <td><a href="delete_post.php?postId=<?php echo $row['postId'] ?>"><i class="fa-solid fa-trash text-danger"></i></a></td>
                </tr>

            <?php 
            } 
        }
        else {
            echo '<tr><td colspan="7">No candidates found.</td></tr>';
        }
        ?>

        </tbody>
    </table>
        </div>
    </div>

    <script>
  function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    sidebar.classList.toggle("sidebar-open");
  }
</script>
</body>
</html>