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

if (isset($_POST['submit'])) {
    $amount = isset($_POST['amount']) && !empty($_POST['amount']) ? $_POST['amount'] : "NULL";
    $mdonation = isset($_POST['mdonation']) && !empty($_POST['mdonation']) ? "'" . mysqli_real_escape_string($conn, $_POST['mdonation']) . "'" : "NULL";
    $donor_id = isset($_POST['donor_id']) ? $_POST['donor_id'] : null;
    $bid = isset($_POST['bid']) ? $_POST['bid'] : null;

    if ($donor_id && $bid) {
        $sql = "INSERT INTO pending_donations (donor_id, bid, amount, mdonation, date) VALUES ($donor_id, $bid, $amount, $mdonation, NOW())";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo "<script>
                alert('THANK YOU! YOUR DONATION IS PENDING VERIFICATION');
                window.location.href='donate.php';
            </script>";
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "<script>
            alert('DONOR AND BENEFICIARY IDS ARE REQUIRED');
            window.location.href='donate.php';
        </script>";
    }
}

mysqli_close($conn);
?>
