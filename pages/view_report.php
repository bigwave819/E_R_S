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

// Fetch candidate results with candidate details
$sql = "SELECT cr.CR_Id, c.C_firstname, c.C_lastname, c.C_Gender, c.PhoneNumber, cr.ExamDate, cr.CR_marks, cr.CR_decision 
        FROM candidateresult cr
        JOIN candidates c ON cr.C_ID = c.C_ID";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Candidate Results Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            display: flex;
        }

        #sidebar {
            width: 250px;
            height: 100vh;
            background:#ffffff;
            padding: 20px;
            color: #fff;
            position: fixed;
            transition: all 0.3s ease;
        }

        #sidebar h4 {
            color: #000;
            margin-bottom: 30px;
        }

        #sidebar .nav-link {
            color: #000;
        }

        #sidebar .nav-link.active, 
        #sidebar .nav-link:hover {
            color: #ddd;
        }

        .btn-toggle {
            position: fixed;
            top: 15px;
            left: 260px;
            z-index: 1000;
        }

        .sidebar-collapsed {
            margin-left: -250px;
        }

        .content {
            margin-left: 270px;
            padding: 20px;
            width: 100%;
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            #sidebar {
                margin-left: -250px;
            }

            #sidebar.active {
                margin-left: 0;
            }

            .content {
                margin-left: 0;
            }

            .btn-toggle {
                left: 20px;
            }
        }
    </style>
</head>
<body>

<div id="sidebar">
    <h4>EMP Recruit</h4>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link " href="home.php"><i class="fas fa-home"></i> Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="view_candidates.php"><i class="fas fa-user-edit"></i> Candidate</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="view_post.php"><i class="fas fa-users"></i> Post</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="view_reports.php"><i class="fas fa-users"></i> Report</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../auth/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
    </ul>
</div>

<button class="btn btn-outline-secondary btn-sm btn-toggle" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
</button>

<div class="content">
    <div class="container-fluid mt-4">
        <div class="mb-3">
            <a href="add_report.php" class="btn btn-primary">Add Candidates</a>
        </div>
        <h3 class="text-success text-center mb-4">Candidate Results Report</h3>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Exam Date</th>
                        <th>Marks</th>
                        <th>Decision</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($result->num_rows > 0) {
                        $counter = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $counter++ . "</td>";
                            echo "<td>" . htmlspecialchars($row['C_firstname']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['C_lastname']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['C_Gender']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['PhoneNumber']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['ExamDate']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['CR_marks']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['CR_decision']) . "</td>";
                            echo "<td>
                                    <a href='edit_result.php?CR_Id=" . $row['CR_Id'] . "' class='me-2'><i class='fa-solid fa-pen-to-square'></i></a>
                                    <a href='delete_result.php?CR_Id=" . $row['CR_Id'] . "'><i class='fa-solid fa-trash text-danger'></i></a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9' class='text-center'>No results found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function toggleSidebar() {
    var sidebar = document.getElementById("sidebar");
    sidebar.classList.toggle("active");
}
</script>

</body>
</html>
