<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['submit'])) {
        $studentname = $_POST['fullanme'];
        $roolid = $_POST['rollid'];
        $studentemail = $_POST['emailid'];
        $gender = $_POST['gender'];
        $classid = $_POST['class'];
        $dob = $_POST['dob'];
        $status = 1;
        $sql = "INSERT INTO  tblstudents(StudentName,RollId,StudentEmail,Gender,ClassId,DOB,Status) VALUES(:studentname,:roolid,:studentemail,:gender,:classid,:dob,:status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':studentname', $studentname, PDO::PARAM_STR);
        $query->bindParam(':roolid', $roolid, PDO::PARAM_STR);
        $query->bindParam(':studentemail', $studentemail, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':classid', $classid, PDO::PARAM_STR);
        $query->bindParam(':dob', $dob, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $msg = "Student info added successfully";
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
        <title>Student Result Web ApplicationAdmin| Student Admission< </title>

                <link rel="stylesheet" href="css/custom.css?v=<?php echo time(); ?>" media="screen">
    </head>



    <style>
        input[type=text],
        input[type=email],
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


    <body>


        <!-- ========== TOP NAVBAR ========== -->
        <?php include('includes/topbar.php'); ?>
        <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->


        <?php include('includes/leftbar.php'); ?>
        <!-- /.left-sidebar -->
        </div>
        <div class="main-page">

            <h2 class="title">Student Admission</h2>



            <?php if ($msg) { ?>
                <div class="alert alert-success left-icon-alert" role="alert">
                    <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                </div><?php } else if ($error) { ?>
                <div class="alert alert-danger left-icon-alert" role="alert">
                    <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                </div>
            <?php } ?>
            <form method="post">

                <div class="form-group">
                    <label for="default" class="col-sm-2 control-label">Full Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="input" name="fullanme" class="form-control" id="fullanme" required="required" autocomplete="off">
                    </div>
                </div>

                <div class="form-group">
                    <label for="default" class="col-sm-2 control-label">Registration number</label>
                    <div class="col-sm-10">
                        <input type="text" name="rollid" class="form-control" id="rollid" maxlength="5" required="required" autocomplete="off">
                    </div>
                </div>

                <div class="form-group">
                    <label for="default" class="col-sm-2 control-label">Email Address</label>
                    <div class="col-sm-10">
                        <input type="email" name="emailid" class="form-control" id="email" required="required" autocomplete="off">
                    </div>
                </div>


                <br>
                <br>
                <div class="form-group">
                    <label for="default" class="col-sm-2 control-label">Gender</label>
                    <div class="col-sm-10">
                        <input type="radio" name="gender" value="Male" required="required" checked="">Male <input type="radio" name="gender" value="Female" required="required">Female <input type="radio" name="gender" value="Other" required="required">Other
                    </div>
                </div>
                <br>
                <br>
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
                    <label for="date" class="col-sm-2 control-label">DOB</label>
                    <div class="col-sm-10">
                        <input type="date" name="dob" class="form-control" id="date">
                    </div>
                </div>



                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>

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