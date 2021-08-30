<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['update'])) {
        $classname = $_POST['classname'];
        $classnamenumeric = $_POST['classnamenumeric'];
        $section = $_POST['section'];
        $cid = intval($_GET['classid']);
        $sql = "update  tblclasses set ClassName=:classname,ClassNameNumeric=:classnamenumeric,Section=:section where id=:cid ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':classname', $classname, PDO::PARAM_STR);
        $query->bindParam(':classnamenumeric', $classnamenumeric, PDO::PARAM_STR);
        $query->bindParam(':section', $section, PDO::PARAM_STR);
        $query->bindParam(':cid', $cid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Data has been updated successfully";
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Update Program</title>
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

    <body>
        <div>

            <!-- ========== TOP NAVBAR ========== -->
            <?php include('includes/topbar.php'); ?>

            <?php include('includes/leftbar.php'); ?>
        </div>
        <div class="main-page">

            <h2 class="title">Update Student program</h2>


            <?php if ($msg) { ?>
                <div role="alert">
                    <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                </div><?php } else if ($error) { ?>
                <divrole="alert">
                    <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                    </divrole=>
                <?php } ?>

                <form method="post">
                    <?php
                    $cid = intval($_GET['classid']);
                    $sql = "SELECT * from tblclasses where id=:cid";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':cid', $cid, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                        foreach ($results as $result) {   ?>

                            <div>
                                <label for="success" class="control-label">Program Name</label>
                                <div class="">
                                    <input type="text" name="classname" value="<?php echo htmlentities($result->ClassName); ?>" required="required" class="form-control" id="success">
                                    <span class="help-block">E.g > Computer Science, Law, Social Sciecnce etc ..</span>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label for="success" class="control-label">The year of the program</label>
                                <div class="">
                                    <input type="number" name="classnamenumeric" value="<?php echo htmlentities($result->ClassNameNumeric); ?>" required="required" class="form-control" id="success">
                                    <span class="help-block">Eg > 1,2,4,5 etc</span>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label for="success" class="control-label">Semster</label>
                                <div class="">
                                    <input type="text" name="section" value="<?php echo htmlentities($result->Section); ?>" class="form-control" required="required" id="success">
                                    <span class="help-block">Eg- Semester 1, Semester 2</span>
                                </div>
                            </div>
                    <?php }
                    } ?>
                    <div class="form-group has-success">

                        <div class="">
                            <button type="submit" name="update" class="btn btn-success btn-labeled">Update<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                        </div>



                </form>


        </div>



        <?php include('includes/footer.php'); ?>

        <script src="js/jquery/jquery-2.2.4.min.js"></script>

        <script src="js/main.js"></script>



    </body>

    </html>
<?php  } ?>