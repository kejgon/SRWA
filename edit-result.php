<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {

    $stid = intval($_GET['stid']);
    if (isset($_POST['submit'])) {

        $rowid = $_POST['id'];
        $cat1s = $_POST['cat1'];
        $cat2s = $_POST['cat2'];
        $exams = $_POST['exam'];
        // $marks=$_POST['marks']; 

        foreach ($_POST['id'] as $count => $id) {
            $cat1 = $cat1s[$count];
            $cat2 = $cat2s[$count];
            $exam = $exams[$count];
            // $mrks=$marks[$count];
            $iid = $rowid[$count];
            for ($i = 0; $i <= $count; $i++) {

                $sql = "update tblresult  set cat1=:cat1,cat2=:cat2,exam=:exam where id=:iid ";
                $query = $dbh->prepare($sql);
                $query->bindParam(':cat1', $cat1, PDO::PARAM_STR);
                $query->bindParam(':cat2', $cat2, PDO::PARAM_STR);
                $query->bindParam(':exam', $exam, PDO::PARAM_STR);
                $query->bindParam(':iid', $iid, PDO::PARAM_STR);
                $query->execute();

                $msg = "Result info updated successfully";
            }
        }
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Student result info infos </title>
        <link rel="stylesheet" href="css/custom.css?v=<?php echo time(); ?>" media="screen">
    </head>



    <style>
        input,
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

    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
            <?php include('includes/topbar.php'); ?>
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

                    <!-- ========== LEFT SIDEBAR ========== -->
                    <?php include('includes/leftbar.php'); ?>
                    <!-- /.left-sidebar -->

                    <div class="main-page">

                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Student Results </h2>

                                </div>

                            </div>

                        </div>
                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h5>Update the Result info</h5>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <?php if ($msg) { ?>
                                                <div style='color: #66DE93' role="alert">
                                                    <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                                                </div><?php } else if ($error) { ?>
                                                <div style='color: #D83A56' role="alert">
                                                    <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                                </div>
                                            <?php } ?>
                                            <form class="form-horizontal" method="post">

                                                <?php

                                                $ret = "SELECT tblstudents.StudentName,tblclasses.ClassName,tblclasses.Section from tblresult join tblstudents on tblresult.StudentId=tblresult.StudentId join tblsubjects on tblsubjects.id=tblresult.SubjectId join tblclasses on tblclasses.id=tblstudents.ClassId where tblstudents.StudentId=:stid limit 1";
                                                $stmt = $dbh->prepare($ret);
                                                $stmt->bindParam(':stid', $stid, PDO::PARAM_STR);
                                                $stmt->execute();
                                                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($stmt->rowCount() > 0) {
                                                    foreach ($result as $row) {  ?>


                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">Program</label>
                                                            <div class="col-sm-10">
                                                                <?php echo htmlentities($row->ClassName) ?>(<?php echo htmlentities($row->Section) ?>)
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">Full Name</label>
                                                            <div class="col-sm-10">
                                                                <?php echo htmlentities($row->StudentName); ?>
                                                            </div>
                                                        </div>
                                                        <br><br>
                                                <?php }
                                                } ?>



                                                <?php
                                                $sql = "SELECT distinct tblstudents.StudentName,tblstudents.StudentId,tblclasses.ClassName,tblclasses.Section,tblsubjects.SubjectName,tblresult.cat1,tblresult.cat2,tblresult.exam,tblresult.id as resultid from tblresult join tblstudents on tblstudents.StudentId=tblresult.StudentId join tblsubjects on tblsubjects.id=tblresult.SubjectId join tblclasses on tblclasses.id=tblstudents.ClassId where tblstudents.StudentId=:stid ";
                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':stid', $stid, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {  ?>



                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label"><?php echo htmlentities($result->SubjectName) ?></label>
                                                            <div class="col-sm-10">
                                                                <input type="hidden" name="id[]" value="<?php echo htmlentities($result->resultid) ?>">
                                                                <input type="text" name="cat1[]" class="form-control" id="cat1s" value="<?php echo htmlentities($result->cat1) ?>" maxlength="5" required="required" autocomplete="off">
                                                                <input type="text" name="cat2[]" class="form-control" id="cat2s" value="<?php echo htmlentities($result->cat2) ?>" maxlength="5" required="required" autocomplete="off">
                                                                <input type="text" name="exam[]" class="form-control" id="marks" value="<?php echo htmlentities($result->exam) ?>" maxlength="5" required="required" autocomplete="off">
                                                            </div>
                                                        </div>




                                                <?php }
                                                } ?>

                                                <br><br>

                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <!-- /.col-md-12 -->
                            </div>
                        </div>
                    </div>
                    <!-- /.content-container -->
                </div>
                <!-- /.content-wrapper -->
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