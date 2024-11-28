<?php
session_start();
if (!isset($_SESSION['e_mail'])) {
    header('location: index.php');
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "dmess");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$donor_id = $_SESSION['donor_id'];

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $location = $_POST['location'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $updateQuery = "UPDATE donor SET f_name='$fname', l_name='$lname', phone='$phone', e_mail='$email', password='$password' WHERE donor_id='$donor_id'";
    
    if (mysqli_query($conn, $updateQuery)) {
        $_SESSION['f_name'] = $fname;
        $_SESSION['l_name'] = $lname;
        $_SESSION['e_mail'] = $email;
        echo "<script>
                alert('Account updated successfully');
                window.location.href='manage-account.php';
              </script>";
    } else {
        echo "<script>
                alert('Error updating account');
                window.location.href='manage-account.php';
              </script>";
    }
}

$query = "SELECT * FROM donor WHERE donor_id='$donor_id'";
$result = mysqli_query($conn, $query);
$donor = mysqli_fetch_assoc($result);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Account</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/chair-register.css">
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
             <li><a href="donor.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="beneficiaries.php"><i class="fas fa-users"></i> Beneficiaries</a></li>
            <li><a href="donate.php"><i class="fas fa-donate"></i> Donate</a></li>
            <li><a href="donation-history.php"><i class="fas fa-history"></i> Donation History</a></li>
            <li><a href="manage-account.php" class="active"><i class="fas fa-user-cog"></i> Manage Account</a></li>
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
        <div class="form-container">
            <form action="manage-account.php" method="POST">
                <div class="row">
                    <div class="input-field">
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" value="<?php echo htmlspecialchars($donor['f_name']); ?>" required>
                    </div>
                    <div class="input-field">
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" value="<?php echo htmlspecialchars($donor['l_name']); ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field">
                        <label for="phone">Phone Number</label>
                        <input type="text" name="phone" value="<?php echo htmlspecialchars($donor['phone']); ?>" required>
                    </div>
                    <div class="input-field">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($donor['e_mail']); ?>" required>
                    </div>
                    <div class="input-field">
                        <label for="password">Password</label>
                        <input type="password" name="password" value="<?php echo htmlspecialchars($donor['password']); ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field">
                        <input type="submit" name="submit" value="Update Account">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
