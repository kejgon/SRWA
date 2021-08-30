<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Student Result Management System | Dashboard</title>

        <link rel="stylesheet" href="css/custom.css?v=<?php echo time(); ?>" media="screen">
    </head>

    <style>
        .main-page {
            display: flex;
        }

        .box1,
        .box2,
        .box3,
        .box4 {
            width: 30%;
            border: 1px solid #eee;
            display: flexbox;
            padding: 3% 4%;
            margin: 5px 10px;
            float: left;

        }

        .title {
            font-size: 2rem;
            margin: 50px 0 20px 100px;
            color: #F43B86;


        }

        span {
            color: white;

        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .box1 {
            background-color: #F43B86;
        }

        .box2 {
            background-color: #11324D;
        }

        .box3 {
            background-color: #3E2C41;
        }

        .box4 {
            background-color: #035397;
        }

        footer {
            clear: both;
        }
    </style>

    <body>
        <div>
            <?php include('includes/topbar.php'); ?>
            <div class="content-wrapper">
                <div>

                    <?php include('includes/leftbar.php'); ?>

                    <h2 class="title">Dashboard</h2>

                    <div class="main-page">



                        <div class="box1">

                            <a href="manage-students.php">
                                <?php
                                $sql1 = "SELECT StudentId from tblstudents ";
                                $query1 = $dbh->prepare($sql1);
                                $query1->execute();
                                $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                $totalstudents = $query1->rowCount();
                                ?>

                                <span class="number counter"><?php echo htmlentities($totalstudents); ?></span>
                                <span class="name">Registered Students </span>
                                <span class="bg-icon"><i class="fa fa-users"></i></span>
                            </a>
                        </div>

                        <div class="box2">
                            <a href="manage-subjects.php">
                                <?php
                                $sql = "SELECT id from  tblsubjects ";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $totalsubjects = $query->rowCount();
                                ?>
                                <span class="number counter"><?php echo htmlentities($totalsubjects); ?></span>
                                <span class="name">Courses Listed</span>
                                <span class="bg-icon"><i class="fa fa-ticket"></i></span>
                            </a>

                        </div>

                        <div class="box3">
                            <a href="manage-classes.php">
                                <?php
                                $sql2 = "SELECT id from  tblclasses ";
                                $query2 = $dbh->prepare($sql2);
                                $query2->execute();
                                $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
                                $totalclasses = $query2->rowCount();
                                ?>
                                <span class="number counter"><?php echo htmlentities($totalclasses); ?></span>
                                <span class="name">Programs listed</span>
                                <span class="bg-icon"><i class="fa fa-bank"></i></span>
                            </a>
                        </div>

                        <div class="box4">
                            <a href="manage-results.php">
                                <?php
                                $sql3 = "SELECT  distinct StudentId from  tblresult ";
                                $query3 = $dbh->prepare($sql3);
                                $query3->execute();
                                $results3 = $query3->fetchAll(PDO::FETCH_OBJ);
                                $totalresults = $query3->rowCount();
                                ?>

                                <span class="number counter"><?php echo htmlentities($totalresults); ?></span>
                                <span class="name">Results Declared</span>
                                <span class="bg-icon"><i class="fa fa-file-text"></i></span>
                            </a>
                            <!-- /.dashboard-stat -->
                        </div>

                    </div>


                </div>



                <?php include('includes/footer.php'); ?>

                <script src="js/jquery/jquery-2.2.4.min.js"></script>

                <!-- ========== THEME JS ========== -->
                <script src="js/main.js"></script>

                <script>
                    $(function() {

                        // Counter for dashboard stats
                        $('.counter').counterUp({
                            delay: 10,
                            time: 1000
                        });

                        // Welcome notification
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        toastr["success"]("Welcome to student Result Management System!");

                    });
                </script>
    </body>


    </html>
<?php } ?>