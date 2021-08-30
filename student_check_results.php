<?php
session_start();
error_reporting(0);
include('includes/config.php');
if ($_SESSION['alogin'] != '') {
  $_SESSION['alogin'] = '';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sudent Result Checks</title>

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
    font-family: raleway;
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

  .box {
    margin-bottom: 200px;
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

  .paragraph {
    width: 60%;
    margin: 0 auto;
    margin-top: 50px;
    padding: 50px;
    text-align: left;
    font-size: 1.5rem
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

  .footer {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: #57CC99;
    color: white;
    text-align: center;
    font-size: 1rem;
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
    <form action="result.php" method="post">
      <div class="form-group">
        <label for="rollid">Enter your Registration number :</label>
        <div>
          <input type="text" class="form-control" id="rollid" placeholder="Enter Reg No." autocomplete="off" name="rollid">
        </div>
      </div>
      <div class="form-group">
        <label for="default" class="left">Program</label>
        <select name="class" class="form-control" id="default" required="required">
          <option value="">Select your Program</option>
          <?php $sql = "SELECT * from tblclasses";
          $query = $dbh->prepare($sql);
          $query->execute();
          $results = $query->fetchAll(PDO::FETCH_OBJ);
          if ($query->rowCount() > 0) {
            foreach ($results as $result) {   ?>
              <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->ClassName); ?>&nbsp; Section-<?php echo htmlentities($result->Section); ?></option>
          <?php }
          } ?>
        </select>
      </div>

      <button type="submit" class="btn">Search<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
      <div class="clearfix"></div>

    </form>

    </div>


    <div class="footer">
      <p>Student Results Web Application Copyright (c) 2021</p>
    </div>


    <!-- ========== COMMON JS FILES ========== -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>

    <!-- ========== THEME JS ========== -->
    <script src="js/main.js"></script>
    <script>
      $(function() {

      });
    </script>

    <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
</body>

</html>