<?php
$conn = mysqli_connect("localhost", "root", "", "dmess");

// Get the chairperson details
if (isset($_GET['idkey'])) {
    $idkey = $_GET['idkey'];
    $chairpersonQuery = "SELECT * FROM chairperson WHERE idkey = '$idkey'";
    $chairpersonResult = mysqli_query($conn, $chairpersonQuery);
    $chairperson = mysqli_fetch_assoc($chairpersonResult);
}

// Handle the form submission for updating chairperson details
if (isset($_POST['update'])) {
    $idkey = $_POST['idkey'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $location = $_POST['location'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    
    $updateSql = "UPDATE chairperson SET fname='$fname', mname='$mname', lname='$lname', gender='$gender', dob='$dob', location='$location', phone='$phone', email='$email' WHERE idkey='$idkey'";
   $query = mysqli_query($conn, $updateSql);
    
    if($query){
        echo "<script> alert('YOU UPDATED SUCCESSFULLY!!'); window.location.href='manage-chairperson.php'; </script>";
    
    }
    else{
        echo "<script> alert('OOOPS SOMETHING WENT WRONG!!'); window.location.href='edit-chairperson.php';</script>";
    }
    
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Chairperson</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/edit-chairperson.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
</head>
<body>
<div class="container">
    <div class="menu-toggle" onclick="toggleMenu()"><i class="fas fa-bars"></i></div>
    <script>
        function toggleMenu() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('active');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const links = document.querySelectorAll('.sidebar ul li a');
            links.forEach(link => {
                link.addEventListener('click', () => {
                    const sidebar = document.querySelector('.sidebar');
                    sidebar.classList.remove('active');
                });
            });
        });
    </script>
    <div class="sidebar">
        <div class="logo">
            <img src="pictures/wheelchair.png" alt="Logo">
        </div>
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="admin.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="manage-chairperson.php" class="active"><i class="fas fa-user-cog"></i> Manage Chairpersons</a></li>
            <li><a href="manage-idkeys.php"><i class="fas fa-hand-holding-heart"></i> Manage IDs</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="top-header">
            <div class="welcome-message">
                <h1>Welcome Back, <strong>Admin</strong></h1>
            </div>
            <div class="profile">
                <div class="profile-rectangle">
                    <div class="profile-initials">
                        AD
                    </div>
                    <div class="profile-info">
                        <p>ID: ADMIN</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-container">
            <h2>Edit Chairperson</h2>
            <form action="edit-chairperson.php" method="post">
                <input type="hidden" name="idkey" value="<?php echo htmlspecialchars($chairperson['idkey']); ?>">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="fname">First Name:</label>
                        <input type="text" id="fname" name="fname" value="<?php echo htmlspecialchars($chairperson['fname']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="mname">Middle Name:</label>
                        <input type="text" id="mname" name="mname" value="<?php echo htmlspecialchars($chairperson['mname']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name:</label>
                        <input type="text" id="lname" name="lname" value="<?php echo htmlspecialchars($chairperson['lname']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <select id="gender" name="gender" required>
                            <option value="male" <?php echo $chairperson['gender'] == 'male' ? 'selected' : ''; ?>>Male</option>
                            <option value="female" <?php echo $chairperson['gender'] == 'female' ? 'selected' : ''; ?>>Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($chairperson['dob']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="location">Location:</label>
                        <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($chairperson['location']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($chairperson['phone']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($chairperson['email']); ?>" required>
                    </div>
                </div>
                <button type="submit" name="update" class="btn">Update Chairperson</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>