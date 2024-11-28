<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "dmess");

// Fetch counts for summary statistics
$beneficiaryCountQuery = "SELECT COUNT(*) as count FROM beneficiary";
$beneficiaryCountResult = mysqli_query($conn, $beneficiaryCountQuery);
$beneficiaryCount = mysqli_fetch_assoc($beneficiaryCountResult)['count'];

$userCountQuery = "SELECT COUNT(*) as count FROM users";
$userCountResult = mysqli_query($conn, $userCountQuery);
$userCount = mysqli_fetch_assoc($userCountResult)['count'];

$donorCountQuery = "SELECT COUNT(*) as count FROM donor";
$donorCountResult = mysqli_query($conn, $donorCountQuery);
$donorCount = mysqli_fetch_assoc($donorCountResult)['count'];

$donationCountQuery = "SELECT COUNT(*) as count FROM donation";
$donationCountResult = mysqli_query($conn, $donationCountQuery);
$donationCount = mysqli_fetch_assoc($donationCountResult)['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="menu.js" defer></script>
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
            <li><a href="admin.php" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="manage-chairperson.php"><i class="fas fa-user-cog"></i> Manage Chairpersons</a></li>
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
        <div class="cards1">
            <div class="card">
                <h3>Total Beneficiaries</h3>
                <p><?php echo $beneficiaryCount; ?></p>
            </div>
            <div class="card">
                <h3>Total Users</h3>
                <p><?php echo $userCount; ?></p>
            </div>
            <div class="card">
                <h3>Total Donors</h3>
                <p><?php echo $donorCount; ?></p>
            </div>
            <div class="card">
                <h3>Total Donations</h3>
                <p><?php echo $donationCount; ?></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
