<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>User</title>

    <!-- ✅ CORRECT PATH FROM auth TO Student/Public/css -->
<link rel="stylesheet" href="../Student/Public/css/student.css">
<script>
function checkUsername() {
    const username = document.getElementById("username").value;
    const msg = document.getElementById("userMsg");

    if (username.trim() === "") {
        msg.innerHTML = "";
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "check_username.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        msg.innerHTML = this.responseText;
    };

    xhr.send("username=" + encodeURIComponent(username));
}
</script>

</head>
<body>

<div class="login-box">

<h3>User-Login</h3>

<?php
if (isset($_SESSION["SuccessMsg"])) {
    echo "<p style='
        text-align: center;
        color: #2e7d32;
        font-size: 14px;
        font-weight: bold;
        margin: 10px 0 18px 0;
    '>" . $_SESSION["SuccessMsg"] . "</p>";

    unset($_SESSION["SuccessMsg"]);
}

if (isset($_SESSION["LoginErr"])) {
    echo "<p class='error'>" . $_SESSION["LoginErr"] . "</p>";
    unset($_SESSION["LoginErr"]);
}
?>


<form method="post" action="login_action.php">

    <input 
        type="text" 
        id="username" 
        name="username" 
        placeholder="Username"
        onkeyup="checkUsername()" 
        required
    >
    <small id="userMsg"></small>
    <br>

    <input type="password" name="password" placeholder="Password" required>
    <br>
    <br>
    <button type="submit">Login</button>

</form>


<a href="register.php">Register</a>

</div>

</body>
</html>
