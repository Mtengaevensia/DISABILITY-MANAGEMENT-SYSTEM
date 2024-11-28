<?php

$conn = mysqli_connect("localhost", "root", "", "dmess");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $loc = $_POST['location'];
    $pno = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $idkey = $_POST['idkey'];

    // Check if ID key is valid
    $check_idkey = "SELECT * FROM chair_idkey WHERE idkey = '$idkey'";
    $query_idkey = mysqli_query($conn, $check_idkey);

    if (mysqli_num_rows($query_idkey) == 0) {
        echo "<script>
                alert('INVALID ID!! CHECK YOUR ID AND TRY AGAIN');
                window.location.href='chair-register.php';
              </script>";
    } else {
        // Check if email already exists
        $check_email = "SELECT * FROM chairperson WHERE email = '$email'";
        $query_email = mysqli_query($conn, $check_email);

        if (mysqli_num_rows($query_email) > 0) {
            echo "<script>
                    alert('EMAIL ALREADY EXISTS!!');
                    window.location.href='chair-register.php';
                  </script>";
        } else {
            // Check if ID key is already used
            $check_idkey_unique = "SELECT * FROM chairperson WHERE idkey = '$idkey'";
            $query_idkey_unique = mysqli_query($conn, $check_idkey_unique);

            if (mysqli_num_rows($query_idkey_unique) > 0) {
                echo "<script>
                        alert('IDENTITY KEY ALREADY USED!! PLEASE CONTACT YOUR ADMIN');
                        window.location.href='chair-register.php';
                      </script>";
            } else {
                // Insert into chairperson table
                $sql = "INSERT INTO chairperson (fname, mname, lname, gender, dob, location, phone, email, password, idkey) 
                        VALUES ('$fname', '$mname', '$lname', '$gender', '$dob', '$loc', '$pno', '$email', '$password', '$idkey')";
                
                $query = mysqli_query($conn, $sql);

                // Insert into users table with role 'chairperson'
                $sql_users = "INSERT INTO users (email, password, role) VALUES ('$email', '$password', 'chairperson')";
                $query_users = mysqli_query($conn, $sql_users);

                if ($query && $query_users) {
                    echo "<script>
                            alert('YOU HAVE REGISTERED SUCCESSFULLY');
                            window.location.href='index.php';
                          </script>";
                } else {
                    echo "<script>
                            alert('TRY AGAIN!!!');
                            window.location.href='chair-register.php';
                          </script>";
                }
            }
        }
    }
}

mysqli_close($conn);
?>
