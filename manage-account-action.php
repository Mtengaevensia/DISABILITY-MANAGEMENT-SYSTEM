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
