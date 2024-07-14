<?php
session_start();
include "./assets/components/login-arc.php";

if (isset($_COOKIE['logindata']) && $_COOKIE['logindata'] == $key['token'] && $key['expired'] == "no") {
    if (!isset($_SESSION['IAm-logined'])) {
        $_SESSION['IAm-logined'] = 'yes';
    }
} elseif (isset($_SESSION['IAm-logined'])) {
    $client_token = generate_token();
    setcookie("logindata", $client_token, time() + (86400 * 30), "/"); // 86400 = 1 day
    change_token($client_token);
} else {
    header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/light-theme.min.css" rel="stylesheet">
    <title>SocioScouter - V1</title>
    <style>
        /* Ensure the body and html take the full height */
        body, html {
            height: 100%;
            margin: 0;
        }

        /* Centering the image container at the top */
        .container {
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Align to the top */
            height: 15vh; /* Full viewport height */
            padding-top: 10px; /* Adjust the padding as needed */
        }

        /* Make the image responsive */
        .responsive-image {
            width: 10%;
            max-width: 300px; /* Adjust the max-width as needed */
            height: auto;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* Add a hover effect */
        .responsive-image:hover {
            transform: scale(1.1); /* Zoom the image on hover */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Add a subtle shadow */
        }

        /* Add an animation for a smooth transition */
        @keyframes float {
            0% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
            100% {
                transform: translateY(0);
            }
        }

        /* Apply the float animation */
        .responsive-image {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>

<body id="ourbody" onload="check_new_version()">
    <div class="container">
        <img src="./logo.ico" alt="Logo" class="responsive-image">
    </div>

    <div id="links"></div>

    <div class="mt-2 d-flex justify-content-center">
        <textarea class="form-control w-50 m-3" placeholder="result ..." id="result" rows="15"></textarea>
    </div>

    <div class="mt-2 d-flex justify-content-center">
        <button class="btn btn-danger m-2" id="btn-listen">Listener Running / press to stop</button>
        <button class="btn btn-success m-2" id="btn-listen" onclick="saveTextAsFile(result.value, 'log.txt')">Download Logs</button>
        <button class="btn btn-warning m-2" id="btn-clear">Clear Logs</button>
    </div>

    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/script.js"></script>
    <script src="./assets/js/sweetalert2.min.js"></script>
    <script src="./assets/js/growl-notification.min.js"></script>
</body>
</html>
