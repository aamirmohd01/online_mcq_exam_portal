<?php 
    session_start();

    include "db_conn.php";
    
    if(!isset($_SESSION['usn']))
    {
        $_SESSION['login_note'] = "Please Login to continue";
        header("Location: index.php");
    }
    if(!isset($_SESSION['res']))
    {
        header("Location: home.php");
    }
    else
    {

        $sid = $_SESSION['sid'];
        $sname = "SELECT SNAME FROM SUBJECT WHERE SID = '$sid'";
        $row = $conn->query($sname)->fetch_assoc();
        $sname = $row["SNAME"];
        $ret = $_SESSION['res'];
        $_SESSION['check'] = true;
        $_SESSION['sid']=$sid;
    

$q_div = '';
$i=0;
$j=0;
while($j<=29)
    {
    $q_div = $q_div . '<div class="queBox">
    <div
        style="height:25%;background-color:#1f274a;display: flex;align-items: center;border-top-right-radius: 6px;border-top-left-radius:6px;border-top:1px solid #93dfef;border-left:1px solid #93dfef;border-right:1px solid #93dfef;">
        <div class="mx-3">'.($i+1).') '.$ret[$j++].'</div>
    </div>
    <div
        style="background-color: #101426;color:white;padding:10px 0px;border-bottom-left-radius: 6px;border-bottom-right-radius: 6px;
        border-bottom:1px solid #93dfef;border-left:1px solid #93dfef;border-right:1px solid #93dfef;">
        <div class="optDiv mx-5">
            <div class="form-check">
                <input type="radio" class="form-check-input" id="opt1'.$i.'" name="options'.$i.'" value="'.$ret[$j].'">
                <label class="form-check-label" for="opt1'.$i.'">
                '.$ret[$j++].'
                </label>
            </div>
            <div class="form-check">
                <input type="radio" name="options'.$i.'" class="form-check-input" id="opt2'.$i.'" value="'.$ret[$j].'"><label
                    class="form-check-label" for="opt2'.$i.'">
                    '.$ret[$j++].'
                </label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="options'.$i.'" id="opt3'.$i.'" value="'.$ret[$j].'">
                <label class="form-check-label" for="opt3'.$i.'">
                '.$ret[$j++].'
                </label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="options'.$i.'" id="opt4'.$i.'" value="'.$ret[$j].'">
                <label class="form-check-label" for="opt4'.$i.'">
                '.$ret[$j++].'
                </label>
            </div>
        </div>
    </div>
</div>';
    $j=$j+1;
    $i+=1;
    }
   
};

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

    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        ::-webkit-scrollbar {
            display: none;
        }

        .queBox {
            width: 98%;
            margin: 2% 0%;
        }

        .optDiv .form-check {
            padding: 7px;
        }

        .form-check-input {
            border: 1px solid black;
            cursor: pointer;
        }

        .form-check-label {
            cursor: pointer;
        }

        .info {
            font-size: large;
            font-weight: 600;
            margin: 10px 0px;
        }

        h1 {
            background-color: #1f274a;
        }
        @media only screen and (max-width:780px) {
            div.nodis {
                display: none;
            }

            .col-lg-3 {
                height: fit-content !important;
                border-right: none !important;
            }
            .queBox
            {
                margin:5% 5px !important;
            }
            .che
            {
                height:60vh !important;
            }
        }
    </style>
</head>

<body style="background-color: #101426;color:white">
    <div class="container-fluid" id="d">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"
                style="border-right:1px solid #93dfef;height:100vh;display: flex;flex-direction: column;align-items: center;padding:0%;">
                <div style="width:99%;border:1px solid #3c4a76;border-radius: 5px;padding: 0.8vw 1.7vw;" class="nodis">
                    <div style="font-size: x-large;font-weight: 700;">Candidate Information</div>
                    <div class="info">Name: <?php echo $_SESSION['name']?></div>
                    <div class="info">USN: <?php echo  $_SESSION['usn']?></div>
                </div>
                <div class="mt-3">
                    <p style="font-size: 20px;text-align: center;margin-bottom: 0;font-weight: bold;">Time remaining</p>
                    <p style="font-size: 80px;text-align: center;font-weight: 600;margin-bottom: 1vh;margin-top: 0;" id="timer"></p>
                </div>
                <div style="width:99%;border-radius: 5px;padding: 5px;border: 1px solid #3c4a76;" class="nodis">
                    <p style="font-size: large;text-align:center;font-weight: 700;margin-bottom: 0;">Instructions to
                        the candidate</p>
                    <ol>
                        <li>This page contains exactly five questions</li>
                        <li>Each question has four multiple choices</li>
                        <li>Exiting Fullscreen mode causes automatic submission</li>
                        <li>After marking all answers, click on the submit button</li>
                        <li>Once submitted cannot be undone!!</li>
                    </ol>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <form action="verify/check.php" method="POST" id="f">
                <input type="text" style="display:none;" name="time" id="timee">
                <h2 style="font-size: xx-large;font-weight: bold;padding: 10px 3px;border-bottom:2px solid #93dfef;">
                    <?php echo $sname ?></h2>
                <div style="height:88vh;display: flex;flex-direction: column;align-items: center;" class="overflow-auto che"
                    id="quest">
                </div>
                </form>
            </div>
        </div>
    </div>
    <button onclick="toggleFullscreen()" id="b" class="btn btn-primary" style="position:absolute;top:45%;left:45%;">Toggle Fullscreen</button>
</body>

<script>
    window.history.forward(); 
        function noBack() { 
            window.history.forward(); 
        } 
document.getElementById('d').style.display = "none";

var quest = document.getElementById('quest');
quest.innerHTML = `<?php echo $q_div ?>`;
quest.innerHTML += `<div class="mt-5 mb-4">
                        <button type="submit" class="btn btn-success mb-2">Submit</button>
                    </div>`;
function toggleFullscreen() {
    var elem = document.documentElement; 

    if (!document.fullscreenElement && !document.mozFullScreenElement &&
        !document.webkitFullscreenElement && !document.msFullscreenElement) {
        
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.mozRequestFullScreen) { 
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) { 
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) { 
            elem.msRequestFullscreen();
        }
        document.getElementById('b').style.display = "none";
        document.getElementById('d').style.display = "initial";
        updateTimer();
    }
}
document.addEventListener('keydown', function(e) {
    e.preventDefault();
  });

document.addEventListener('fullscreenchange', handleFullscreenChange);
document.addEventListener('mozfullscreenchange', handleFullscreenChange);
document.addEventListener('webkitfullscreenchange', handleFullscreenChange);
document.addEventListener('msfullscreenchange', handleFullscreenChange);

function handleFullscreenChange() {
    
    if (document.fullscreenElement || document.mozFullScreenElement ||
        document.webkitFullscreenElement || document.msFullscreenElement) {
        
    } else {
        document.getElementById("f").submit();
    }
}

var countdownTime = 60; 

  function updateTimer() {
    var minutes = Math.floor(countdownTime / 60);
    var seconds = countdownTime % 60;

    document.getElementById('timer').innerText = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
    document.getElementById('timee').value = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

    if (countdownTime > 0) {
      countdownTime--; 
      setTimeout(updateTimer, 1000);
    } else {
      document.getElementById('f').submit();
    }
  }
</script>

</html>