<?php
include_once 'config/Database.php';
include_once 'class/User.php';
include_once 'class/Income.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$income = new Income($db);

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
<script src="js/income.js"></script>
<?php include('inc/container.php');?>
<div class="container" style="">  
	<h2>KARIBU!</h2>	
	<br>
	<?php include('top_menus.php'); ?>	
	<div> 	
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-10">
					<h3 class="panel-title"></h3>
				</div>
				<div class="col-md-2" align="right">
					<button type="button" id="addIncome" class="btn btn-info" title="Add Income"><span class="glyphicon glyphicon-plus"></span></button>
				</div>
			</div>
		</div>
		<table id="incomeListing" class="table table-bordered table-striped">
			<thead>
				<tr>						
					<th>Sn.</th>					
					<th>Amount</th>					
					<th>Category</th>
					<th>Date</th>						
					<th></th>
					<th></th>					
				</tr>
			</thead>
		</table>
	</div>
	
	<div id="incomeModal" class="modal fade">
		<div class="modal-dialog">
			<form method="post" id="incomeForm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Edit Income</h4>
					</div>
					<div class="modal-body">						
						<div class="form-group">
							<label for="country" class="control-label">Category</label>							
							<select class="form-control" id="income_cat" name="income_cat"/>
							<option value="">Select Category</option>
							<?php 
							$categoryResult = $income->getCategoryList();
							while ($category = $categoryResult->fetch_assoc()) { 	
							?>
								<option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>							
							<?php } ?>
							</select>							
						</div>
						
						<div class="form-group">							
							<label for="Income" class="control-label">Amount</label>							
							<input type="text" name="amount" id="amount" autocomplete="off" class="form-control" />
											

							
						</div>
						
						<div class="form-group"
							<label for="project" class="control-label">Date</label>
							<input type="date" class="form-control" id="income_date" name="income_date" placeholder="Income date" >			
						</div>						
										
					</div>
					<div class="modal-footer">
						<input type="hidden" name="id" id="id" />						
						<input type="hidden" name="action" id="action" value="" />
						<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
 <?php include('inc/footer.php');?>
