<!-- 
 * File: logIn.php SWE381 - Project
 * EDIT DATE: 5/13/2024 
 * AUTHORS: 
 * Saleh AlGhaith(Leader)		(443101007)
 * Fahad Alohali                (443101023)
 * Mshari Alaeena               (443101459)
-->
<?php


include "databaseCon.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="#" method="post">
            <?php if ($_SERVER['REQUEST_METHOD'] == "POST") 
            {
                $uName = $_POST['username'];
                $pass = $_POST['password'];
                $result = $conn->query("SELECT * FROM user WHERE '$uName' = user_name AND '$pass' = user_password");
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $_SESSION['email'] = $row['user_email'];
                    $_SESSION['username'] = $uName;
                    Header("Location:loggedInIndex.php");
                    exit();
                } else
                    echo "<lable class='errorMessage'>username or password is wrong!</lable>";
            }
            ?>
            <div class="input-group">
                <input type="text" id="username" name="username" placeholder="Username" required>
                <img src="img/person_icon.png" alt="Person Icon" class="input-icon">
            </div>
            <div class="input-group">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <img src="img/lock_icon.png" alt="Lock Icon" class="input-icon">
            </div>

            <button type="submit">Login</button>
        </form>
        <div class="signLog-link">
            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
        </div>
    </div>
</body>

</html>