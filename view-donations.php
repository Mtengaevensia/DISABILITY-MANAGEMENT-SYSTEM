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

$results_per_page = 5;  // Number of donations per page

// Determine the total number of donations for the current chairperson
$sql = "SELECT COUNT(*) AS total 
        FROM donation d
        INNER JOIN beneficiary b ON d.bid = b.bid
        WHERE b.chairperson_id = " . $_SESSION['chairperson_id'];
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);
$total_donations = $row['total'];

// Determine the number of pages needed
$total_pages = ceil($total_donations / $results_per_page);

// Determine which page number visitor is currently on
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

// Determine the starting limit number
$starting_limit_number = ($page - 1) * $results_per_page;

// Retrieve the donation data for the current page for the current chairperson
$sql = "SELECT d.did, d.amount, d.mdonation, d.date,  dr.f_name AS donor_fname, dr.l_name AS donor_lname, b.fname, b.mname, b.lname 
        FROM donation d
        INNER JOIN donor dr ON d.donor_id = dr.donor_id
        INNER JOIN beneficiary b ON d.bid = b.bid
        WHERE b.chairperson_id = " . $_SESSION['chairperson_id'] . "
        LIMIT " . $starting_limit_number . "," . $results_per_page;
$query = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Donations</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/view-donations.css">
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
                <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="register-beneficiary.php"><i class="fas fa-user-plus"></i> Register Beneficiary</a></li>
                <li><a href="view-beneficiaries.php"><i class="fas fa-users"></i> View Beneficiaries</a></li>
                <li><a href="verify-donations.php"><i class="fas fa-sign-out-alt"></i> Verify Donations</a></li>
                <li><a href="beneficiary-needs.php"><i class="fas fa-notes-medical"></i> Beneficiary Needs</a></li>
                <li><a href="view-donors.php"><i class="fas fa-hand-holding-heart"></i> View Donors</a></li>
                <li><a href="view-donations.php" class="active"><i class="fas fa-donate"></i> View Donations</a></li>
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
            <div class="content">
                <div class="cards1">
                    <center><p style="color: #007bff;"><b><u>DONATIONS</u></b></p></center>
                    <table class="table">
                        <tr>
                            <th>S/N</th>
                            <th>Donor Name</th>
                            <th>Beneficiary Name</th>
                            <th>Amount</th>
                            <th>Material Donation</th>
                            <th>Date</th>
                        </tr>
                        <?php 
                        if(mysqli_num_rows($query) > 0){
                            $count = $starting_limit_number;
                            while($rows = mysqli_fetch_array($query)){
                                $count++;
                        ?>
                        <tr>
                            <td><?php echo $count;?></td>
                            <td><?php echo htmlspecialchars($rows['donor_fname']) . ' ' . htmlspecialchars($rows['donor_lname']); ?></td>
                            <td><?php echo htmlspecialchars($rows['fname']) . ' ' . htmlspecialchars($rows['mname']) . ' ' . htmlspecialchars($rows['lname']); ?></td>
                            <td><?php echo htmlspecialchars($rows['amount']);?></td>
                            <td><?php echo htmlspecialchars($rows['mdonation']);?></td>
                            <td><?php echo htmlspecialchars($rows['date']);?></td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </table>
                </div>
                <div class="pagination">
                    <?php
                    for ($page_number = 1; $page_number <= $total_pages; $page_number++) {
                        echo '<a href="view-donations.php?page=' . $page_number . '" class="' . ($page_number == $page ? 'active' : '') . '">' . $page_number . '</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
