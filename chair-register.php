
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chairperson Register</title>
    <link rel="stylesheet" href="css/chair-register.css">

</head>
<body>
<div class="container">
    <div class="logo">
        <img src="pictures\wheelchair.png" alt="Logo">
    </div>
    <div class="header">
        <h1>REGISTER AS CHAIRPERSON</h1>
    </div>
    <hr>
    <div class="content">
        <form action="chair-register-action.php" method="POST">
            <div class="row">
                <div class="input-field">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" autofocus required>
                </div>
                <div class="input-field">
                    <label for="mname">Middle Name</label>
                    <input type="text" name="mname" required>
                </div>
                <div class="input-field">
                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" required>
                </div>
            </div>
            <div class="row">
                <div class="input-field">
                    <label for="gender">Gender</label>
                    <select name="gender" required>
                        <option hidden disabled selected></option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
                <div class="input-field">
                    <label for="dob">Date of Birth</label>
                    <input type="date" name="dob" required>
                </div>
                <div class="input-field">
                    <label for="location">Location</label>
                    <input type="text" name="location" required>
                </div>
            </div>
            <div class="row">
                <div class="input-field">
                    <label for="dtype">Phone Number</label>
                    <input type="text" name="phone" required>
                </div>
                <div class="input-field">
                    <label for="email">Email</label>
                    <input type="email" name="email">
                </div>
                <div class="input-field">
                    <label for="psw">Password</label>
                    <input type="password" name="password" required>
                </div>
            </div>
            <div class="row">
                <div class="input-field">
                    <label for="picture">Identity Key</label>
                    <input type="text" name="idkey" required>
                </div>
            </div>
            <div class="row">
                <div class="input-field">
                    <input type="submit" name="submit" value="REGISTER">
                </div>
            </div>
        </form>
        <p>Already Registered? <a href="index.php">Login Here</a></p>
    </div>
</div>
</body>
</html>
