<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['submit'])) {
        $password = md5($_POST['password']);
        $newpassword = md5($_POST['newpassword']);
        $username = $_SESSION['alogin'];
        $sql = "SELECT Password FROM admin WHERE UserName=:username and Password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            $con = "update admin set Password=:newpassword where UserName=:username";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1->bindParam(':username', $username, PDO::PARAM_STR);
            $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();
            $msg = "Your Password succesfully changed";
        } else {
            $error = "Your current password is wrong";
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

        <link rel="stylesheet" href="css/custom.css?v=<?php echo time(); ?>" media="screen">
        <script type="text/javascript">
            function valid() {
                if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
                    alert("New Password and Confirm Password Field do not match  !!");
                    document.chngpwd.confirmpassword.focus();
                    return false;
                }
                return true;
            }
        </script>
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

            <h2 class="title">Update Password</h2>

            <?php if ($msg) { ?>
                <div class="alert alert-success left-icon-alert" role="alert">
                    <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                </div><?php } else if ($error) { ?>
                <div class="alert alert-danger left-icon-alert" role="alert">
                    <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                </div>
            <?php } ?>

            <div class="panel-body">

                <form name="chngpwd" method="post" \ onSubmit="return valid();">
                    <div class="form-group has-success">
                        <label for="success" class="control-label">Current Password</label>
                        <div class="">
                            <input type="password" name="password" class="form-control" required="required" id="success">

                        </div>
                    </div>
                    <div class="form-group has-success">
                        <label for="success" class="control-label">New Password</label>
                        <div class="">
                            <input type="password" name="newpassword" required="required" class="form-control" id="success">
                        </div>
                    </div>
                    <div class="form-group has-success">
                        <label for="success" class="control-label">Confirm Password</label>
                        <div class="">
                            <input type="password" name="confirmpassword" class="form-control" required="required" id="success">
                        </div>
                    </div>
                    <div class="form-group has-success">

                        <div class="">
                            <button type="submit" name="submit" class="btn btn-success btn-labeled">Change<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                        </div>



                </form>


            </div>
        </div>


        <?php include('includes/footer.php'); ?>

        <script src="js/jquery/jquery-2.2.4.min.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>



    </body>

    </html>
<?php  } ?>