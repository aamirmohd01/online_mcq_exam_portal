<?php 
    session_start();
    include "../db_conn.php";
    
    if(!isset($_SESSION['usn']))
    {
        $_SESSION['login_note'] = "Please Login to continue";
        header("Location: ../index.php");
    }

    if(!($_SESSION['check']))
    {
        header("Location: ../home.php");
    }

    if($_SERVER["REQUEST_METHOD"] === "POST")
    {
        $count=0;
        $ret = $_SESSION['res'];
        $time = $_POST['time'];

        $temp = explode(":",$time);
        $time_taken = 60 - $temp[1];
        if(isset($_POST['options0']) && !empty($_POST['options0'] && $ret[5] == $_POST['options0'])) $count++;
        if(isset($_POST['options1']) && !empty($_POST['options1'] && $ret[11] == $_POST['options1'])) $count++;
        if(isset($_POST['options2']) && !empty($_POST['options2'] && $ret[17] == $_POST['options2'])) $count++;
        if(isset($_POST['options3']) && !empty($_POST['options3'] && $ret[23] == $_POST['options3'])) $count++;
        if(isset($_POST['options4']) && !empty($_POST['options4'] && $ret[29] == $_POST['options4'])) $count++;

        $name = $_SESSION['name'];
        $sid = $_SESSION['sid'];
        $usn = $_SESSION['usn'];
        $iq = "INSERT INTO SCORE VALUES ('$usn','$sid','$time_taken','$count')";
        $conn->query($iq);

        $_SESSION['check']=false;
        header("Location: ../results.php");
    }
?>