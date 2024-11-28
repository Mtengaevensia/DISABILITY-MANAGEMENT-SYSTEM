<?php
$conn = mysqli_connect("localhost", "root", "", "dmess");

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);  // Sanitize input
    $deleteSql = "DELETE FROM chairperson WHERE id = $id";
    mysqli_query($conn, $deleteSql);
    header("Location: manage-chairpersons.php");
    exit();
}

$chairpersonsQuery = "SELECT * FROM chairperson";
$chairpersonsResult = mysqli_query($conn, $chairpersonsQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Chairpersons</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/manage-chairperson.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        a:hover{
            opacity: 0.8;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="menu-toggle" onclick="toggleMenu()"><i class="fas fa-bars"></i></div>
    <script>
        function toggleMenu() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('active');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const links = document.querySelectorAll('.sidebar ul li a');
            links.forEach(link => {
                link.addEventListener('click', () => {
                    const sidebar = document.querySelector('.sidebar');
                    sidebar.classList.remove('active');
                });
            });
        });
    </script>
    <div class="sidebar">
        <div class="logo">
            <img src="pictures/wheelchair.png" alt="Logo">
        </div>
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="admin.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="manage-chairperson.php" class="active"><i class="fas fa-user-cog"></i> Manage Chairpersons</a></li>
            <li><a href="manage-idkeys.php"><i class="fas fa-hand-holding-heart"></i> Manage IDs</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="top-header">
            <div class="welcome-message">
                <h1>Welcome Back, <strong>Admin</strong></h1>
            </div>
            <div class="profile">
                <div class="profile-rectangle">
                    <div class="profile-initials">
                        AD
                    </div>
                    <div class="profile-info">
                        <p>ID: ADMIN</span></p>
                    </div>
                </div>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($chairpersonsResult)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['idkey']); ?></td>
                        <td><?php echo htmlspecialchars($row['fname']); ?></td>
                        <td><?php echo htmlspecialchars($row['lname']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td>
                            <a href="edit-chairperson.php?idkey=<?php echo htmlspecialchars($row['idkey']); ?>" class="edit-btn">Edit</a>
                            <a style="background-color: red" href="edit-chairpersons.php?action=delete&idkey=<?php echo htmlspecialchars($row['idkey']); ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this chairperson?');">Delete</a>
                        
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
