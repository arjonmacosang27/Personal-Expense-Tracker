

<?php
// Add the same database connection logic here at the very top
$con = mysqli_connect("localhost", "root", "", "detsdb"); 
?>
<div class="container">
    <p style="margin-top:20px;">
        <a href="add-collection.php" class="btn btn-info"> + Add New Entry</a>
    </p>
    
    <?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daily Collection Report - Jesus Nazareno Parish</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <?php include_once('includes/header.php');?>
    <?php include_once('includes/sidebar.php');?>
        
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><em class="fa fa-home"></em></a></li>
                <li class="active">Daily Collection Report</li>
            </ol>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <strong>JESUS NAZARENO PARISH</strong><br>
                        <small>Daily Cash Collection Report</small>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead style="background: #f8f8f8;">
                                <tr>
                                    <th>Receipt #</th>
                                    <th>Particulars (Category)</th>
                                    <th>Income / Offering</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $userid=$_SESSION['detsuid'];
                                $ret=mysqli_query($con,"SELECT * FROM tblcollections ORDER BY CollectionDate DESC");
                                $cnt=1;
                                $total_income = 0;
                                while ($row=mysqli_fetch_array($ret)) {
                                    $total_income += $row['Amount'];
                                ?>
                                <tr>
                                    <td><?php echo $row['ReceiptNo'];?></td>
                                    <td><?php echo $row['Category'];?></td>
                                    <td>₱<?php echo number_format($row['Amount'], 2);?></td>
                                    <td><?php echo $row['CollectionDate'];?></td>
                                </tr>
                                <?php } ?>
                                <tr style="font-weight: bold; background: #eee;">
                                    <td colspan="2" align="right">TOTAL COLLECTIONS:</td>
                                    <td colspan="2">₱<?php echo number_format($total_income, 2);?></td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <div class="row" style="margin-top: 50px;">
                            <div class="col-md-6">
                                <p><strong>Prepared by:</strong></p>
                                <br><p>__________________________<br>Bookkeeper</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p><strong>Noted by:</strong></p>
                                <br><p><strong>REV. FR. JOJIT M. BESINGA</strong><br>Parish Priest</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php } ?>