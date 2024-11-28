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

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $beneficiary_id = $_GET['id'];
    
    // Fetch beneficiary details
    $sql = "SELECT * FROM beneficiary WHERE bid = '$beneficiary_id'";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        $beneficiary = mysqli_fetch_assoc($query);

        // Perform deletion
        $delete_sql = "DELETE FROM beneficiary WHERE bid = '$beneficiary_id'";
        $delete_query = mysqli_query($conn, $delete_sql);

        if ($delete_query) {
            echo "<script>alert('Beneficiary deleted successfully'); window.location.href='view-beneficiaries.php';</script>";
            exit();
        } else {
            echo "<script>alert('Failed to delete beneficiary'); window.location.href='view-beneficiaries.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Beneficiary not found'); window.location.href='view-beneficiaries.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('No beneficiary ID provided'); window.location.href='view-beneficiaries.php';</script>";
    exit();
}

mysqli_close($conn);
?>
