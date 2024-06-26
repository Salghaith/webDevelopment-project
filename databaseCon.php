<!-- 
 * File: databaseCon.php SWE381 - Project
 * EDIT DATE: 5/15/2024 
 * AUTHORS: 
 * Saleh AlGhaith(Leader)		  (443101007)
 * Fahad Alohali                (443101023)
 * Mshari Alaeena               (443101459)
-->
<?php



   session_start();


   $host = "127.0.0.1";
   $user = "root";
   $pass = "";
   $name = "users";

   if (!$conn = mysqli_connect($host, $user, $pass, $name))
      die("Failed to connect with database!");

