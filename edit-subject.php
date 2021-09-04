<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['Update'])) {
        $sid = intval($_GET['subjectid']);
        $subjectname = $_POST['subjectname'];
        $subjectcode = $_POST['subjectcode'];
        $sql = "update  tblsubjects set SubjectName=:subjectname,SubjectCode=:subjectcode where id=:sid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':subjectname', $subjectname, PDO::PARAM_STR);
        $query->bindParam(':subjectcode', $subjectcode, PDO::PARAM_STR);
        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Subject Info updated successfully";
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SMS Admin Update Subject </title>
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

        <?php include('includes/leftbar.php'); ?>

        <div class="main-page">


            <h2 class="title">Update Course</h2>

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
                $sid = intval($_GET['subjectid']);
                $sql = "SELECT * from tblsubjects where id=:sid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) {   ?>
                        <div class="form-group">
                            <label for="default">Unit Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="subjectname" value="<?php echo htmlentities($result->SubjectName); ?>" class="form-control" id="default" placeholder="Subject Name" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="default">Unit Code</label>
                            <div class="col-sm-10">
                                <input type="text" name="subjectcode" class="form-control" value="<?php echo htmlentities($result->SubjectCode); ?>" id="default" placeholder="Subject Code" required="required">
                            </div>
                        </div>
                <?php }
                } ?>


                <button type="submit" name="Update" class="btn btn-primary">Update</button>

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