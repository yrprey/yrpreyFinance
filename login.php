<?php
  ob_start();
  session_start();
  error_reporting(1);

  if (isset($_COOKIE["user"])) {
    exit(header("location: dashboard.php"));
  }  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .main-container {
            width: 100%;
            max-width: 900px;
            display: flex;
            justify-content: center;
        }
        .text-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            flex: 1;
            margin-right: 15px;
        }
        .login-container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            flex: 1;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
        }
    </style>
    <link rel="icon" href="img/favicon.svg" title="YRprey">
</head>
<body>

<div class="main-container">
    <div class="text-container">
        <h2>Welcome to yrprey Financial!</h2>
        <p>Find vulnerabilities in yrprey financial.</p>
        <p>You can identify vulnerabilities through automated tools for dynamic, static, or library vulnerability analysis. <br><br>
            If you want to perform a manual vulnerability analysis, you can make malicious requests and then exploit the vulnerabilities.<br><br>
             If you want to perform a manual vulnerability analysis, you can manually identify vulnerabilities through Code Review, make code-level fixes, and then validate the mitigation.</p>
    </div>
    <div class="login-container">
    <?php

include("database.php");

if (isset($_POST["login"])) {

  $username = $_POST["email"];
  $password = $_POST["password"];
  $password = base64_encode($password);

$query  = "SELECT * FROM user where email='" . $username . "'";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

$row = mysqli_num_rows($result);

if ($row > 0) {

    $query  = "SELECT * FROM user where email='" . $username . "' AND password='".$password."'";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $exist = mysqli_num_rows($result);

    if ($exist > 0) {

        $rw = mysqli_fetch_assoc($result);
    
        $user_id = $rw["id"];
        $permission = $rw["permission"];

        $tempo_expiracao = time() + 3600;
        $cookie =  $tempo_expiracao."-".$permission."-".$user_id;

        setcookie("user", $cookie, $tempo_expiracao);

        exit(header("location: dashboard.php"));

    }
    else {

        print '<br><div class="alert alert-danger" role="alert">
        Password invalid!
      </div>';        

    }

}
else {
  print '<br><div class="alert alert-danger" role="alert">
  Credentials invalid!
</div>';
} 

}
?>        
        <h2 class="text-center">Login</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/bootstrap-3.3.5.js"></script>
<script src="js/jquery-1.5.1.js"></script>
<script src="js/lodash-3.9.0.js"></script>
</body>
</html>
