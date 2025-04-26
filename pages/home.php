<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header("Location: /hirwa/auth/login.php");
    exit();
}

$userName = isset($_SESSION['username']) ? $_SESSION['username'] : 'User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <!-- FontAwesome Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>
<body>
<div id="sidebar">
  <h4>EMP Recruit</h4>
  <ul class="nav flex-column">
    <li class="nav-item">
      <a class="nav-link active" href="home.php"><i class="fas fa-home"></i> Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="add_candidate.php"><i class="fas fa-user-edit"></i> Add Candidate</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="view_candidates.php"><i class="fas fa-users"></i> View Candidates</a>
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

<!-- Main Content -->
<div id="content">
    <div class="container mt-5">
            <!-- Card with welcome message -->
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h4 class="card-title mb-4">Welcome, <?php echo htmlspecialchars($userName); ?>!</h4>
                    <p class="card-text">
                        Welcome to <strong>EMP Recruit</strong>, your go-to platform for managing job candidates and recruitment processes. 
                        Here, you can:
                    </p>
                    <ul class="text-left">
                        <li><strong>Add candidates</strong> to the system by entering their personal and professional information.</li>
                        <li><strong>View candidates</strong> and manage the recruitment process with ease.</li>
                        <li><strong>Track recruitment posts</strong> and connect them with the right candidates.</li>
                        <li><strong>Ensure smooth workflow</strong> in the employee recruitment process.</li>
                    </ul>
                    <p>
                        Our platform is designed to make your recruitment process efficient and easy. Explore the options in the sidebar and get started!
                    </p>
                    <a href="home.php" class="btn btn-primary">Go to Dashboard</a>
                </div>
            </div>
        </div>

</div>

<!-- JS for Sidebar Toggle -->
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