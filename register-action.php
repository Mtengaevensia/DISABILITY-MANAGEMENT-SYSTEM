<?php
$conn = mysqli_connect("localhost", "root", "", "dmess");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email already exists in the donor table
    $check_email_query = "SELECT * FROM donor WHERE e_mail='$email'";
    $result = mysqli_query($conn, $check_email_query);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>
                alert('EMAIL ALREADY EXISTS!!');
                window.location.href='index.php';
              </script>";
    } else {
        // Insert into donor table
        $sql_donor = "INSERT INTO donor (f_name, l_name, phone, e_mail, password) VALUES ('$fname', '$lname', '$phone', '$email', '$password')";
        $query_donor = mysqli_query($conn, $sql_donor);

        // Insert into users table with role 'donor'
        $sql_users = "INSERT INTO users (email, password, role) VALUES ('$email', '$password', 'donor')";
        $query_users = mysqli_query($conn, $sql_users);

        if ($query_donor && $query_users) {
            echo "<script>
                    alert('REGISTRATION SUCCESSFUL!!');
                    window.location.href='index.php';
                  </script>";
        } else {
            echo "TRY AGAIN!!!";
        }
    }
}

mysqli_close($conn);
?>
