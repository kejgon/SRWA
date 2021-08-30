<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "INSERT INTO  admin(UserName, Password) VALUES(:username,:password)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);

        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $msg = "Admin info added successfully";
        } else {
            $error = "Something went wrong. Please try again";
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin change password</title>

        <link rel="stylesheet" href="css/custom.css" media="screen">

        <style>
            .errorWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #dd3d36;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }

            .succWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #5cb85c;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }

            input[type=text],
            input[type=email],
            input[type=password],
            select {
                width: 50%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            input[type=submit] {
                width: 50%;
                background-color: #4CAF50;
                color: white;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            .main-page button {
                width: 50%;
                background-color: #80ED99;
                color: white;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            .main-page button:hover {
                background-color: #22577A;

            }
        </style>
    </head>

    <body>

        <?php include('includes/topbar.php'); ?>

        <?php include('includes/leftbar.php'); ?>
        <!-- /.left-sidebar -->

        <div class="main-page">

            <h2 class="title">Add new Admin</h2>

            <?php if ($msg) { ?>
                <div class="alert alert-success left-icon-alert" role="alert">
                    <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                </div><?php } else if ($error) { ?>
                <div class="alert alert-danger left-icon-alert" role="alert">
                    <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                </div>
            <?php } ?>

            <div class="panel-body">

                <form method="post">
                    <div class="form-group has-success">
                        <label for="success" class="control-label">Username</label>
                        <div class="">
                            <input type="text" name="username" class="form-control" required="required" id="success">

                        </div>
                    </div>
                    <div class="form-group has-success">
                        <label for="success" class="control-label">Password</label>
                        <div class="">
                            <input type="password" name="password" required="required" class="form-control" id="success">
                        </div>
                    </div>

                    <div class="form-group has-success">

                        <div class="">
                            <button type="submit" name="submit" class="btn btn-success btn-labeled">Add admin<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                        </div>



                </form>


            </div>
        </div>

        <script src="js/jquery/jquery-2.2.4.min.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>



    </body>

    </html>

<?PHP } ?>