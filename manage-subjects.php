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
        <title>Admin Manage Course</title>
        <link rel="stylesheet" href="css/custom.css?v=<?php echo time(); ?>" media="screen">
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


            table,
            td,
            th {
                border: 1px solid #ddd;
                text-align: left;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }

            th,
            td {
                padding: 15px;
            }

            td a {
                text-decoration: none;
                color: #22577A;
            }

            td a:hover {
                text-decoration: none;
                color: #2A0944;
            }
        </style>
    </head>

    <body>


        <!-- ========== TOP NAVBAR ========== -->
        <?php include('includes/topbar.php'); ?>


        <?php include('includes/leftbar.php'); ?>

        </div>
        <div class="main-page">

            <h2 class="title">Manage Courses</h2>


            <?php if ($msg) { ?>
                <div class="alert alert-success left-icon-alert" role="alert">
                    <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                </div><?php } else if ($error) { ?>
                <div class="alert alert-danger left-icon-alert" role="alert">
                    <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                </div>
            <?php } ?>
            <div class="panel-body p-20">

                <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Unit Name</th>
                            <th>Unit Code</th>

                            <th>Edit</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $sql = "SELECT * from tblsubjects";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) {   ?>
                                <tr>
                                    <td><?php echo htmlentities($cnt); ?></td>
                                    <td><?php echo htmlentities($result->SubjectName); ?></td>
                                    <td><?php echo htmlentities($result->SubjectCode); ?></td>

                                    <td>
                                        <a href="edit-subject.php?subjectid=<?php echo htmlentities($result->id); ?>"><i title="Edit Record">Update</i> </a>

                                    </td>
                                </tr>
                        <?php $cnt = $cnt + 1;
                            }
                        } ?>


                    </tbody>
                </table>


            </div>
        </div>



        <?php include('includes/footer.php'); ?>

        <script src="js/jquery/jquery-2.2.4.min.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>

    </body>

    </html>
<?php } ?>