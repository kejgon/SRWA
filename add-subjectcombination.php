<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['submit'])) {
        $class = $_POST['class'];
        $subject = $_POST['subject'];
        $status = 1;
        $sql = "INSERT INTO  tblsubjectcombination(ClassId,SubjectId,status) VALUES(:class,:subject,:status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':class', $class, PDO::PARAM_STR);
        $query->bindParam(':subject', $subject, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $msg = "Combination added successfully";
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
        <title>Student Result Web Application Admin | Subject Combination< </title>

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
        <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->

        <!-- ========== LEFT SIDEBAR ========== -->
        <?php include('includes/leftbar.php'); ?>
        <!-- /.left-sidebar -->
        </div>
        <div class="main-page">

            <h3>Adding Courses to a particular Program</h3>

            <?php if ($msg) { ?>
                <div class="alert alert-success left-icon-alert" role="alert">
                    <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                </div><?php } else if ($error) { ?>
                <div class="alert alert-danger left-icon-alert" role="alert">
                    <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                </div>
            <?php } ?>
            <form class="form-horizontal" method="post">
                <div class="form-group">
                    <label for="default" class="col-sm-2 control-label">Program</label>
                    <div class="col-sm-10">
                        <select name="class" class="form-control" id="default" required="required">
                            <option value="">Select Program</option>
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
                </div>
                <div class="form-group">
                    <label for="default" class="col-sm-2 control-label">Course</label>
                    <div class="col-sm-10">
                        <select name="subject" class="form-control" id="default" required="required">
                            <option value="">Select Course</option>
                            <?php $sql = "SELECT * from tblsubjects";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) {   ?>
                                    <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->SubjectName); ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                </div>



                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>

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