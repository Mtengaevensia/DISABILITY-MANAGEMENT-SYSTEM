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
            <form id="loginForm" action="login-action.php" method="POST">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" autofocus required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" name="submit">Login</button>
                <p class="signup-link">Don't have an account? <a href="role.php">Sign Up</a></p>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
