<?php
$conn = new mysqli("localhost", "root", "", "emp_recruitment");

if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
if (!isset($_SESSION['userId'])) {
    header("Location: /hirwa/auth/login.php");
    exit();
}

$query = "SELECT c.*, p.postName FROM candidates c 
          JOIN post p ON c.postId = p.postId";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Candidates</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    #sidebar {
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      background: white;
      padding: 20px;
      transition: margin-left 0.3s;
    }

    #sidebar h4 {
      margin-bottom: 30px;
    }


    #sidebar.sidebar-open {
      margin-left: 0;
    }

    @media (max-width: 768px) {
      #sidebar {
        margin-left: -250px;
      }

      #sidebar.sidebar-open {
        margin-left: 0;
      }
    }

    .btn-toggle {
      position: fixed;
      top: 15px;
      left: 15px;
      z-index: 999;
    }
  </style>
</head>
<body>


<div id="sidebar">
                <h4>EMP Recruit</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                    <a class="nav-link" href="home.php"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="view_candidates.php"><i class="fas fa-user-edit"></i>Candidate</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="view_post.php"><i class="fas fa-users"></i> post</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="view_report.php"><i class="fas fa-users"></i> report</a>
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

<!-- Content -->
<div class="container mt-5" style="margin-left: 270px; max-width: 100%;">
  <div class="p-5">
    <a href="add_candidate.php" class="btn btn-primary">
      add Candidates
    </a>
  </div>
  <div class="card shadow-sm">
    <div class="card-body">
      <h4 class="card-title mb-4 text-center">Candidates List</h4>

      <?php if ($result->num_rows > 0) { ?>
        <div class="table-responsive">
          <table class="table table-hover table-bordered table-striped">
            <thead class="table-primary">
              <tr>
                <th>#</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Gender</th>
                <th>Birth Date</th>
                <th>Phone</th>
                <th>Post Applied</th>
                <th colspan="2">action</th>
              </tr>
            </thead>
            <tbody>
            <?php 
            $i = 1;
            while ($row = $result->fetch_assoc()) { ?>
              <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo htmlspecialchars($row['C_firstname']); ?></td>
                <td><?php echo htmlspecialchars($row['C_lastname']); ?></td>
                <td><?php echo htmlspecialchars($row['C_Gender']); ?></td>
                <td><?php echo htmlspecialchars($row['C_DateOfBirth']); ?></td>
                <td><?php echo htmlspecialchars($row['PhoneNumber']); ?></td>
                <td><?php echo htmlspecialchars($row['postName']); ?></td>
                <td>
                  <a href="edit_candidates.php?C_Id=<?php echo $row['C_ID']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                  <a href="delete_candidates.php?C_Id=<?php echo $row['C_ID']; ?>" class="text-danger"><i class="fa-solid fa-trash"></i></a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
          </table>
        </div>
      <?php } else { ?>
        <p class="text-muted text-center">No candidates found.</p>
      <?php } ?>

    </div>
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
