<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="../table.css">
</head>
<body>
<?php
include_once '../config/Database.php';
include_once '../class/User.php';
include_once '../class/General.php';
include_once '../class/Expense.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$expense = new Expense($db);

if(!$user->loggedIn()) {
	header("Location: index.php");
}
include('../inc/header.php');

// Connect to the database
$servername = "localhost";
$username ="root";
$password = "";
$dbname = "webdamn_demo";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Retrieve the total sum of values in the income table
$sql_income = "SELECT SUM(amount) AS total_income FROM expense_income ";
$result_income = mysqli_query($conn, $sql_income);
$row_income = mysqli_fetch_assoc($result_income);
$total_income = $row_income["total_income"];

// Retrieve the total sum of values in the expenses table
$sql_expenses = "SELECT SUM(amount) AS total_expenses FROM expense_expense";
$result_expenses = mysqli_query($conn, $sql_expenses);
$row_expenses = mysqli_fetch_assoc($result_expenses);
$total_expenses = $row_expenses["total_expenses"];

// Calculate the profit/loss
$profit_loss = $total_income - $total_expenses;

// Display the results in a table
echo "<table class='my_table' style='border-collapse: collapse; width: 100%; background-color: white;'>";
echo "<thead style='background-color: lightgreen;'>";
echo "<th style='border: 1px solid lightgreen; padding: 10px;'>Date</th>";
echo "<th style='border: 1px solid lightgreen; padding: 10px;'>Total Income</th>";
echo "<th style='border: 1px solid lightgreen; padding: 10px;'>Total Expenses</th>";
echo "<th style='border: 1px solid lightgreen; padding: 10px;'>Profit/Loss</th>";
echo "</thead>";
echo "<tr>";
echo "<td style='border: 1px solid lightgreen; padding: 10px;'>".date('Y-m-d H:i:s')."</td>";
echo "<td style='border: 1px solid lightgreen; padding: 10px;'>".$total_income."</td>";
echo "<td style='border: 1px solid lightgreen; padding: 10px;'>".$total_expenses."</td>";
echo "<td style='border: 1px solid lightgreen; padding: 10px;'>".$profit_loss."</td>";
echo "</tr>";
echo "</table>";
echo "<button onclick='generateReceipt()'>Generate Receipt</button>";
echo "<script>
function generateReceipt(){
    var receipt = document.createElement('div');
    var table = document.getElementsByClassName('my_table')[0].cloneNode(true);
    receipt.appendChild(table);
    document.body.appendChild(receipt);
    window.print();
}
</script>";
?>



<?php include('../inc/footer.php');?>


</body>
</html>


<!-- <tr><th>Income</th><th>Expenses</th> -->
<!-- <td>income_column_name</td><td>expenses_column_name</td> -->
