<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['submit'])) {
        $cat1s = array();
        $cat2s = array();
        $exams = array();
        $class = $_POST['class'];
        $studentid = $_POST['studentid'];
        $cat1 = $_POST['cat1s'];
        $cat2 = $_POST['cat2s'];
        $exam = $_POST['exams'];

        $stmt = $dbh->prepare("SELECT tblsubjects.SubjectName,tblsubjects.id FROM tblsubjectcombination join  tblsubjects on  tblsubjects.id=tblsubjectcombination.SubjectId WHERE tblsubjectcombination.ClassId=:cid order by tblsubjects.SubjectName");
        $stmt->execute(array(':cid' => $class));
        $sid1 = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            array_push($sid1, $row['id']);
        }

        for ($i = 0; $i < count($exam); $i++) {
            $exam_s = $exam[$i];

            $cat_1 = $cat1[$i];

            $cat_2 = $cat2[$i];

            $sid = $sid1[$i];
            $sql = "INSERT INTO  tblresult(StudentId,ClassId,SubjectId,cat1,cat2,exam) VALUES(:studentid,:class,:sid,:cat1s,:cat2s,:exams)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':studentid', $studentid, PDO::PARAM_STR);
            $query->bindParam(':class', $class, PDO::PARAM_STR);
            $query->bindParam(':sid', $sid, PDO::PARAM_STR);
            $query->bindParam(':cat1s', $cat_1, PDO::PARAM_STR);
            $query->bindParam(':cat2s', $cat_2, PDO::PARAM_STR);
            $query->bindParam(':exams', $exam_s, PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();
            if ($lastInsertId) {
                $msg = "Result info added successfully";
            } else {
                $error = "Something went wrong. Please try again";
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
        <title>Student Result Web Application Admin| Add Result </title>

        <link rel="stylesheet" href="css/custom.css?v=<?php echo time(); ?>" media="screen">


        <script>
            function getStudent(val) {
                $.ajax({
                    type: "POST",
                    url: "get_student.php",
                    data: 'classid=' + val,
                    success: function(data) {
                        $("#studentid").html(data);

                    }
                });
                $.ajax({
                    type: "POST",
                    url: "get_student.php",
                    data: 'classid1=' + val,
                    success: function(data) {
                        $("#subject").html(data);

                    }
                });
            }
        </script>
        <script>
            function getresult(val, clid) {

                var clid = $(".clid").val();
                var val = $(".stid").val();;
                var abh = clid + '$' + val;
                //alert(abh);
                $.ajax({
                    type: "POST",
                    url: "get_student.php",
                    data: 'studclass=' + abh,
                    success: function(data) {
                        $("#reslt").html(data);

                    }
                });
            }
        </script>


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


    </head>

    <body>


        <!-- ========== TOP NAVBAR ========== -->
        <?php include('includes/topbar.php'); ?>


        <!-- ========== LEFT SIDEBAR ========== -->
        <?php include('includes/leftbar.php'); ?>
        <!-- /.left-sidebar -->

        <div class="main-page">


            <h2 class="title">Enter Student Results</h2>

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
                    <label for="default">Program</label>
                    <div>
                        <select name="class" id="classid" onChange="getStudent(this.value);" required="required">
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
                    <label for="date">Student Name</label>
                    <div>
                        <select name="studentid" id="studentid" required="required" onChange="getresult(this.value);">
                        </select>
                    </div>
                </div>

                <div class="form-group">

                    <div>
                        <div id="reslt">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="date">Courses</label>
                    <div>
                        <div id="subject">
                        </div>
                    </div>
                </div>



                <div class="form-group">
                    <div>
                        <button type="submit" name="submit" id="submit">Add Result</button>
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

            function myFunction() {
                var x = document.getElementById("myTopnav");
                if (x.className === "topnav") {
                    x.className += " responsive";
                } else {
                    x.className = "topnav";
                }
            }
        </script>
    </body>

    </html>
<?PHP } ?>