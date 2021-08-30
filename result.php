<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Result Web Application</title>

    <link rel="stylesheet" href="css/custom.css" media="screen">

</head>
<style>
    table {
        width: 100%;
        margin: 10px auto;
        table-layout: auto;
    }

    .fixed {
        table-layout: fixed;
    }

    table,
    td,
    th {
        border-collapse: collapse;
    }

    th,
    td {
        padding: 1px;
        border: solid 1px;
        text-align: center;
    }
</style>

<body>
    <div class="main-wrapper">
        <div class="content-wrapper">
            <div class="content-container">



                <div class="main-page">


                    <img align="center" style="border-radius:50px; margin:0 auto; " src="images/profile-photo.png" alt="" width="50" />
                    <h2 class="title" align="center">Student Results Web Application</h2>

                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <?php
                                // code Student Data
                                $rollid = $_POST['rollid'];
                                $classid = $_POST['class'];
                                $_SESSION['rollid'] = $rollid;
                                $_SESSION['classid'] = $classid;
                                $qery = "SELECT   tblstudents.StudentName,tblstudents.RollId,tblstudents.RegDate,tblstudents.StudentId,tblstudents.Status,tblclasses.ClassName,tblclasses.Section from tblstudents join tblclasses on tblclasses.id=tblstudents.ClassId where tblstudents.RollId=:rollid and tblstudents.ClassId=:classid ";
                                $stmt = $dbh->prepare($qery);
                                $stmt->bindParam(':rollid', $rollid, PDO::PARAM_STR);
                                $stmt->bindParam(':classid', $classid, PDO::PARAM_STR);
                                $stmt->execute();
                                $resultss = $stmt->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($stmt->rowCount() > 0) {
                                    foreach ($resultss as $row) {   ?>
                                        <p><b>Student Name :</b> <?php echo htmlentities($row->StudentName); ?></p>
                                        <p><b>Student Reg No. :</b> <?php echo htmlentities($row->RollId); ?>
                                        <p><b>Student Class:</b> <?php echo htmlentities($row->ClassName); ?>(<?php echo htmlentities($row->Section); ?>)
                                        <?php }

                                        ?>
                            </div>
                            <div class="panel-body p-20">







                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Subject</th>
                                            <th>Cat1</th>
                                            <th>Cat2</th>
                                            <th>Exam </th>
                                            <th>Total Marks</th>
                                            <th>Grade</th>
                                        </tr>
                                    </thead>




                                    <tbody>
                                        <?php
                                        // Code for result

                                        $query = "select t.StudentName,t.RollId,t.ClassId,t.cat1,t.cat2,t.exam,SubjectId,tblsubjects.SubjectName from (select sts.StudentName,sts.RollId,sts.ClassId,tr.cat1,tr.cat2,tr.exam,SubjectId from tblstudents as sts join  tblresult as tr on tr.StudentId=sts.StudentId) as t join tblsubjects on tblsubjects.id=t.SubjectId where (t.RollId=:rollid and t.ClassId=:classid)";
                                        $query = $dbh->prepare($query);
                                        $query->bindParam(':rollid', $rollid, PDO::PARAM_STR);
                                        $query->bindParam(':classid', $classid, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        // $cnt=1;
                                        if ($countrow = $query->rowCount() > 0) {

                                            foreach ($results as $result) {

                                        ?>

                                                <tr>
                                                    <td><?php echo htmlentities($cnt); ?></td>
                                                    <td><?php echo htmlentities($result->SubjectName); ?></td>
                                                    <td><?php echo htmlentities($result->cat1); ?></td>
                                                    <td><?php echo htmlentities($result->cat2); ?></td>
                                                    <td><?php echo htmlentities($result->exam); ?></td>
                                                    <td><?php echo htmlentities($totalmarks = (($result->cat1) + ($result->cat2) + ($result->exam))); ?></td>
                                                    <?php //Calculating the Grades
                                                    $grade = "";

                                                    if ($totalmarks >= 70 && $totalmarks <= 100) {
                                                        $grade = "A";
                                                    } else if ($totalmarks >= 60 && $totalmarks <= 69) {
                                                        $grade = "B";
                                                    } else if ($totalmarks >= 50 && $totalmarks <= 59) {
                                                        $grade = "C";
                                                    } else if ($totalmarks >= 40 && $totalmarks <= 49) {
                                                        $grade = "D";
                                                    } else {
                                                        $grade = "F";
                                                    }

                                                    $cnt++;

                                                    ?>
                                                    <td><?php echo htmlentities($grade); ?></td>
                                                </tr>
                                            <?php

                                            }
                                            ?>

                                            <tr id="last">
                                                <th scope="row" colspan="2">Download Result</th>
                                                <td><b><button id="download" type="button">Clear </button> </b></td>
                                            </tr>
                                            <td><b><button type="button" onclick="window.print();">Print </button> </b></td>
                                            </tr>

                                        <?php } else { ?>
                                            <div class="alert alert-warning left-icon-alert" role="alert">
                                                <strong>Notice!</strong> Your result not Added yet
                                            <?php }
                                            ?>
                                            </div>
                                        <?php
                                    } else { ?>

                                            <div class="alert alert-danger left-icon-alert" role="alert">
                                            <?php
                                            echo htmlentities("Please Check Your Registration Number");
                                        }
                                            ?>
                                            </div>



                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-md-6 -->

                    <div id="last" class="form-group">

                        <div class="col-sm-6">
                            <a href="student_check_results.php">Back to Check result</a>
                        </div>
                    </div>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
            </section>
            <!-- /.section -->

        </div>
        <!-- /.main-page -->


    </div>
    <!-- /.main-wrapper -->

    <!-- ========== COMMON JS FILES ========== -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>


    <!-- ========== THEME JS ========== -->
    <script src="js/main.js"></script>
    <script>
        $("#download").click(function() {
            $("#last").css("display", "none");
        });
    </script>


</body>

</html>