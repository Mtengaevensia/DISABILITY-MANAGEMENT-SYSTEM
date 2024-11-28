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

// Determine the total number of beneficiaries registered by the current chairperson
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

// Retrieve the beneficiary data for the current page registered by the current chairperson
$sql = "SELECT b.fname, b.mname, b.lname, d.disname, b.description, b.file_name 
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
    <link rel="stylesheet" href="css/beneficiary-needs.css">
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
                <li><a href="beneficiary-needs.php" class="active"><i class="fas fa-notes-medical"></i> Beneficiary Needs</a></li>
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
            <div class="content">
                <div class="cards1">
                    <center><p style="color: #007bff;"><b><u>BENEFICIARY NEEDS</u></b></p></center>
                    <table class="table">
                        <tr>
                            <th>S/N</th>
                            <th>Beneficiary Name</th>
                            <th>Disability Type</th>
                            <th>Description</th>
                            <th>Watch Video</th>
                        </tr>
                        <?php 
                        if(mysqli_num_rows($query) > 0){
                            $count = $starting_limit_number;
                            while($rows = mysqli_fetch_array($query)){
                                $count++;
                        ?>
                        <tr>
                            <td><?php echo $count;?></td>
                            <td><?php echo htmlspecialchars($rows['fname']) . ' ' . htmlspecialchars($rows['mname']) . ' ' . htmlspecialchars($rows['lname']); ?></td>
                            <td><?php echo htmlspecialchars($rows['disname']);?></td>
                            <td><?php echo htmlspecialchars($rows['description']);?></td>
                            <td>
                                <button class="watch-button" data-video="videos/<?php echo htmlspecialchars($rows['file_name']); ?>">Watch Video</button>
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
                        echo '<a href="beneficiary-needs.php?page=' . $page_number . '" class="' . ($page_number == $page ? 'active' : '') . '">' . $page_number . '</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <div class="modal-content">
            <video controls id="modal-video">
                <source src="" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // Get the video element inside the modal
        var modalVideo = document.getElementById("modal-video");

        // Get all watch button elements
        var watchButtons = document.getElementsByClassName("watch-button");

        // When the user clicks on a watch button, open the modal and play the video
        Array.from(watchButtons).forEach(function(button) {
            button.onclick = function() {
                modal.style.display = "block";
                modalVideo.src = this.getAttribute("data-video");
                modalVideo.play();
            }
        });

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
            modalVideo.pause();
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
                modalVideo.pause();
            }
        }
    </script>
</body>
</html>
