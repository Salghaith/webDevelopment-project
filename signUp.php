<!-- 
 * File: signUp.php SWE381 - Project
 * EDIT DATE: 5/10/2024 
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
    <title>Signup Page</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="login-container">
        <h2>Signup</h2>
        <form action="#" method="post">

            <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST") 
            {
                $uName = $_POST['username'];
                $pass = $_POST['password'];
                $email = $_POST['email'];

                if (is_numeric($uName)) 
                {
                    echo "<lable class='errorMessage'>Invalid Username, please enter a non-numeric Username.</lable>";
                } else if (strlen($uName) < 4 || strlen($uName) > 15) 
                {
                    echo "<lable class='errorMessage'>Please enter a Username with at least 4 characters and at most 15</lable>";
                }else if (!preg_match('/^[a-zA-Z0-9]+$/', $uName)|| !preg_match('/^[a-zA-Z0-9]+$/', $pass))
                {
                    echo "<lable class='errorMessage'>Please enter a Username/Password with only characters and numbers</lable>";
                } else if (strlen($pass) < 8 || strlen($pass) > 16) 
                {
                    echo "<lable class='errorMessage'>Please enter a Password with at least 8 characters and at most 16</lable>";
                } else 
                {
                    $result = $conn->query("SELECT user_name FROM user WHERE user_name = '$uName' OR user_email = '$email'");
                    if ($result->num_rows > 0) 
                    {
                        echo "<lable class='errorMessage'>username or email already exist!</lable>";
                    } else 
                    {
                        $sql = "INSERT INTO user (user_name, user_password, user_email) VALUES ('$uName','$pass','$email')";
                        if ($conn->query($sql) === TRUE) 
                        {
                            $_SESSION['email'] = $email;
                            $_SESSION['username'] = $uName;
                            header("Location:loggedInIndex.php");
                            exit();
                        } else
                            echo "Error" . $conn->error;
                    }
                }
            }
            ?>
            <div class="input-group">
                <input type="text" name="username" placeholder="Username" required>
                <img src="img/person_icon.png" alt="Person Icon" class="input-icon">
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
                <img src="img/lock_icon.png" alt="Lock Icon" class="input-icon">
            </div>
            <div class="input-group">
                <input type="email" name="email" placeholder="Ahmed@mmm.nnn" required>
                <img src="img/mail.png" alt="mail Icon" class="input-icon">
            </div>
            <button type="submit">Signup</button>
        </form>
        <div class="signLog-link">
            <p>You have an account? <a href="logIn.php">Login</a></p>
        </div>
    </div>
</body>

</html>