<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    // for activate Subject   	
    if (isset($_GET['acid'])) {
        $acid = intval($_GET['acid']);
        $status = 1;
        $sql = "update tblsubjectcombination set status=:status where id=:acid ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':acid', $acid, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $msg = "Subject Activate successfully";
    }

    // for Deactivate Subject
    if (isset($_GET['did'])) {
        $did = intval($_GET['did']);
        $status = 0;
        $sql = "update tblsubjectcombination set status=:status where id=:did ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':did', $did, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $msg = "Subject Deactivate successfully";
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Manage Subjects Combination</title>

        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">

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
        <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->

        <?php include('includes/leftbar.php'); ?>
        </div>

        <div class="main-page">
            <h2 class="title">Manage Subjects Combination</h2>

            <?php if ($msg) { ?>
                <div style='color: #66DE93' role="alert">
                    <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                </div><?php } else if ($error) { ?>
                <div style='color: #D83A56' role="alert">
                    <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                </div>
            <?php } ?>
            <div class="panel-body p-20">

                <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Program and Semester</th>
                            <th>Course </th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $sql = "SELECT tblclasses.ClassName,tblclasses.Section,tblsubjects.SubjectName,tblsubjectcombination.id as scid,tblsubjectcombination.status from tblsubjectcombination join tblclasses on tblclasses.id=tblsubjectcombination.ClassId  join tblsubjects on tblsubjects.id=tblsubjectcombination.SubjectId";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) {   ?>
                                <tr>
                                    <td><?php echo htmlentities($cnt); ?></td>
                                    <td><?php echo htmlentities($result->ClassName); ?> &nbsp; Section-<?php echo htmlentities($result->Section); ?></td>
                                    <td><?php echo htmlentities($result->SubjectName); ?></td>
                                    <td><?php $stts = $result->status;
                                        if ($stts == '0') {
                                            echo htmlentities('Inactive');
                                        } else {
                                            echo htmlentities('Active');
                                        }
                                        ?></td>

                                    <td>
                                        <?php if ($stts == '0') { ?>
                                            <a href="manage-subjectcombination.php?acid=<?php echo htmlentities($result->scid); ?>" onclick="confirm('do you really want to activate this subject');"><i class="fa fa-check" title="Acticvate Record"></i> </a><?php } else { ?>

                                            <a href="manage-subjectcombination.php?did=<?php echo htmlentities($result->scid); ?>" onclick="confirm('do you really want to deativate this subject');"><i class="fa fa-times" title="Deactivate Record"></i> </a>
                                        <?php } ?>
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

        <script src="js/main.js"></script>

    </body>

    </html>
<?php } ?>