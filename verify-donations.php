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

// Fetch all pending donations for verification
$sql = "SELECT pd.*, dr.f_name AS donor_fname, dr.l_name AS donor_lname, b.fname AS beneficiary_fname, b.lname AS beneficiary_lname
        FROM pending_donations pd
        INNER JOIN donor dr ON pd.donor_id = dr.donor_id
        INNER JOIN beneficiary b ON pd.bid = b.bid";
$pending_query = mysqli_query($conn, $sql);
$pending_donations = mysqli_fetch_all($pending_query, MYSQLI_ASSOC);

// Handle verification
if (isset($_POST['verify_id'])) {
    $verify_id = intval($_POST['verify_id']);
    
    // Move donation from pending_donations to donation table
    $sql = "INSERT INTO donation (donor_id, bid, amount, mdonation, date)
            SELECT donor_id, bid, amount, mdonation, date
            FROM pending_donations
            WHERE id = $verify_id";
    $query = mysqli_query($conn, $sql);
    
    if ($query) {
        // Delete from pending_donations
        $delete_sql = "DELETE FROM pending_donations WHERE id = $verify_id";
        mysqli_query($conn, $delete_sql);
        
        echo "<script>
            alert('Donation verified successfully');
            window.location.href='verify-donations.php';
        </script>";
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Donations</title>
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
                <li><a href="verify-donations.php" class="active"><i class="fas fa-sign-out-alt"></i> Verify Donations</a></li>
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
            <div class="pending-donations-list">
                <h3>Pending Donations</h3>
                <table class="table">
                    <tr>
                        <th>S/N</th>
                        <th>Donor Name</th>
                        <th>Beneficiary Name</th>
                        <th>Amount</th>
                        <th>Material Donation</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    <?php 
                    if(count($pending_donations) > 0){
                        $count = 0;
                        foreach($pending_donations as $pending_donation){
                            $count++;
                    ?>
                    <tr>
                        <td><?php echo $count;?></td>
                        <td><?php echo htmlspecialchars($pending_donation['donor_fname']) . ' ' . htmlspecialchars($pending_donation['donor_lname']); ?></td>
                        <td><?php echo htmlspecialchars($pending_donation['beneficiary_fname']) . ' ' . htmlspecialchars($pending_donation['beneficiary_lname']); ?></td>
                        <td>$<?php echo htmlspecialchars($pending_donation['amount']);?></td>
                        <td><?php echo htmlspecialchars($pending_donation['mdonation']);?></td>
                        <td><?php echo htmlspecialchars($pending_donation['date']);?></td>
                        <td>
                            <form action="verify-donations.php" method="post">
                                <input type="hidden" name="verify_id" value="<?php echo $pending_donation['id']; ?>">
                                <button type="submit" class="verify-button">Verify</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                    ?>
                    <tr>
                        <td colspan="7">No pending donations found.</td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
