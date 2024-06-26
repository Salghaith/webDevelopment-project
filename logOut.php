<!-- 
 * File: logOut.php SWE381 - Project
 * EDIT DATE: 5/16/2024 
 * AUTHORS: 
 * Saleh AlGhaith(Leader)		(443101007)
 * Fahad Alohali                (443101023)
 * Mshari Alaeena               (443101459)
-->
<?php
include "databaseCon.php";
unset($_SESSION['username']);
unset($_SESSION['user_email']);
header("Location:index.php");
exit();
