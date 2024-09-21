<?php
session_start();
if(!isset($_SESSION['usn']))
{
    $_SESSION['login_note'] = "Please Login to continue";
    header("Location: ../index.php");
}
include "../db_conn.php";

$usn = $_SESSION['usn'];

if(strlen(intval($usn))!=10)
{
    header("Location: ../home.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{

    $q = $_POST['inpQ'];
    $o1 = $_POST['inpO1'];
    $o2 = $_POST['inpO2'];
    $o3 = $_POST['inpO3'];
    $o4 = $_POST['inpO4'];
    $ans = $_POST['inpAns'];
    $sid = $_SESSION['sid'];


    try {
        $sql = "INSERT INTO QUESTIONS(QUESTION,SID) VALUES ('$q','$sid')";
        $conn->query($sql);
        if ($conn->error) {
            throw new Exception($conn->error);
        }
    } catch (Exception $e) {
        echo '<script>
        alert("' . $e->getMessage() . '");
        window.location.href = "../home.php";
      </script>';
    }
    $sql = "INSERT INTO OPTIONS(O1,O2,O3,O4,ANSWER) VALUES ('$o1','$o2','$o3','$o4','$ans')";
    $conn->query($sql);
    header("Location: ../add_question.php");

}
else
{
    header("Location: ../home.php");
}



?>