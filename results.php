<?php 
session_start();

include "db_conn.php";

if(!isset($_SESSION['usn']))
{
    $_SESSION['login_note'] = "Please Login to continue";
    header("Location: index.php");
}
$usn = $_SESSION['usn'];
$dis = '';
$sql = "SELECT SNAME,TIME_TAKEN,SCORE FROM USERS,SCORE,SUBJECT WHERE SCORE.SID = SUBJECT.SID AND SCORE.USN = USERS.USN AND USERS.USN = '$usn';";
$res = $conn->query($sql);
if($res->num_rows<=0)
{
    $dis = "<tr><td colspan='3'>No data</td></tr>";
}
else
{
    while($row=$res->fetch_assoc())
    {
        if(strlen($row['TIME_TAKEN'])==1)
        {
            $row['TIME_TAKEN']='0'.$row['TIME_TAKEN'];
        }
        if($row['TIME_TAKEN']=='60')
    {
        $tm = '01';
        $ts = '00';
    }
    else
    {
        $tm = '00';
        $ts = $row['TIME_TAKEN'];
    }
        $dis = $dis.'<tr>
        <td>'.$row['SNAME'].'</td>
        <td>'.$tm.':'.$ts.'</td>
        <td>'.$row['SCORE'].'/5</td>
    </tr>';
    }
}

$at1 = "SELECT COUNT(*) FROM SCORE WHERE SID=1 AND USN='$usn'";
$at1 = $conn->query($at1);
$at1 = $at1 -> fetch_assoc();
$at1 = $at1["COUNT(*)"];

$at2 = "SELECT COUNT(*) FROM SCORE WHERE SID=2 AND USN='$usn'";
$at2 = $conn->query($at2);
$at2 = $at2 -> fetch_assoc();
$at2 = $at2["COUNT(*)"];

$at3 = "SELECT COUNT(*) FROM SCORE WHERE SID=3 AND USN='$usn'";
$at3 = $conn->query($at3);
$at3 = $at3 -> fetch_assoc();
$at3 = $at3["COUNT(*)"];

if($at1==0)
{
    $p1 = 0;
}
else
{
$sql = "SELECT SUM(SCORE) FROM SCORE WHERE USN='$usn' AND SID=1;";
$res = $conn->query($sql);
    while($row=$res->fetch_assoc())
    {
        $p1=($row['SUM(SCORE)']/($at1*5))*100;
        $p1 = intval($p1);
    }
}

if($at2==0)
{
    $p2=0;
}
else{
$sql = "SELECT SUM(SCORE) FROM SCORE WHERE USN='$usn' AND SID=2;";
$res = $conn->query($sql);

    while($row=$res->fetch_assoc())
    {
        $p2=($row['SUM(SCORE)']/($at2*5))*100;
        $p2 = intval($p2);
    }
}

if($at3==0)
{
    $p3 = 0;
}
else
{
    $sql = "SELECT SUM(SCORE) FROM SCORE WHERE USN='$usn' AND SID=3;";
    $res = $conn->query($sql);
    while($row=$res->fetch_assoc())
    {
        $p3=($row['SUM(SCORE)']/($at3*5))*100;
        $p3 = intval($p3);
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online MCQ Exam Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="res_style.css">
    <style>
        h3 {
            color: white;
            padding: 15px 0px 15px 50px;
            font-weight: 700;
            margin-bottom: 0;
        }

        .leader_container {
            border: 1px solid #3c4a76;
            display: flex;
            border-radius: 10px;
            max-height: 50vh;
        }

        .lb {
            background-image: linear-gradient(90deg, #275e69 20%, #93dfef 80%);
            padding: 0.7% 5% 0.7% 5%;
            margin-top: 0 !important;
        }

        .table th {
            background-color: #222B45;
            position: sticky;
            top: 0;
        }

        .table {
            margin: 0;
            padding: 0;
        }

        .table td {
            background-color: transparent;
        }

        .table th,
        .table td {
            color: white;
            text-align: center;
            padding: 1%;
            border: none;
        }

        .table td {
            padding: 2%;
        }

        ::-webkit-scrollbar {
            display: none;
        }

        .prog_div {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 33.33%;
            flex-direction: column;
            color: white;
        }

        .nav_item:hover {
            cursor: pointer;
            transform: scale(1.08);
            transition-duration: 1s;
        }

        @property --progress-value {
    syntax: "<integer>";
    initial-value: 0;
    inherits: false;
}

@keyframes progress-1 {
    to {
        --progress-value: <?php echo $p1 ?>;
    }
}

.progress-bar-1 {
    display: flex;
    justify-content: center;
    align-items: center;

    width: 100px;
    height: 100px;
    border-radius: 50%;
    background:
        radial-gradient(closest-side, #101426 79%, transparent 80% 100%),
        conic-gradient(#93dfef calc(var(--progress-value) * 1%), #275e69 0);
    animation: progress-1 2s 1 forwards;
}

.progress-bar-1::before {
    counter-reset: percentage var(--progress-value);
    content: counter(percentage) '%';
    animation: progress-1 2s 1 forwards;
}

@keyframes progress-2 {
    to {
        --progress-value: <?php echo $p2 ?>;
    }
}

.progress-bar-2 {
    display: flex;
    justify-content: center;
    align-items: center;

    width: 100px;
    height: 100px;
    border-radius: 50%;
    background:
        radial-gradient(closest-side, #101426 79%, transparent 80% 100%),
        conic-gradient(#93dfef calc(var(--progress-value) * 1%), #275e69 0);
    animation: progress-2 2s 1 forwards;
}

.progress-bar-2::before {
    counter-reset: percentage var(--progress-value);
    content: counter(percentage) '%';
    animation: progress-2 2s 1 forwards;
}


@keyframes progress-3 {
    to {
        --progress-value: <?php echo $p3 ?>;
    }
}

.progress-bar-3 {
    display: flex;
    justify-content: center;
    align-items: center;

    width: 100px;
    height: 100px;
    border-radius: 50%;
    background:
        radial-gradient(closest-side, #101426 79%, transparent 80% 100%),
        conic-gradient(#93dfef calc(var(--progress-value) * 1%), #275e69 0);
    animation: progress-3 2s 1 forwards;
}

.progress-bar-3::before {
    counter-reset: percentage var(--progress-value);
    content: counter(percentage) '%';
    animation: progress-3 2s 1 forwards;
}
a,a:hover
    {
        text-decoration:none;
        color:white;
    }

    div.top_div
    {
        width:70%;
    }
    @media only screen and (max-width: 760px)
    {
        div.top_div
        {
            width:95%;
        }
        .prog_div
        {
            width:100% !important;
            border: 1px solid #3c4a76;
            border-radius: 10px;
            padding-top:20px !important;
            margin: 10px 0 10px 0;
        }
        div.prog_div_container
        {
            display:flex;
            flex-direction:column !important;
        }
    }

    @media only screen and (max-width: 390px)
    {
        div.top_div
        {
            width:97%;
        }
    }







    </style>
</head>

<body style="background-color:#101426;font-family: 'DM Sans',sans-serif">
    <div class="container-fluid">
        <div class="row" style="color: white;background-color: #101426;
        position: sticky;
        top: 0;
        z-index: 5;">
            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                <h3>ONLINE MCQ EXAM PORTAL</h3>

            </div>
            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                <div
                    style="display:flex;flex-direction: row;align-items: center;justify-content: space-around;height: 70px;">
                    <div class="nav_item"><span><a href="home.php">Home</a></span></div>
                    <div class="nav_item"><span><a href="leader_board.php">Leaderboard</a></span></div>
                    <div class="nav_item"><span><a href="logout.php">Logout</a></span></div>

                </div>
            </div>
            <h4 style="font-size: x-large;color:white;font-weight: 400;" class="mt-4 lb">Your Performance</h4>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                <div style="display: flex;flex-direction: column;align-items: center;">
                    <div class="top_div">
                        <div class="mt-3">

                            <div class="mt-4">
                                <p
                                    style="font-size:large;color:white;border:1px solid #93dfef;display: inline-block;padding:10px;border-radius: 10px;">
                                    Your Submissions</p>
                                <div class="leader_container overflow-auto">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Subject</th>
                                                <th>Time Taken</th>
                                                <th>Score</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">
                                            <?php echo $dis?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="mt-5 mb-2">
                                <p
                                    style="font-size:large;color:white;border:1px solid #93dfef;display: inline-block;padding:10px;border-radius: 10px;">
                                    Result Analysis</p>
                                <div style="display:flex;flex-direction: row;height: 40vh;" class="prog_div_container">
                                    <div class="prog_div">
                                        <div class="progress-bar-1">
                                            <progress min="0" max="100"
                                                style="visibility:hidden;height:0;width:0;"></progress>
                                        </div>
                                        <p style="margin-top: 15px;color:white">Computer Networks</p>
                                    </div>
                                    <div class="prog_div">
                                        <div class="progress-bar-2">
                                            <progress min="0" max="100"
                                                style="visibility:hidden;height:0;width:0;"></progress>
                                        </div>
                                        <p style="margin-top: 15px;color:white">Operating Systems</p>
                                    </div>
                                    <div class="prog_div">
                                        <div class="progress-bar-3">
                                            <progress min="0" max="100"
                                                style="visibility:hidden;height:0;width:0;"></progress>
                                        </div>
                                        <p style="margin-top: 15px;color:white">Database Management Systems</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>