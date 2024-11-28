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

$results_per_page = 5;  // Number of beneficiaries per page

// Determine the total number of beneficiaries
$sql = "SELECT COUNT(*) AS total FROM beneficiary WHERE chairperson_id = " . $_SESSION['chairperson_id'];
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);
$total_beneficiaries = $row['total'];

// Determine the number of pages needed
$total_pages = ceil($total_beneficiaries / $results_per_page);

// Determine which page number visitor is currently on
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

// Determine the starting limit number
$starting_limit_number = ($page - 1) * $results_per_page;

// Retrieve the beneficiaries for the current page
$sql = "SELECT b.*, d.disname 
        FROM beneficiary b
        INNER JOIN distype d ON b.distype_id = d.distype_id
        WHERE b.chairperson_id = " . $_SESSION['chairperson_id'] . "
        LIMIT " . $starting_limit_number . "," . $results_per_page;
$query = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chairperson Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/see-donation.css">
    <link rel="stylesheet" href="css/view-beneficiaries.css">
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
            <center><p style="color: #007bff;"><b><u>BENEFICIARIES</u></b></p></center>
            <div class="cards1">
                <table class="table">
                    <tr>
                        <th>S/N</th>
                        <th class="beneficiary">Name</th>
                        <th class="disability">Disability</th>
                        <th class="disability">Location</th>
                        <th class="date">Date of Birth</th>
                        <th>See Donations</th>
                    </tr>
                    <?php 
                    $beneficiaries = [];
                    if(mysqli_num_rows($query) > 0){
                        $count = $starting_limit_number;
                        while($rows = mysqli_fetch_array($query)){
                            $count++;
                            $beneficiaries[] = $rows;
                    ?>
                    <tr class="beneficiary-row">
                        <td><?php echo $count;?></td>
                        <td class="beneficiary"><?php echo htmlspecialchars($rows['fname']) . ' ' . htmlspecialchars($rows['mname']) . ' ' . htmlspecialchars($rows['lname']); ?></td>
                        <td class="disability"><?php echo htmlspecialchars($rows['disname']); ?></td>
                        <td class="description"><?php echo htmlspecialchars($rows['location']); ?></td>
                        <td class="date"><?php echo htmlspecialchars($rows['dob']); ?></td>
                        <td>
                            <a class="update-button" href="see-donation.php?id=<?php echo $rows['bid']; ?>">See Donations</a>
                        </td>
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
                    echo '<a href="monthly-report.php?page=' . $page_number . '" class="' . ($page_number == $page ? 'active' : '') . '">' . $page_number . '</a>';
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
