<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register beneficiary</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/register-beneficiaries.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="menu.js"></script>
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
                <li><a href="register-beneficiary.php" class="active"><i class="fas fa-user-plus"></i> Register Beneficiary</a></li>
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
            <div class="form-container">
                <center><p style="color: #007bff;"><u><b>REGISTER BENEFICIARIES</b></u></p></center>
                <form method="POST" action="register-beneficiary-action.php" enctype="multipart/form-data">
                    <div class="fields">
                        <div class="input-field">
                            <label for="fname">FIRSTNAME</label>
                            <input type="text" name="fname" autofocus required>
                        </div>
                        <div class="input-field">
                            <label for="mname">MIDDLENAME</label>
                            <input type="text" name="mname" required>
                        </div>
                        <div class="input-field">
                            <label for="lname">LASTNAME</label>
                            <input type="text" name="lname" required>
                        </div>
                        <div class="input-field">
                            <label for="dob">DATE OF BIRTH</label>
                            <input type="date" name="dob" required>
                        </div>
                        <div class="input-field">
                            <label for="location">PHYSICAL ADDRESS</label>
                            <input type="text" name="loc" required>
                        </div>
                        <div class="input-field">
                            <label for="gender">GENDER</label>
                            <select name="gender" required>
                                <option disabled selected></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label for="dtype">DISABILITY TYPE</label>
                            <select name="dtype" required>
                                <option disabled selected hidden>Choose Disability Type</option>
                                <?php
                                $conn = mysqli_connect("localhost", "root", "", "dmess");
                                $sql = "SELECT * FROM distype";
                                $query = mysqli_query($conn, $sql);
                                if ($query) {
                                    if (mysqli_num_rows($query) > 0) {
                                        while ($row = mysqli_fetch_assoc($query)) {
                                            echo "<option value='" . $row['distype_id'] . "'>" . $row['disname'] . "</option>";
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="input-field">
                            <label for="desc">DESCRIPTION</label>
                            <textarea name="description" required placeholder="Explain the need NOT MORE THAN 250 WORDS"></textarea>
                        </div>
                        <div class="input-field">
                            <label for="video">UPLOAD VIDEO</label>
                            <input type="file" name="file" required>
                        </div>
                        <div class="input-field">
                            <label for="pno">PHONE NUMBER</label>
                            <input type="text" name="pno" required>
                        </div>
                        <div class="input-field">
                            <input type="hidden" name="chairperson_id" value="<?php echo $_SESSION['chairperson_id']; ?>">
                        </div>
                        <div class="input-field">
                            <input type="submit" name="submit" value="REGISTER">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
