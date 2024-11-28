<?php
session_start();
if (!isset($_SESSION['e_mail'])) {
    header('location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beneficiary Details</title>
    <link rel="stylesheet" href="css/beneficiary-details.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<div class="container">
    <div class="header">
        <h2>Beneficiary Details</h2>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['f_name']); ?></p>
    </div>
    <div class="beneficiary-details">
        <?php
        // Database connection
        $conn = mysqli_connect("localhost", "root", "", "dmess");

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Get the beneficiary ID from the URL and sanitize it
        $beneficiary_id = intval($_GET['bid']);

        // Fetch the beneficiary details from the database
        $sql = "SELECT b.fname, b.lname, b.dob, b.gender, b.location, d.disname, b.description, b.file_name
                FROM beneficiary b
                JOIN distype d ON b.distype_id = d.distype_id
                WHERE b.bid = $beneficiary_id";
        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) > 0) {
            $beneficiary = mysqli_fetch_assoc($query);
        } else {
            echo "<p>Beneficiary not found.</p>";
            exit();
        }

        // Fetch the donations for the beneficiary
        $sql_donations = "SELECT amount, mdonation, date, donor_id 
                          FROM donation 
                          WHERE bid = $beneficiary_id";
        $query_donations = mysqli_query($conn, $sql_donations);

        // Calculate the total amount donated
        $total_amount = 0;
        $donations = [];
        while ($donation = mysqli_fetch_assoc($query_donations)) {
            $total_amount += $donation['amount'];
            $donations[] = $donation;
        }
        ?>
        <h3><?php echo htmlspecialchars($beneficiary['fname'] . " " . $beneficiary['lname']); ?></h3>
        <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($beneficiary['dob']); ?></p>
        <p><strong>Gender:</strong> <?php echo htmlspecialchars($beneficiary['gender']); ?></p>
        <p><strong>Location:</strong> <?php echo htmlspecialchars($beneficiary['location']); ?></p>
        <p><strong>Type of Disability:</strong> <?php echo htmlspecialchars($beneficiary['disname']); ?></p>
        <p><strong>Description:</strong> <?php echo htmlspecialchars($beneficiary['description']); ?></p>

        <h3>Video</h3>
        <div class="video-wrapper">
            <video controls>
                <source src="videos/<?php echo htmlspecialchars($beneficiary['file_name']); ?>" type="video/mp4">
                <source src="videos/<?php echo htmlspecialchars($beneficiary['file_name']); ?>" type="video/webm">
                <source src="videos/<?php echo htmlspecialchars($beneficiary['file_name']); ?>" type="video/ogg">
                Your browser does not support the video tag.
            </video>
        </div>

        <div class="table-wrapper">
            <h3 class="table-title">Donations</h3>
            <table class="table">
                <tr>
                    <th>S/N</th>
                    <th>Amount</th>
                    <th>Material Donation</th>
                    <th>Date</th>
                    <th>Donor Name</th>
                </tr>
                <?php
                if (count($donations) > 0) {
                    $count = 0;
                    foreach ($donations as $donation) {
                        $count++;
                        $donor_name = "Anonymous";
                        if ($donation['donor_id'] == $_SESSION['donor_id']) {
                            $donor_name = htmlspecialchars($_SESSION['f_name']);
                        }
                        ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo htmlspecialchars($donation['amount']); ?></td>
                            <td><?php echo htmlspecialchars($donation['mdonation']); ?></td>
                            <td><?php echo htmlspecialchars($donation['date']); ?></td>
                            <td><?php echo $donor_name; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='5'>No donations found.</td></tr>";
                }
                ?>
                <tr>
                    <td colspan="4"><strong>Total Amount:</strong></td>
                    <td><strong><?php echo $total_amount; ?></strong></td>
                </tr>
            </table>
        </div>

        <div class="back-link">
            <a href="beneficiaries.php"><i class="fas fa-arrow-left"></i> Back to Beneficiaries</a>
        </div>
    </div>
</div>
</body>
</html>
