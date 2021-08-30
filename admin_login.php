<?php
session_start();
error_reporting(0);
include('includes/config.php');
if ($_SESSION['alogin'] != '') {
  $_SESSION['alogin'] = '';
}
if (isset($_POST['login'])) {
  $uname = $_POST['username'];
  $password = md5($_POST['password']);
  $sql = "SELECT UserName,Password FROM admin WHERE UserName=:uname and Password=:password";
  $query = $dbh->prepare($sql);
  $query->bindParam(':uname', $uname, PDO::PARAM_STR);
  $query->bindParam(':password', $password, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  if ($query->rowCount() > 0) {
    $_SESSION['alogin'] = $_POST['username'];
    echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
  } else {

    echo "<script>alert('Invalid Details');</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login</title>

  <link rel="stylesheet" href="css/custom.css" media="screen">
</head>
<style>
  * {
    transition: all 0.3s ease-in-out;
  }

  .container {
    clear: both;
    overflow: auto;
  }

  nav {
    float: right;
  }

  .logo img {
    float: left;
    margin: 20px 0 0 20px;
  }


  ul li {
    display: inline-block;
    padding: 10px;
    font-size: 20px;
  }

  ul li a {
    float: left;
    display: block;
    color: #000;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
    background-color: #57CC99;
    font-family: "Times New Roman", Times, serif;

  }

  ul li a:hover {
    color: white;

  }


  .slidershow {
    width: 100%;
    height: 500px;
    background-image: url(../images/main-slider7.jpg);
    background-position: center;
    background-size: cover;
    transition: 1s ease-in;
    border-radius: 4px;
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
      0 10px 10px rgba(0, 0, 0, 0.22);
  }

  .box {
    margin-bottom: 200px;
  }



  input,
  select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }

  input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  button {
    width: 100%;
    background-color: #80ED99;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  button:hover {
    background-color: #22577A;

  }

  input[type=submit]:hover {
    background-color: #45a049;
  }

  .footer {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: #57CC99;
    color: white;
    text-align: center;
    font-size: 1rem;
    margin-top: 200px;

  }
</style>
</head>

<body>
  <div class="container">
    <div class="logo">
      <a href="index.php"><img style="border-radius:50px" src="images/profile-photo.png" alt="" width="50" /></a>
    </div>
    <nav>
      <ul>
        <li><a href="student_check_results.php">Check your Results</a></li>
        <li><a href="admin_login.php">Login</a></li>
      </ul>
    </nav>
  </div>
  <hr />

  <h1 align="center">
    <p style="font-size:2rem">Catholic University of South Sudan</p>
  </h1>
  <h2 align="center">Student Results Web Application</h2>



  <section class="box">
    <form method="post">
      <div class="form-group">
        <label for="inputEmail3">Username</label>
        <input type="text" name="username" id="inputEmail3" placeholder="UserName">
      </div>
      <div class="form-group">
        <label for="inputPassword3">Password</label>
        <input type="password" name="password" id="inputPassword3" placeholder="Password">
      </div>



      <button type="submit" name="login">Sign in<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
      </div>
      </div>
    </form>
    </div>


  </section>
  <div class="footer">
    <p>Student Results Web Application Copyright (c) 2021</p>
  </div>

  <script src="js/jquery/jquery-2.2.4.min.js"></script>
  <script src="js/main.js"></script>


</body>

</html>