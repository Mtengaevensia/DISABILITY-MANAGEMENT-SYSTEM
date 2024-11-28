<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location:index.php');
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "dmess");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_GET['id'])) {
    die("Beneficiary ID is required.");
}

$beneficiary_id = $_GET['id'];

// Fetch beneficiary details
$sql = "SELECT * FROM beneficiary WHERE bid = $beneficiary_id AND chairperson_id = " . $_SESSION['chairperson_id'];
$query = mysqli_query($conn, $sql);
$beneficiary = mysqli_fetch_assoc($query);

if (!$beneficiary) {
    die("Beneficiary not found or you don't have permission to view this beneficiary.");
}

// Fetch verified donations for the beneficiary
$sql = "SELECT d.*, dr.f_name AS donor_fname, dr.l_name AS donor_lname 
        FROM donation d
        INNER JOIN donor dr ON d.donor_id = dr.donor_id
        WHERE d.bid = $beneficiary_id";
$query = mysqli_query($conn, $sql);
$donations = mysqli_fetch_all($query, MYSQLI_ASSOC);

// Calculate total money donated
$total_money = 0;
foreach ($donations as $donation) {
    $total_money += $donation['amount'];
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beneficiary Donations</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/see-donation.css">
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
               <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="register-beneficiary.php"><i class="fas fa-user-plus"></i> Register Beneficiary</a></li>
                <li><a href="view-beneficiaries.php"><i class="fas fa-users"></i> View Beneficiaries</a></li>
                <li><a href="verify-donations.php"><i class="fas fa-sign-out-alt"></i> Verify Donations</a></li>
                <li><a href="beneficiary-needs.php"><i class="fas fa-notes-medical"></i> Beneficiary Needs</a></li>
                <li><a href="view-donors.php"><i class="fas fa-hand-holding-heart"></i> View Donors</a></li>
                <li><a href="view-donations.php"><i class="fas fa-donate"></i> View Donations</a></li>
                <li><a href="monthly-report.php"  class="active"><i class="fas fa-trophy"></i> Achievements</a></li>
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
            <div class="beneficiary-details">
                <h2>Donations for <?php echo htmlspecialchars($beneficiary['fname']) . ' ' . htmlspecialchars($beneficiary['mname']) . ' ' . htmlspecialchars($beneficiary['lname']); ?></h2>
                <p><strong>Location:</strong> <?php echo htmlspecialchars($beneficiary['location']); ?></p>
                <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($beneficiary['dob']); ?></p>
                <p><strong>Total Money Donated:</strong> $<?php echo number_format($total_money, 2); ?></p>
            </div>
            <div class="donations-list">
                <h3>Verified Donations</h3>
                <table class="table">
                    <tr>
                        <th>S/N</th>
                        <th>Donor Name</th>
                        <th>Amount</th>
                        <th>Material Donation</th>
                        <th>Date</th>
                    </tr>
                    <?php 
                    if (count($donations) > 0) {
                        $count = 0;
                        foreach ($donations as $donation) {
                            $count++;
                    ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo htmlspecialchars($donation['donor_fname']) . ' ' . htmlspecialchars($donation['donor_lname']); ?></td>
                        <td><?php echo htmlspecialchars($donation['amount']); ?></td>
                        <td><?php echo htmlspecialchars($donation['mdonation']); ?></td>
                        <td><?php echo htmlspecialchars($donation['date']); ?></td>
                    </tr>
                    <?php
                        }
                    } else {
                    ?>
                    <tr>
                        <td colspan="5">No donations found for this beneficiary.</td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <div class="back-button">
                <a href="monthly-report.php">Back to Beneficiaries</a>
            </div>
        </div>
    </div>
</body>
</html>
