<?php
session_start();
if (!isset($_SESSION['e_mail'])) {
    header('location: index.php');
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "dmess");

// Pagination settings
$limit = 5; // Number of entries to show in a page.
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$start_from = ($page - 1) * $limit;

// Search functionality
$search = isset($_GET['search']) ? $_GET['search'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beneficiaries</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/beneficiary.css">
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
             <li><a href="donor.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="beneficiaries.php" class="active"><i class="fas fa-users"></i> Beneficiaries</a></li>
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
        <div class="search-section">
            <h3>Beneficiaries</h3>
            <form action="beneficiaries.php" method="get">
                <input type="text" name="search" placeholder="Search by type of disability" value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type of Disability</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT b.bid, b.fname, b.lname, d.disname 
                        FROM beneficiary b
                        JOIN distype d ON b.distype_id = d.distype_id
                        WHERE b.fname LIKE '%$search%' 
                           OR b.lname LIKE '%$search%' 
                           OR d.disname LIKE '%$search%'
                        LIMIT $start_from, $limit";
                $query = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($query)) {
                    echo "<tr>
                            <td>{$row['fname']} {$row['lname']}</td>
                            <td>{$row['disname']}</td>
                            <td><a href='beneficiary-details.php?bid={$row['bid']}'>View Details</a></td>
                          </tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="pagination">
            <?php
            $sql = "SELECT COUNT(*) FROM beneficiary b
                    JOIN distype d ON b.distype_id = d.distype_id
                    WHERE b.fname LIKE '%$search%' 
                       OR b.lname LIKE '%$search%' 
                       OR d.disname LIKE '%$search%'";
            $query = mysqli_query($conn, $sql);
            $row = mysqli_fetch_row($query);
            $total_records = $row[0];
            $total_pages = ceil($total_records / $limit);
            
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<a href='beneficiaries.php?page=".$i."&search=".$search."'";
                if ($i == $page) echo " class='active'";
                echo ">$i</a> ";
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
