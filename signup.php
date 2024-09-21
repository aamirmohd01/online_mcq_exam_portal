<?php
session_start();
if(isset($_SESSION['usn']))
{
    header("Location:home.php");
}
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en" ng-app="signApp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online MCQ Exam Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <style>
        @-webkit-keyframes quantumWizPaperInputRemoveUnderline {
            0% {
                -webkit-transform: scaleX(1);
                -webkit-transform: scaleX(1);
                transform: scaleX(1);
                opacity: 1
            }

            to {
                -webkit-transform: scaleX(1);
                -webkit-transform: scaleX(1);
                transform: scaleX(1);
                opacity: 0
            }
        }

        @keyframes quantumWizPaperInputRemoveUnderline {
            0% {
                -webkit-transform: scaleX(1);
                -webkit-transform: scaleX(1);
                transform: scaleX(1);
                opacity: 1
            }

            to {
                -webkit-transform: scaleX(1);
                -webkit-transform: scaleX(1);
                transform: scaleX(1);
                opacity: 0
            }
        }

        @-webkit-keyframes quantumWizPaperInputAddUnderline {
            0% {
                -webkit-transform: scaleX(0);
                -webkit-transform: scaleX(0);
                transform: scaleX(0)
            }

            to {
                -webkit-transform: scaleX(1);
                -webkit-transform: scaleX(1);
                transform: scaleX(1)
            }
        }

        @keyframes quantumWizPaperInputAddUnderline {
            0% {
                -webkit-transform: scaleX(0);
                -webkit-transform: scaleX(0);
                transform: scaleX(0)
            }

            to {
                -webkit-transform: scaleX(1);
                -webkit-transform: scaleX(1);
                transform: scaleX(1)
            }
        }

        .uli_ {
            background-color: #3c4a76;
            height: 1.4px !important;
        }

        input {
            border: none !important;
            padding-left: 0 !important;
            font-size: large !important;
            background-color: #101426 !important;
            color: aliceblue !important;
        }

        ::placeholder {
            color: grey !important;
        }

        input:focus {
            border: none !important;
            box-shadow: none !important;
        }

        input:focus+.uli_ {

            /* Define the underline animation */
            animation: quantumWizPaperInputAddUnderline 0.2s ease-in-out;
            background-color: rgba(206, 206, 206, 0.736);
            transform-origin: center;
            transform: scaleX(1);
        }

        div.t_tle {
            /* background-color: rgb(183, 58, 110); */
            width: 100%;
            text-align: center;
            padding: 15px;
            font-weight: 500;
            font-size: 25pt;
            color: #ffffff;
            /* background-color: #364a76; */
            /* background-image: linear-gradient(90deg, #275e69 20%, #93dfef 80%); */

        }

        .btn,
        .btn:hover {
            /* background-color: rgb(183, 58, 110); */
            color: white;
        }

        a {
            text-decoration: none;
            font-weight: 600;
        }

        h1 {
            /* background-color: rgb(70, 5, 169); */
            text-align: center;
            color: white;
            padding: 10px;
        }

        p#alert {
            color: red;
            text-align: center;
        }
    </style>
</head>

<body style="background-color: #101426;">
    <h1>ONLINE MCQ EXAM PORTAL</h1>
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-10 offset-sm-1 col-xs-12"
                style="height: 85vh;display: flex;justify-content: center;align-items: center;">
                <div style="width:95%;">
                    <form action="verify/verify2.php" method="post" ng-controller="signCtrl">
                        <div style="display: flex;align-items: center;flex-direction: column;border: 1px solid #6882ba;border-radius: 8px;justify-content: center;"
                            class="mt-3 mb-3 w1">
                            <div class="t_tle">SIGN UP</div>
                            <div class="mt-2 mb-3" style="width:90%;">
                                <input type="text" ng-model="name" class="form-control" name="inpName" id="inpName"
                                    placeholder="Enter Your Name" autocomplete="off">
                                <div class="uli_"></div>
                            </div>
                            <div class="mb-3" style="width:90%;">
                                <input type="text" ng-model="usn" name="inpUSN" class="form-control" id="inpUSN"
                                    placeholder="Enter Your USN" autocomplete="off">
                                <div class="uli_"></div>
                            </div>
                            <div class="mb-3" style="width:90%;">
                                <input type="password" ng-model="pass" name="inp_pass" class="form-control"
                                    id="inp_pass" placeholder="Enter Your Password">
                                <div class="uli_"></div>
                            </div>
                            <div class="mb-3" style="width:90%;">
                                <input type="password" ng-model="cpass" name="inp_cpass" class="form-control"
                                    id="inp_cpass" placeholder="Confirm Your Password">
                                <div class="uli_"></div>
                            </div>

                            <div class="my-2 mb-4">
                                <button type="submit" ng-disabled="validate()" class="btn btn-primary" id="btn">Sign
                                    up</button>
                            </div>
                            <p id="alert" ng-show="alert!==undefined">{{alert}}</p>
                            <div style="text-align: center;">
                                <p style="color: white;">Have an account? <a href="index.php"><span>Log in</span></a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

<script>
    angular.module('signApp', []).controller('signCtrl', function ($scope) {
        $scope.validate = function () {
            if (!$scope.name || !$scope.usn || !$scope.pass) {
                $scope.alert = "All fields are required";
                return true;
            }

            if (!$scope.pass && !$scope.cpass) {
                $scope.alert = "";
                return true;
            }
            if ($scope.pass.length < 6) {
                $scope.alert = "Password must have minimum 6 characters";
                return true;
            }
            if ($scope.pass && !$scope.cpass) {
                $scope.alert = "Please Confirm Your Password";
                return true;
            }
            else {
                if ($scope.pass && $scope.cpass && $scope.pass !== $scope.cpass) {
                    $scope.alert = "Password and Confirmed password are not matching";
                    return true;
                }
                else if ($scope.pass && $scope.cpass && $scope.pass === $scope.cpass) {
                    $scope.alert = "";
                    return false;
                }
            }
        };
    });

</script>

</html>