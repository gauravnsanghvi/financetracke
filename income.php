<?php
include("session.php");
$update = false;
$del = false;
$incomeamount = "";
$incomedate = date("Y-m-d");
$incomecategory = "";
if (isset($_POST['add'])) {
    $incomeamount = $_POST['incomeamount'];
    $incomedate = $_POST['incomedate'];
    $incomecategory = $_POST['incomecategory'];

    $income = "INSERT INTO income (user_id, income,income_date,incomecategory) VALUES ('$userid', '$incomeamount','$incomedate','$incomecategory')";
    $result = mysqli_query($con, $income) or die("Something Went Wrong!");
    header('location: income.php');
}

if (isset($_POST['update'])) {
    $id = $_GET['edit'];
    $incomeamount = $_POST['incomeamount'];
    $incomedate = $_POST['incomedate'];
    $incomecategory = $_POST['incomecategory'];

    $sql = "UPDATE income SET income='$incomeamount', income_date='$incomedate', incomecategory='$incomecategory' WHERE user_id='$userid' AND id='$id'";
    if (mysqli_query($con, $sql)) {
        echo "Records were updated successfully.";
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }
    header('location: manage_income.php');
}

if (isset($_POST['delete'])) {
    $id = $_GET['delete'];
    $incomeamount = $_POST['incomeamount'];
    $incomedate = $_POST['incomedate'];
    $incomecategory = $_POST['incomecategory'];

    $sql = "DELETE FROM income WHERE user_id='$userid' AND id='$id'";
    if (mysqli_query($con, $sql)) {
        echo "Records were updated successfully.";
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }
    header('location: manage_income.php');
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($con, "SELECT * FROM income WHERE user_id='$userid' AND id=$id");
    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);
        $incomeamount = $n['income'];
        $incomedate = $n['income_date'];
        $incomecategory = $n['incomecategory'];
    } else {
        echo ("WARNING: AUTHORIZATION ERROR: Trying to Access Unauthorized data");
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $del = true;
    $record = mysqli_query($con, "SELECT * FROM income WHERE user_id='$userid' AND id=$id");

    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);
        $incomeamount = $n['income'];
        $incomedate = $n['income_date'];
        $incomecategory = $n['incomecategory'];
    } else {
        echo ("WARNING: AUTHORIZATION ERROR: Trying to Access Unauthorized data");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Expense Manager - Dashboard</title>
    

    <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/style.css" rel="stylesheet">

    <!-- Feather JS for Icons -->
    <script src="js/feather.min.js"></script>
<style>
    .try {
  font-size: 28px; /* Adjust the font size as needed */
  color: #333;    /* Adjust the color as needed */
  padding: 15px 70px 5px 0px;   /* Adjust the padding as needed */
}
</style>
</head>

<body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
    <div class="border-right" id="sidebar-wrapper">
      <div class="user">
        <img class="img img-fluid rounded-circle" src="uploads\default_profile.png" width="120">
        <h5><?php echo $username ?></h5>
        <p><?php echo $useremail ?></p>
      </div>
      <div class="sidebar-heading">Management</div>
      <div class="list-group list-group-flush">
        <a href="index.php" class="list-group-item list-group-item-action"><span data-feather="home"></span> Dashboard</a>
        <a href="add_expense.php" class="list-group-item list-group-item-action"><span data-feather="plus-square"></span> Add Expenses</a>
        <a href="income.php" class="list-group-item list-group-item-action sidebar-active"><span data-feather="plus-square"></span> Add Income</a>
        <a href="manage_expense.php" class="list-group-item list-group-item-action "><span data-feather="dollar-sign"></span> Manage Expenses</a>
        <a href="manage_income.php" class="list-group-item list-group-item-action "><span data-feather="dollar-sign"></span> Manage Income</a>
        <a href="expensereport.php" class="list-group-item list-group-item-action"><span data-feather="file-text"></span> Expense Report</a>
      </div>
      <div class="sidebar-heading">Settings </div>
      <div class="list-group list-group-flush">
        <a href="profile.php" class="list-group-item list-group-item-action "><span data-feather="user"></span> Profile</a>
        <a href="logout.php" class="list-group-item list-group-item-action "><span data-feather="power"></span> Logout</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light  border-bottom">


                <button class="toggler" type="button" id="menu-toggle" aria-expanded="false">
                    <span data-feather="menu"></span>
                </button>
                <div class="col-md-12 text-center">
    <h3 class="try">Add Your Income</h3>
</div>

                <hr>                        
            </nav>

            <div class="container">
               
                <div class="row ">

                    <div class="col-md-3"></div>

                    <div class="col-md" style="margin:0 auto;">
                        <form action="" method="POST">
                            <div class="form-group row" style="margin-top: 20px;">
                                <label for="incomeamount" class="col-sm-6 col-form-label"><b>Enter Amount</b></label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control col-sm-12" value="<?php echo $incomeamount; ?>" id="incomeamount" name="incomeamount" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="incomedate" class="col-sm-6 col-form-label"><b>Date</b></label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control col-sm-12" value="<?php echo $incomedate; ?>" name="incomedate" id="incomedate" required>
                                </div>
                            </div>
<fieldset class="form-group">
    <div class="row">
        <label class="col-form-label col-sm-6 pt-0"><b>Category</b></label>
        <div class="col-md">
            <select class="form-control" id="incomecategory" name="incomecategory" required>
                <?php
                $categories_query = "SELECT * FROM income_categories";
                $categories_result = mysqli_query($con, $categories_query);

                while ($row = mysqli_fetch_assoc($categories_result)) {
                    $category_name = $row['category_name'];
                    $selected = ($category_name === $incomecategory) ? 'selected' : '';
                    echo "<option value=\"$category_name\" $selected>$category_name</option>";
                }
                ?>
            </select>
        </div>
    </div>
</fieldset>

                            <div class="form-group row">
                                <div class="col-md-12 text-right">
                                    <?php if ($update == true) : ?>
                                        <button class="btn btn-lg btn-block btn-warning" style="border-radius: 0%;" type="submit" name="update">Update</button>
                                    <?php elseif ($del == true) : ?>
                                        <button class="btn btn-lg btn-block btn-danger" style="border-radius: 0%;" type="submit" name="delete">Delete</button>
                                    <?php else : ?>
                                        <button type="submit" name="add" class="btn btn-lg btn-block btn-success" style="border-radius: 0%;">Add Income</button>
                                    <?php endif ?>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-3"></div>
                    
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
     <!-- Bootstrap core JavaScript -->
  <script src="js/jquery.slim.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/Chart.min.js"></script>    
  <script src="js/popper.min.js"></script>  
    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    <script>
        feather.replace();
    </script>
    <script>

    </script>
</body>
</html>