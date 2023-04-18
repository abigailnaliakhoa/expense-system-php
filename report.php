<?php
include_once 'config/Database.php';
include_once 'class/User.php';
include_once 'class/Expense.php';
include_once 'class/income.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$expense = new Expense($db);

if(!$user->loggedIn()) {
	header("Location: index.php");
}
include('inc/header.php');
?>
<title>webdamn.com : Demo Expense Management System with PHP & MySQL</title>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/general.js"></script>
<script src="js/report.js"></script>
<?php include('inc/container.php');?>
<div class="container" style="">  
	<h2>Expense Management System with PHP & MySQL</h2>	
	<br>
	<?php include('top_menus.php'); ?>	
	<div> 	
		<div class="panel-heading">
			<div class="row">	
				<div>
					<h4>View Income and Expense Reports</h4>
				</div>
				<div class="col-md-2" style="padding-left:0px;">
					<input type="date" class="form-control" id="from_date" name="from_date" placeholder="From date" >
				</div>
				<div class="col-md-2" style="padding-left:0px;">
					<input type="date" class="form-control" id="to_date" name="to_date" placeholder="To date" >
				</div>
				<div class="col-md-2" style="padding-left:0px;">
					<button type="submit" id="viewReport" class="btn btn-info" title="View Report"><span class="glyphicon glyphicon-search"></span></button>
				</div>
			</div>
		</div>
		<table class="table table-bordered table-striped" id="reportTable" style="display:none;">
			<thead>
				<tr>									
					<th>Expense</th>					
					<th>Date</th>
					<th>Category</th>									
				</tr>				
			</thead>
			<tbody id="listReports">
			
			</tbody>
		</table>
		<div class="panel-heading" id="detailSection" style="display:none;">
			<div class="row">		
				<div style="padding-bottom:5px;color:green"><strong>Total Income : </strong><span id="totalIncome"></span></div>
				<div style="padding-bottom:5px;color:red"><strong>Total Expense : </strong><span id="totalExpense"></span></div>
				<div style="padding-bottom:5px;color:blue"><strong>Total Saving : </strong><span id="totalSaving"></span></div>
			</div>
		</div>
		<div class="panel-heading" id="noRecords" style="display:none;">
		</div>
	</div>	
	
</div>
 <?php include('inc/footer.php');?>
 
