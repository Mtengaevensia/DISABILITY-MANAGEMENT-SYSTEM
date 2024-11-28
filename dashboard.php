<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <img src="pictures/wheelchair.png" alt="Logo">
            </div>
            <h2>Dashboard</h2>
            <ul>
                <li><a href="dashboard.php"  class="active"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="register-beneficiary.php"><i class="fas fa-user-plus"></i> Register Beneficiary</a></li>
                <li><a href="view-beneficiaries.php"><i class="fas fa-users"></i> View Beneficiaries</a></li>
                <li><a href="verify-donations.php"><i class="fas fa-sign-out-alt"></i> Verify Donations</a></li>
                <li><a href="beneficiary-needs.php"><i class="fas fa-notes-medical"></i> Beneficiary Needs</a></li>
                <li><a href="view-donors.php"><i class="fas fa-hand-holding-heart"></i> View Donors</a></li>
                <li><a href="view-donations.php"><i class="fas fa-donate"></i> View Donations</a></li>
                <li><a href="monthly-report.php"><i class="fas fa-trophy"></i> Achievements</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="top-header">
                <div class="welcome-message">
                    <h1>Welcome Back, <strong><?php echo $_SESSION['fname']; ?></strong></h1>
                </div>
                <div class="profile">
                    <div class="profile-rectangle">
                        <div class="profile-initials">
                            <?php echo strtoupper(substr($_SESSION['fname'], 0, 1) . substr($_SESSION['lname'], 0, 1)); ?>
                        </div>
                        <div class="profile-info">
                            <p>ID: <span><?php echo $_SESSION['idkey']; ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cards">
                <div class="card">
                    <div class="icon"><i class="fas fa-users"></i></div>
                    <h3>Total Beneficiary</h3>
                    <?php
                    $conn = new mysqli("localhost", "root", "", "dmess");
                    $sql = "SELECT COUNT(*) AS total_beneficiary FROM beneficiary WHERE chairperson_id = " . $_SESSION['chairperson_id'];
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($query);
                    ?>
                    <p><?php echo $row['total_beneficiary']; ?></p>
                </div>
                <div class="card">
                    <div class="icon"><i class="fas fa-hand-holding-heart"></i></div>
                    <h3>Total Donor</h3>
                    <?php
                    $sql = "SELECT COUNT(*) AS total_donor FROM donor";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($query);
                    ?>
                    <p><?php echo $row['total_donor']; ?></p>
                </div>
                <div class="card">
                    <div class="icon"><i class="fas fa-donate"></i></div>
                    <h3>Total Donation</h3>
                    <?php
                    $sql = "SELECT COUNT(*) AS total_donation 
                            FROM donation d
                            JOIN beneficiary b ON d.bid = b.bid
                            WHERE b.chairperson_id = " . $_SESSION['chairperson_id'];
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($query);
                    ?>
                    <p><?php echo $row['total_donation'] ? $row['total_donation'] : 0; ?></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
