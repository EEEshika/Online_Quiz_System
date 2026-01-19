<?php
session_start();

if (isset($_SESSION["role"])) {
    if ($_SESSION["role"] === "student") { header("Location: Student/View/dashboard.php"); exit(); }
    if ($_SESSION["role"] === "teacher") { header("Location: Teacher/View/dashboard.php"); exit(); }
    if ($_SESSION["role"] === "admin")   { header("Location: Admin/View/dashboard.php"); exit(); }
}
?>
<!DOCTYPE html>
<html>
 <head>
    <title>Online Quiz</title>

    <link rel="stylesheet" href="/Final_WT/Online_Quiz_System/IndexImage/startImage.css">

</head>

<body>

<br><br><br><br><br><br><br><br><br><br>
    <h1>ONLINE QUIZ SYSTEM</h1>
    <h1>----------</h1>

    <table>
        <tr>
            <td><a href="auth/login.php"> <button class='logbtn'>Login</button></a></td>
            <td><a href="auth/register.php"> <button class='regbtn'>Register</button></a></td>
        </tr>
    </table>








</body>
</html>
