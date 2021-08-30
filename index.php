<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Results Web Application</title>

  <!-- <link rel="stylesheet" href="css/custom.css" media="screen" > -->
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

    .paragraph {
      width: 60%;
      margin: 0 auto;
      margin-top: 50px;
      padding: 50px;
      text-align: left;
      font-size: 1.5rem;
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







  <div class="container">

    <div class="slidershow"></div>
  </div>

  <div class="paragraph">
    <h2>Student Result Web Application</h2>

    <p>The Result published on net are for immediate information on the examinees. Although every effort is made to maintain the accuracy of the results error may creep in inadvertently due to extrareous reasons beyond the control of either concerned institution. Students are advise to verify their marks with the official hard copy issued from the respective Institution/College.</p>
  </div>

  <div class="footer">
    <p>Student Results Web Application Copyright (c) 2021</p>
  </div>



  <script type="text/javascript">
    var slidershow = document.querySelector(".slidershow");
    var count = 0;
    var images = ['images/main-slider1.jpg', 'images/main-slider2.jpg', 'images/main-slider3.jpg', 'images/main-slider4.jpg', 'images/main-slider5.jpg'];
    var limit = images.length - 1;

    window.addEventListener("load", () => {
      setInterval(() => {
        if (count == limit) {
          count = 0;
        } else {
          count++;
        }
        slidershow.style.backgroundImage = `URL(${images[count]})`;
      }, 2000);
    });
  </script>
</body>

</html>