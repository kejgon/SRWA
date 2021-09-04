<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['submit'])) {
        $subjectname = $_POST['subjectname'];
        $subjectcode = $_POST['subjectcode'];
        $sql = "INSERT INTO  tblsubjects(SubjectName,SubjectCode) VALUES(:subjectname,:subjectcode)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':subjectname', $subjectname, PDO::PARAM_STR);
        $query->bindParam(':subjectcode', $subjectcode, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $msg = "Subject Created successfully";
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
        <title>SMS Admin course Creation </title>

        <link rel="stylesheet" href="css/custom.css?v=<?php echo time(); ?>" media="screen">
    </head>


    <style>
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
    </style>


    <body>


        <!-- ========== TOP NAVBAR ========== -->
        <?php include('includes/topbar.php'); ?>


        <div class="content-wrapper">
            <div class="content-container">

                <!-- ========== LEFT SIDEBAR ========== -->
                <?php include('includes/leftbar.php'); ?>
                <!-- /.left-sidebar -->

                <div class="main-page">

                    <h2 class="title">Course Creation</h2>


                    <div class="panel-body">
                        <?php if ($msg) { ?>
                            <div style='color: #66DE93' role="alert">
                                <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                            </div><?php } else if ($error) { ?>
                            <div style='color: #D83A56' role="alert">
                                <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                            </div>
                        <?php } ?>
                        <form method="post">
                            <div class="f">
                                <label for="default">Unit Name</label>
                                <div>
                                    <input type="text" name="subjectname" class="form-control" id="default" placeholder="Subject Name" required="required">
                                </div>
                            </div>

                            <label>Unit Code</label>
                            <div>
                                <input type="text" name="subjectcode" class="form-control" id="default" placeholder="Subject Code" required="required">
                            </div>





                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>

                        </form>

                    </div>
                </div>
            </div>
            <!-- /.col-md-12 -->
        </div>
        </div>

        <?php include('includes/footer.php'); ?>

        <script src="js/jquery/jquery-2.2.4.min.js"></script>

        <script src="js/main.js"></script>


        <script>
            $(function($) {
                $(".js-states").select2();
                $(".js-states-limit").select2({
                    maximumSelectionLength: 2
                });
                $(".js-states-hide").select2({
                    minimumResultsForSearch: Infinity
                });
            });
        </script>
    </body>

    </html>
<?PHP } ?>