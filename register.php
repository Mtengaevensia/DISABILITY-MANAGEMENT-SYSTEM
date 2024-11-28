<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="pictures/wheelchair.png" alt="Logo" class="logo">
            <u><h1>Disability Management System</h1></u>
        </div>
        <div class="form-container">
            <h4>Login</h4>
            <form method="POST" action="register-action.php">
                <div class="input-group">
                    <label for="email">First Name</label>
                    <input type="text" name="fname" autofocus required>
                </div>
                 <div class="input-group">
                    <label for="email">Last Name</label>
                    <input type="text" name="lname" required>
                </div>
                <div class="input-group">
                    <label for="email">Phone Number</label>
                    <input type="text" name="phone" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit" name="submit">Sign In</button>
                <p class="signup-link">Alreary have an account? <a href="role.php">Sign Up</a></p>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
