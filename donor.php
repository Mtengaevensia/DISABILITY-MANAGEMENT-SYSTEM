<?php
session_start();
if (!isset($_SESSION['e_mail'])) {
    header('location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="menu.js" defer></script>
</head>
<body>
<div class="container">
    <div class="sidebar">
        <div class="logo">
            <img src="pictures/wheelchair.png" alt="Logo">
        </div>
        <h2>Dashboard</h2>
        <ul>
            <li><a href="donor.php" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="beneficiaries.php"><i class="fas fa-users"></i> Beneficiaries</a></li>
            <li><a href="donate.php"><i class="fas fa-donate"></i> Donate</a></li>
            <li><a href="donation-history.php"><i class="fas fa-history"></i> Donation History</a></li>
            <li><a href="manage-account.php"><i class="fas fa-user-cog"></i> Manage Account</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="top-header">
            <div class="welcome-message">
                <h1>Welcome Back, <strong><?php echo htmlspecialchars($_SESSION['f_name']); ?></strong></h1>
            </div>
            <div class="profile">
                <div class="profile-rectangle">
                    <div class="profile-initials">
                        <?php echo strtoupper(substr($_SESSION['f_name'], 0, 1) . substr($_SESSION['l_name'], 0, 1)); ?>
                    </div>
                    <div class="profile-info">
                        <p>Email: <span><?php echo htmlspecialchars($_SESSION['e_mail']); ?></span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="cards">
            <div class="card">
    <h3><i class="fas fa-users"></i> Total Beneficiaries</h3>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "dmess");
    $sql = "SELECT COUNT(*) AS total_beneficiary FROM beneficiary";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
    ?>
    <p><?php echo $row['total_beneficiary']; ?></p>
</div>
<div class="card">
    <h3><i class="fas fa-hand-holding-heart"></i> Total Donors</h3>
    <?php
    $sql = "SELECT COUNT(*) AS total_donor FROM donor";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
    ?>
    <p><?php echo $row['total_donor']; ?></p>
</div>
<div class="card">
    <h3><i class="fas fa-donate"></i> Your Donations</h3>
    <?php
    $donor_id = $_SESSION['donor_id']; 
    $sql = "SELECT COUNT(*) AS total_donation FROM donation WHERE donor_id = $donor_id";
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
