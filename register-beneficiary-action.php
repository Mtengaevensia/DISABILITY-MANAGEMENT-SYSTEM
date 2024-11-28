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

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $loc = $_POST['loc'];
    $pno = $_POST['pno'];
    $dtype = $_POST['dtype']; // distype_id
    $description = $_POST['description'];
    $chairperson = $_POST['chairperson_id']; // chairperson_id

    $file_name = $_FILES['file']['name'];
    $tempname = $_FILES['file']['tmp_name'];
    $folder = "videos/" . $file_name;

    // Verify chairperson_id exists in chairperson table
    $chairperson_check = "SELECT * FROM chairperson WHERE chairperson_id = '$chairperson'";
    $chairperson_result = mysqli_query($conn, $chairperson_check);

    if (mysqli_num_rows($chairperson_result) > 0) {
        // Move the uploaded file
        if (move_uploaded_file($tempname, $folder)) {
            // Start transaction
            mysqli_begin_transaction($conn);
            $success = true;

            // Insert data into the beneficiary table
            $sql_beneficiary = "INSERT INTO beneficiary (fname, mname, lname, dob, location, gender, distype_id, description, file_name, phone, chairperson_id)
                    VALUES ('$fname', '$mname', '$lname', '$dob', '$loc', '$gender', '$dtype', '$description', '$file_name', '$pno', '$chairperson')";

            $query_beneficiary = mysqli_query($conn, $sql_beneficiary);
            if (!$query_beneficiary) {
                $success = false;
            } else {
                // Get the last inserted id
                $beneficiary_id = mysqli_insert_id($conn);

                // Insert data into the stories table
                $sql_stories = "INSERT INTO stories (deC1, file_name1, bid)
                        VALUES ('$description', '$file_name', '$beneficiary_id')";

                $query_stories = mysqli_query($conn, $sql_stories);
                if (!$query_stories) {
                    $success = false;
                }
            }

            if ($success) {
                // Commit transaction
                mysqli_commit($conn);
                echo "<script> alert('REGISTRATION SUCCESSFUL!!'); window.location.href='register-beneficiary.php'; </script>";
            } else {
                // Rollback transaction
                mysqli_rollback($conn);
                echo "<script> alert('SOMETHING WENT WRONG, TRY AGAIN!!'); window.location.href='register-beneficiary.php'; </script>";
            }
        } else {
            echo "<script> alert('FAILED TO UPLOAD FILE'); window.location.href='register-beneficiary.php'; </script>";
        }
    } else {
        echo "<script> alert('INVALID CHAIRPERSON ID'); window.location.href='register-beneficiary.php'; </script>";
    }
}

mysqli_close($conn);
?>
