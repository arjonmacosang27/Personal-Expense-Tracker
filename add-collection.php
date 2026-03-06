<?php
// DATABASE CONNECTION (Replacing the need for an include file)
$host = "localhost";
$user = "root";
$pass = "";
$db   = "dailyexpense"; // Change this to your actual database name

$con = mysqli_connect($host, $user, $pass, $db);

if(mysqli_connect_errno()){
    echo "Connection Fail: " . mysqli_connect_error();
}

// FORM PROCESSING LOGIC
$msg = "";
if(isset($_POST['submit'])) {
    $receiptno = $_POST['receiptno'];
    $category  = $_POST['category'];
    $amount    = $_POST['amount'];
    $colldate  = $_POST['colldate'];

    $query = mysqli_query($con, "INSERT INTO tblcollections(ReceiptNo, Category, Amount, CollectionDate) 
                                 VALUES('$receiptno', '$category', '$amount', '$colldate')");
    if($query) {
        $msg = "<div class='alert alert-success'>Collection has been added successfully!</div>";
    } else {
        $msg = "<div class='alert alert-danger'>Something went wrong. Please try again.</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Collection - Jesus Nazareno Parish</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding-top: 20px; background: #f1f4f7; }
        .panel { border-radius: 0; }
        .btn-primary { background-color: #30a5ff; border-color: #30a5ff; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add New Parish Collection</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $msg; ?>
                        <form role="form" method="post">
                            <div class="form-group">
                                <label>Receipt Number</label>
                                <input class="form-control" name="receiptno" placeholder="e.g. 11986" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Category (Particulars)</label>
                                <select class="form-control" name="category" required>
                                    <option value="">Select Category</option>
                                    <optgroup label="Sacraments">
                                        <option value="Sponsors (Bap./Con)">Sponsors (Bap./Con)</option>
                                        <option value="Marriage Package">Marriage Package</option>
                                        <option value="Funeral">Funeral</option>
                                    </optgroup>
                                    <optgroup label="Collections">
                                        <option value="Halad-Pasalamat">Halad-Pasalamat</option>
                                        <option value="1st Collection">1st Collection</option>
                                        <option value="2nd Collection">2nd Collection</option>
                                        <option value="Intentions">Intentions</option>
                                    </optgroup>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Amount (₱)</label>
                                <input class="form-control" type="number" step="0.01" name="amount" required>
                            </div>

                            <div class="form-group">
                                <label>Date of Collection</label>
                                <input class="form-control" type="date" name="colldate" required>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary">Save Collection</button>
                            <a href="daily-collections.php" class="btn btn-default">View Report</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>