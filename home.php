<?php 
session_start();

include "db_conn.php";

if(!isset($_SESSION['usn']))
{
    $_SESSION['login_note'] = "Please Login to continue";
    header("Location: index.php");
}

$usn = $_SESSION['usn'];
$get_name = "SELECT NAME FROM USERS WHERE USN='$usn'";
if(($conn->query($get_name))->num_rows>0)
{
    $row = $conn->query($get_name)->fetch_assoc();
    $name = ucwords(strtolower($row["NAME"]));
}
$_SESSION['name']=$name;

if(strlen(intval($usn))!=10)
{

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

$_SESSION['at1']=$at1;
$_SESSION['at2']=$at2;
$_SESSION['at3']=$at3;

echo '<!DOCTYPE html>
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
</head>

<style>

div.res-nav
{
    display:flex;flex-direction: row;align-items: center;justify-content: space-around;height: 70px;
}
    ::-webkit-scrollbar {
        display: none;
    }

    h3 {
        color: white;
        padding: 15px 0px 15px 50px;
        font-weight: 700;
        margin-bottom: 0;
    }

    #bg {
        background-image: linear-gradient(90deg, #275e69 20%, #93dfef 80%);
        color: white;
        padding: 4%;
    }

    .take_test_button {
        background-image: linear-gradient(180deg, #d9f2fc, #c2ecf8);
        width: 20%;
        height: 20vh;
        margin: 10px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .take_test_container {
        border: 1px solid #3c4a76;
        display: flex;
        border-radius: 10px;
    }

    .take_test_info {
        margin: 10px;
        color: white;
    }

    .dis_topic {
        font-size: large;
    }

    .take_test_button:hover>span {
        transform: scale(1.1);
        transition-duration: 1s;
    }

    .nt_span {
        border-radius: 5px;
        border: 2px solid #222B46;
        padding: 5px 10px;
        font-size: small;
    }

    .nav_item:hover {
        cursor: pointer;
        transform: scale(1.08);
        transition-duration: 1s;
    }
    a,a:hover
    {
        text-decoration:none;
        color:white;
    }
    button
    {
        background-image: linear-gradient(180deg, #d9f2fc, #c2ecf8);
        margin: 10px;
        border:none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
    @media only screen and (max-width: 760px) {
        .take_test_button {
            width: 45%;
            height: 40vh;
        }
    
        .info-div {
            display: flex;
            flex-direction: column;
            align-items: baseline;
        }
    }
    
    @media only screen and (max-width: 630px) {
        .take_test_button {
            height: 40vh;
        }
    }

    @media only screen and (max-width:580px)
    {
        div.res-nav
        {
            flex-direction: row;
        }
    }
    
    
    @media only screen and (max-width: 470px) {
        .take_test_container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    
        .take_test_button {
            height: 20vh;
            width: 90%;
        }
    
    }
</style>

<body style="background-color:#101426;font-family: \'DM Sans\',sans-serif;">
    <div class=" container-fluid">
        <div class="row" style="color: white;background-color: #101426;
        position: sticky;
        top: 0;
        z-index: 5;border-bottom:1px solid #275e69">
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                <h3>ONLINE MCQ EXAM PORTAL</h3>

            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <div class="res-nav">
                    <div class="nav_item"><span><a href="leader_board.php">Leaderboard</a></span></div>
                    <div class="nav_item"><span><a href="results.php">Your Performance</a></span></div>
                    <div class="nav_item"><span><a href="logout.php">Logout</a></span></div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                <div id="bg">
                    <div>
                        <h5>Hi '.$name.',</h5>
                    </div>
                    <div>
                        <h4>Welcome to MCQ PORTAL</h4>
                    </div>
                </div>
                <div style="display: flex;flex-direction: column;align-items: center;">
                
                    <div style="width:85%;">
                    <form action="make_q.php" method="POST" style="width:100%;">
                        <div class="mt-3">
                            <p style="font-size: xx-large;color:white;border:1px solid #93dfef;display: inline-block;padding:2px 20px;border-radius: 10px;"
                                class="mt-4">Available
                                Subjects</p>
                            <div class="take_test_container">
                                <button class="take_test_button" type="submit" name="SUB" value="1"';
                                if($at1==3){ echo 'disabled style="cursor:not-allowed"';
                                }
                                echo '><span>Attempt Test Now</span>
                                </button>
                                <div class="take_test_info">
                                    <p class="dis_topic">COMPUTER NETWORKS</p>
                                    <p>Attempts Remaining: '.(3-$at1).' / 3</p>
                                    <div class="info-div">
                                        <span class="nt_span">No
                                            of
                                            questions :
                                            5</span>
                                        <span class="nt_span mx-3">Time Limit : 1 minute</span>
                                    </div>
                                </div>
                            </div>
                            <div class="take_test_container mt-3">
                                <button class="take_test_button" type="submit" name="SUB" value="2"';
                                if($at2==3){ echo 'disabled style="cursor:not-allowed"';
                                }
                                echo '><span>Attempt Test Now</span>
                                </button>
                                <div class="take_test_info">
                                    <p class="dis_topic">OPERATING SYSTEMS</p>
                                    <p>Attempts Remaining: '.(3-$at2).' / 3</p>
                                    <div class="info-div">
                                        <span class="nt_span">No
                                            of
                                            questions :
                                            5</span>
                                        <span class="nt_span mx-3">Time Limit : 1 minute</span>
                                    </div>
                                </div>
                            </div>
                            <div class="take_test_container mt-3 mb-5">
                                <button class="take_test_button" type="submit" name="SUB" value="3"';
                                if($at3==3){ echo 'disabled style="cursor:not-allowed"';
                                }
                                echo '><span>Attempt Test Now</span>
                                </button>
                                <div class="take_test_info">
                                    <p class="dis_topic">Database Management Systems</p>
                                    <p>Attempts Remaining: '.(3-$at3).' / 3</p>
                                    <div class="info-div">
                                        <span class="nt_span">No
                                            of
                                            questions :
                                            5</span>
                                        <span class="nt_span mx-3">Time Limit : 1 minute</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                
                </div>
            </div>
        </div>
    </div>

</body>

</script>

</html>';

}
else
{
    echo '<!DOCTYPE html>
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
        <style>
            #bg {
                background-image: linear-gradient(90deg, #275e69 20%, #93dfef 80%);
                color: white;
                padding: 4%;
            }
    
            ::-webkit-scrollbar {
                display: none;
            }
    
            h3 {
                color: white;
                padding: 15px 0px 15px 50px;
                font-weight: 700;
                margin-bottom: 0;
            }
    
            .nav_item:hover {
                cursor: pointer;
                transform: scale(1.08);
                transition-duration: 1s;
            }
    
            .add_subject {
                background-color: #93dfef;
                width: 30%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 10px;
                cursor: pointer;
            }
    
            .add_subject:hover>span {
                transform: scale(1.05);
                transition-duration: 1s;
            }
    
            a,
            a:hover {
                text-decoration: none;
                color: white;
            }
    
            button {
                border: none;
            }

            div.add_div
            {
                display: flex;flex-direction: row;align-items: center;height:30vh;justify-content: space-between;border:1px solid #3c4a76;padding:10px;border-radius: 10px;
            }
            

            @media only screen and (max-width: 540px)
            {
                div.add_div
                {
                    flex-direction: column;
                    justify-content:center;
                    height: fit-content;
                }
                .add_subject
                {
                    width:90%;
                    padding: 20px;
                    margin:20px;
                }
            }

        </style>
    </head>
    
    <body style="background-color:#101426;font-family: \'DM Sans\',sans-serif;">
        <div class=" container-fluid">
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
                        <div class="nav_item"><span><a href="leader_board.php">Leaderboard</a></span></div>
                        <div class="nav_item"><span><a href="logout.php">Logout</a></span></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                    <div id="bg">
                        <div>
                            <h5>Hi '.$name.',</h5>
                        </div>
                        <div>
                            <h4>Welcome to MCQ PORTAL</h4>
                        </div>
                    </div>
                    <div style="display:flex;align-items: center;width:100%;flex-direction: column;" class="mt-4">
                        <div style="width:85%;">
                            <p
                                style="font-size: x-large;color:white;border:1px solid #93dfef;display: inline-block;padding:2px 20px;border-radius: 10px;">
                                Add Questions</p>
                            <form action="add_question.php" method="POST">
                            <div class="add_div">
                                <button class="add_subject" type="submit" name="SUB" value="1"><span><b>COMPUTER
                                            NETWORKS</b></span></button>
                                <button class="add_subject" type="submit" name="SUB" value="2"><span><b>OPERATING
                                            SYSTEMS</b></span></button>
                                <button class="add_subject" type="submit" name="SUB" value="3"><span><b>DATABASE MANAGEMENT
                                            SYSTEMS</b></span></button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    
    </body>
    
    </html>';

}


?>

