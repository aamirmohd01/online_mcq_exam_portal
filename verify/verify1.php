<?php
session_start();
session_unset();
session_destroy();
session_start();
include "../db_conn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST"){
$usn = $_POST['inpUSN'];
$ent_pass = $_POST['inp_pass'];
$sel_pass = "SELECT PASSWORD FROM USERS WHERE USN='$usn'";

if(($conn->query($sel_pass))->num_rows>0)
{
    $row = $conn->query($sel_pass)->fetch_assoc();
    $pass = $row["PASSWORD"];
    if($pass!=$ent_pass)
    {
        $_SESSION['login_note'] = "Sorry, your password was incorrect. Please double-check your password.";
        header("Location:../index.php");
    }
    else 
    {
        $_SESSION['usn'] = $usn;
        header("Location:../home.php");
    }
}
else 
{
    $_SESSION['login_note'] = "Sorry, your password was incorrect. Please double-check your password.";
    header("Location:../index.php");
}
}
else 
{
  $_SESSION['login_note'] = "Please Log in to continue";
  header("Location:../index.php");
}



?>