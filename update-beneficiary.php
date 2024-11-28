<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location: index.php');
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "dmess");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$beneficiary = []; // Initialize beneficiary array

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $beneficiary_id = $_GET['id'];
    $sql = "SELECT * FROM beneficiary WHERE bid = '$beneficiary_id'";
    $query = mysqli_query($conn, $sql);

    $sql_distypes = "SELECT * FROM distype";
    $query_distypes = mysqli_query($conn, $sql_distypes);
    if (!$query_distypes) {
        die("user Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($query) > 0) {
        $beneficiary = mysqli_fetch_assoc($query);
    } else {
        echo "<script>alert('Beneficiary not found'); window.location.href='view-beneficiaries.php';</script>";
        exit();
    }

    if (isset($_POST['update'])) {
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $loc = $_POST['loc'];
        $pno = $_POST['pno'];
        $distype_id = $_POST['distype_id'];
        $description = $_POST['description'];

        $file_name = $_FILES['file']['name'];
        $tempname = $_FILES['file']['tmp_name'];
        $folder = "videos/" . $file_name;

        if (!empty($file_name)) {
            move_uploaded_file($tempname, $folder);
            $sql = "UPDATE beneficiary SET fname='$fname', mname='$mname', lname='$lname', dob='$dob', location='$loc', gender='$gender', distype_id='$distype_id', description='$description', file_name='$file_name', phone='$pno' WHERE bid='$beneficiary_id'";
        } else {
            $sql = "UPDATE beneficiary SET fname='$fname', mname='$mname', lname='$lname', dob='$dob', location='$loc', gender='$gender', distype_id='$distype_id', description='$description', phone='$pno' WHERE bid='$beneficiary_id'";
        }

        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo "<script>alert('Update successful'); window.location.href='view-beneficiaries.php';</script>";
        } else {
            echo "<script>alert('Something went wrong, try again'); window.location.href='update-beneficiary.php?id=$beneficiary_id';</script>";
        }
    }
} else {
    echo "<script>alert('No beneficiary ID provided'); window.location.href='view-beneficiaries.php';</script>";
    exit();
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Beneficiary</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/register-beneficiaries.css">
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
                <li><a href="view-beneficiaries.php" class="active"><i class="fas fa-users"></i> View Beneficiaries</a></li>
                <li><a href="view-donors.php"><i class="fas fa-hand-holding-heart"></i> View Donors</a></li>
                <li><a href="view-donations.php"><i class="fas fa-donate"></i> View Donations</a></li>
                <li><a href="monthly-report.php"><i class="fas fa-trophy"></i> Achievements</a></li>
                <li><a href="beneficiary-needs.php"><i class="fas fa-notes-medical"></i> Beneficiary Needs</a></li>
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
                <center><p style="color: #007bff;"><u><b>UPDATE BENEFICIARY</b></u></p></center>
                
                <form method="POST" action="update-beneficiary.php?id=<?php echo $beneficiary_id; ?>" enctype="multipart/form-data">
                    <div class="fields">
                        <div class="input-field">
                            <label for="fname">FIRSTNAME</label>
                            <input type="text" name="fname" value="<?php echo isset($beneficiary['fname']) ? $beneficiary['fname'] : ''; ?>" required>
                        </div>
                        <div class="input-field">
                            <label for="mname">MIDDLENAME</label>
                            <input type="text" name="mname" value="<?php echo isset($beneficiary['mname']) ? $beneficiary['mname'] : ''; ?>" required>
                        </div>
                        <div class="input-field">
                            <label for="lname">LASTNAME</label>
                            <input type="text" name="lname" value="<?php echo isset($beneficiary['lname']) ? $beneficiary['lname'] : ''; ?>" required>
                        </div>
                        <div class="input-field">
                            <label for="dob">DATE OF BIRTH</label>
                            <input type="date" name="dob" value="<?php echo isset($beneficiary['dob']) ? $beneficiary['dob'] : ''; ?>" required>
                        </div>
                        <div class="input-field">
                            <label for="location">PHYSICAL ADDRESS</label>
                            <input type="text" name="loc" value="<?php echo isset($beneficiary['location']) ? $beneficiary['location'] : ''; ?>" required>
                        </div>
                        <div class="input-field">
                            <label for="gender">GENDER</label>
                            <select name="gender" required>
                                <option value="female" <?php echo isset($beneficiary['gender']) && $beneficiary['gender'] == 'female' ? 'selected' : ''; ?>>Female</option>
                                <option value="male" <?php echo isset($beneficiary['gender']) && $beneficiary['gender'] == 'male' ? 'selected' : ''; ?>>Male</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label for="desc">DESCRIPTION</label>
                            <textarea name="description" required><?php echo isset($beneficiary['description']) ? $beneficiary['description'] : ''; ?></textarea>
                        </div>
                        <div class="input-field">
                            <label for="pno">PHONE NUMBER</label>
                            <input type="text" name="pno" value="<?php echo isset($beneficiary['phone']) ? $beneficiary['phone'] : ''; ?>" required>
                        </div>
                        <div class="input-field">
                            <label for="distype">DISABILITY TYPE</label>
                            <select name="distype_id" required>
                                <?php 
                                while ($row = mysqli_fetch_assoc($query_distypes)): ?>
                                    <option value="<?php echo $row['distype_id']; ?>" <?php echo isset($beneficiary['distype_id']) && $beneficiary['distype_id'] == $row['distype_id'] ? 'selected' : ''; ?>><?php echo $row['disname']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="input-field">
                            <label for="file">VIDEO</label>
                            <input type="file" name="file" accept="video/*">
                        </div>
                    </div>
                    <center><button type="submit" name="update">UPDATE</button></center>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
