<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="pictures/wheelchair.png" alt="Logo" class="logo">
            <u><h1>Disability Management System</h1></u>
        </div>
        <div class="form-container">
            <h4>Register</h4>
            <form id="registerForm">
                <div class="input-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" required>
                        <option>Choose your role</option>
                        <option value="chairperson">Chairperson</option>
                        <option value="donor">Donor</option>
                    </select>
                </div>
                <button type="submit">Register</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting the traditional way
            
            // Get the selected role
            var role = document.getElementById('role').value;
            
            // Redirect based on the selected role
            if (role === 'chairperson') {
                window.location.href = 'chair-register.php';
            } else if (role === 'donor') {
                window.location.href = 'register.php';
            } else {
                alert('Please choose a valid role.');
            }
        });
    </script>
</body>
</html>
