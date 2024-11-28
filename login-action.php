<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "dmess");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $_POST['email'];
$password = $_POST['password'];

$queryA = "SELECT * FROM chairperson WHERE email = '$email' AND password = '$password'";
$resultA = mysqli_query($conn, $queryA);


$queryB = "SELECT * FROM donor WHERE e_mail = '$email' AND password = '$password'";
$resultB = mysqli_query($conn, $queryB);


if (mysqli_num_rows($resultA) == 1) {
    $rowA = mysqli_fetch_assoc($resultA);
        $_SESSION['fname'] = $rowA['fname'];
        $_SESSION['lname'] = $rowA['lname'];
        $_SESSION['email'] = $rowA['email'];
        $_SESSION['idkey'] = $rowA['idkey'];
        $_SESSION['chairperson_id'] = $rowA['chairperson_id'];


        header("Location: dashboard.php");
        exit;
    }

    elseif (mysqli_num_rows($resultB) == 1) {
    $rowB = mysqli_fetch_assoc($resultB);
        $_SESSION['f_name'] = $rowB['f_name'];
        $_SESSION['l_name'] = $rowB['l_name'];
        $_SESSION['donor_id'] = $rowB['donor_id'];
        $_SESSION['e_mail'] = $rowB['e_mail'];

        header("Location: donor.php");
        exit;
    }
    
     elseif($email == "admin@gmail.com" && $password == "admin"){
        $_SESSION['email'] = $rowA['email'];
            header("location: admin.php");
    }

   else{
     echo "<script>
                alert('WRONG USERNAME OR PASSWORD');
                window.location.href='chair-register.php';
              </script>";
    exit;
   }

mysqli_close($conn);
?>
