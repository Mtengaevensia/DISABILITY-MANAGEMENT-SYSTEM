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
    <title>Donation History</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/donation-histor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="menu.js" defer></script>
</head>
<body>
<div class="container">
    <div class="menu-toggle" onclick="toggleMenu()"><i class="fas fa-bars"></i></div>
    <div class="sidebar">
        <div class="logo">
            <img src="pictures/wheelchair.png" alt="Logo">
        </div>
        <h2>Dashboard</h2>
        <ul>
            <li><a href="donor.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="beneficiaries.php"><i class="fas fa-users"></i> Beneficiaries</a></li>
            <li><a href="donate.php"><i class="fas fa-donate"></i> Donate</a></li>
            <li><a href="donation-history.php" class="active"><i class="fas fa-history"></i> Donation History</a></li>
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
        <h3><u>Donation History</u></h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Beneficiary</th>
                        <th>Material donated</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $conn = mysqli_connect("localhost", "root", "", "dmess");
                $donor_id = $_SESSION['donor_id']; // Assume donor_id is stored in the session during login
                $sql = "SELECT donation.date, donation.amount, beneficiary.fname, beneficiary.lname, donation.mdonation 
                        FROM donation 
                        JOIN beneficiary ON donation.bid = beneficiary.bid 
                        WHERE donation.donor_id = $donor_id";
                $query = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($query)) {
                    echo "<tr>
                            <td>{$row['date']}</td>
                            <td>{$row['amount']}</td>
                            <td>{$row['fname']} {$row['lname']}</td>
                            <td>{$row['mdonation']}</td>
                          </tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
