<?php
$conn = mysqli_connect("localhost", "root", "", "dmess");

// Handle add action
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idkey'])) {
    $idkey = mysqli_real_escape_string($conn, $_POST['idkey']);
    $insertSql = "INSERT INTO chair_idkey (idkey) VALUES ('$idkey')";
    mysqli_query($conn, $insertSql);
    header("Location: manage-idkeys.php");
    exit();
}

$idkeysQuery = "SELECT * FROM chair_idkey";
$idkeysResult = mysqli_query($conn, $idkeysQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage ID Keys</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/manage-idkey.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

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
            <li><a href="manage-chairperson.php"><i class="fas fa-user-cog"></i> Manage Chairpersons</a></li>
            <li><a href="manage-idkeys.php" class="active"><i class="fas fa-hand-holding-heart"></i> Manage IDs</a></li>
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
        <form class="add-idkey-form" action="manage-idkeys.php" method="post">
            <input type="text" name="idkey" placeholder="Enter new ID Key" required>
            <input type="submit" value="Add ID Key">
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID Key</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($idkeysResult)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['idkey']); ?></td>
                        <td>
                            <a href="manage-idkeys.php?action=delete&id=<?php echo htmlspecialchars($row['idkey']); ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this ID Key?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
