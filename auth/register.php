<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="../Student/Public/css/register.css">

    <title>User Sign Up</title>

    <script>
function checkEmail() {
    const email = document.getElementById("email").value;
    const msg   = document.getElementById("emailMsg");

    if (email === "") {
        msg.innerHTML = "";
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "check_email.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        msg.innerHTML = this.responseText;
    };

    xhr.send("email=" + encodeURIComponent(email));
}
</script>


</head>
<body>

<div class="signup-box">
    <h2>User Sign Up</h2>

    <?php
    if (isset($_SESSION["regErr"])) {
        echo "<p class='error'>" . $_SESSION["regErr"] . "</p>";
        unset($_SESSION["regErr"]);
    }
    ?>

    <form method="post" action="register_action.php">

        <label>Full Name:</label>
        <input type="text" name="name" required>

        <label>Email:</label>
        <input
            type="email"
            id="email"
            name="email"
            onkeyup="checkEmail()"
            required
        >
        <small id="emailMsg"></small>
        <label>Address:</label>
        <textarea name="address" required></textarea>

        <label>Gender:</label>
        <select name="gender" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>

        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <label>Role:</label>
        <select name="role" required>
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
            <option value="admin">Admin</option>
        </select>

        <button type="submit">Register</button>
    </form>

    <div class="login-link">
        <a href="login.php">Already have an account?</a>
    </div>
</div>

</body>
</html>
