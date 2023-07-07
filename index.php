<?php include_once 'helpers/helper.php'; ?>
<?php subview('header.php');
require 'helpers/init_conn_db.php';

?>
<head>
<style>

	body {
        font-family: "Poppins",sans-serif;
    }
	

	form.logout_form {
		background: transparent;
		padding: 10px !important;
	}


	

	h5 {
		margin-top: 10px;
	}

	

	h1 {
		color: cornflowerblue;
		font-size: 50px;
		margin-top: 50px;
		text-align: center;
	}

	.main-agileinfo {
		margin: 50px auto;
		width: 70%;
		margin-left: 80px;
		margin-top: -550px;
	}

	.sap_tabs {
		clear: both;
		padding: 0;
		
		border-radius: 20px;
		margin-top: 40px;
		
	}

	.tab_box {
		background: #fd926d;
		padding: 2em;
	}

	.form-control{
		width: 100%;
		border: 1px solid black;
		border-radius: 0px;
		height: 45px;
	}

	.date{
		width: 400px;
	}

	.top1 {
		margin-top: 2%;
	}

	.resp-tabs-list {
		list-style: none;
		padding: 15px 0px;
		margin: 0 auto;
		text-align: center;
		
		
	}

	.resp-tab-item {
		font-size: 1.1em;
		font-weight: 600;
		cursor: pointer;
		display: inline-block;
		margin: 0;
		text-align: center;
		list-style: none;
		outline: none;
		-webkit-transition: all 0.3s;
		-moz-transition: all 0.3s;
		-ms-transition: all 0.3s;
		-o-transition: all 0.3s;
		transition: all 0.3s;
		margin: 0 1.2em 0;
		color: #5d5757;
		padding: 7px 15px;
	}

	.resp-tab-active {
		color: #fff;
		background-color: #04a4c8;
	}

	

	.resp-tabs-container {
		padding: 0px;	
	}

	h2.resp-accordion {
		cursor: pointer;
		padding: 5px;
		display: none;
	}

	.resp-tab-content {
		display: none;
	}

	.resp-content-active,
	.resp-accordion-active {
		display: block;
	}

	form {
		padding: 25px;
	}

	h3 {
		font-size: 16px;
		margin-bottom: 7px;
	}

	.from,
	.to,
	.date,
	.depart,
	.return {
		width: 48%;
		float: left;
	}

	.from,
	.to,
	.date {
		margin-bottom: 40px;
	}

	.from,
	.date,
	.depart {
		margin-right: 4%;
	}

	input[type="text"] {
		padding: 10px;
		width: 93%;
		float: left;
	}

	input#datepicker,
	input#datepicker1,
	input#datepicker2,
	input#datepicker3 {
		width: 85%;
		margin-bottom: 10px;
	}

	select#w3_country1 {
		padding: 10px;
		float: left;
		width: 100%;
		border: 1px solid black;
	}

	#w3_country1{
		padding: 10px;
		float: left;
		width: 83%;
		border: 1px solid black;
	}

	label.checkbox {
		display: inline-block;
	}

	.checkbox {
		position: relative;
		font-size: 0.95em;
		font-weight: normal;
		color: #dedede;
		padding: 0em 0.5em 0em 2em;
	}

	.checkbox i {
		position: absolute;
		bottom: 1px;
		left: 2px;
		display: block;
		width: 18px;
		height: 18px;
		outline: none;
		background: #fff;
		border: 1px solid #6A67CE;
	}

	.checkbox i {
		font-size: 20px;
		font-weight: 400;
		color: #999;
		font-style: normal;
	}

	.checkbox input:checked+i:after {
		opacity: 1;
	}

	.checkbox input+i:after {
		position: absolute;
		opacity: 0;
		transition: opacity 0.1s;
		-o-transition: opacity 0.1s;
		-ms-transition: opacity 0.1s;
		-moz-transition: opacity 0.1s;
		-webkit-transition: opacity 0.1s;
	}

	.checkbox input+i:after {
		content: '';
		background: url("assets/images/tick.png") no-repeat 5px 5px;
		top: -1px;
		left: -1px;
		width: 15px;
		height: 15px;
		font: normal 12px/16px FontAwesome;
		text-align: center;
	}

	input[type="checkbox"] {
		opacity: 0;
		margin: 0;
		display: none;
	}

	.adults
	{
		width: 58%;
		float: left;
	}

	.class {
		width: 48%;
		float: left;
	}

	input[type="submit"] {
		font-size: 18px;
		color: #fff;
		background:  #05cfa5;
		border: none;
		outline: none;
		padding: 10px 20px;
		margin-top: 65px;
		margin-left: -60px;
		cursor: pointer;
		transition: 0.5s all ease;
		-webkit-transition: 0.5s all ease;
		-moz-transition: 0.5s all ease;
		-o-transition: 0.5s all ease;
		-ms-transition: 0.5s all ease;
		

	}

	input[type="submit"]:hover {
		background: #212121;
		color: #fff;
	}


	.col{
		width: 50%;

		margin: 0;
	}


	.plane-img{
		z-index: -1;
		position: relative;
		top: 500px;
		left: 800px;
		width: 600px;
	}

	.content{
		border: 1px solid #c6c6c6;
		height: 350px;
	}
	

</style>
<head>


<?php
if (isset($_GET['error'])) {
	if ($_GET['error'] === 'sameval') {
		echo '<script>alert("Select different value for departure city and arrival city")</script>';
	} else if ($_GET['error'] === 'seldep') {
		echo '<script>alert("Select Departure city")</script>';
	} else if ($_GET['error'] === 'selarr') {
		echo "<script>alert('Select Arrival city')</script>";
	}
}
?>



<div class="main-agileinfo" >
<img class="plane-img" src="assets/images/plane.png">
	<h1 style="color: black;font-weight:600;margin-top:-40px">
		Ready To Take Off!
	</h1>
	<div class="sap_tabs">
		<div id="horizontalTab">
			<ul class="resp-tabs-list row row-cols-0">
				<li class="resp-tab-item col"><span>Round Trip</span></li>
				<li class="resp-tab-item col"><span>One way</span></li>
			</ul>
			<div class="clearfix"> </div>
			<div class="resp-tabs-container">
				<div class="tab-1 resp-tab-content roundtrip">
					<form action="book_flight.php" class="content" method="post">
						<input type="hidden" name="type" value="round">
						<div class="from">
							<h3><i class="fa-solid fa-plane-departure"></i> From</h3>
							<?php
							$sql = 'SELECT * FROM Cities ';
							$stmt = mysqli_stmt_init($conn);
							mysqli_stmt_prepare($stmt, $sql);
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);
							echo '<select class="" name="dep_city" id="w3_country1">
								<option value="0" selected disabled >Departure</option>';
							while ($row = mysqli_fetch_assoc($result)) {
								echo "<option value='{$row['city']}'>{$row['city']}</option>";
							}
							?>
							</select>
						</div>
						<div class="to">
							<h3><i class="fa-solid fa-plane-arrival"></i> To</h3>
							<?php
							$sql = 'SELECT * FROM Cities ';
							$stmt = mysqli_stmt_init($conn);
							mysqli_stmt_prepare($stmt, $sql);
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);
							echo '<select value="0" name="arr_city" id="w3_country1">
								<option selected disabled>Arrival</option>';
							while ($row = mysqli_fetch_assoc($result)) {
								echo "<option value='{$row['city']}'>{$row['city']}</option>";
							}
							?>
							</select>
						</div>
						<div class="clear"></div>
						<div class="date">
							<div class="depart">
								<h3>Departure Date</h3>
								<input class="form-control " id="w3_country1" name="dep_date" type="date" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}" required="">
							</div>
							<div class="return">
								<h3>Return Date</h3>
								<input class="form-control" name="ret_date" type="date" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}" required="">
							</div>
							<div class="clear"></div>
						</div>
						<div class="class">
							<h3><i class="fa-solid fa-ticket"></i> Class</h3>
							<select id="w3_country1" name="f_class" onchange="change_country(this.value)" class="frm-field required">
								<option value="E">Economy</option>
								<option value="B">Business</option>
							</select>

						</div>
						
						<div class="adults">
							<h3><i class="fa-solid fa-user"></i> Passenger</h3>
								<input type="number" name="passengers" class="input_val" value="1" id="w3_country1">
						</div>
						<input type="submit" value="Search Flights" name="search_but" >
					</form>
				</div>

				<div class="tab-1 resp-tab-content oneway">
					<form action="book_flight.php" class="content" method="post">
						<input type="hidden" name="type" value="one">
						<div class="from">
							<h3><i class="fa-solid fa-plane-departure"></i> From</h3>
							<?php
							$sql = 'SELECT * FROM Cities ';
							$stmt = mysqli_stmt_init($conn);
							mysqli_stmt_prepare($stmt, $sql);
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);
							echo '<select value="0" name="dep_city" id="w3_country1">
								<option selected disabled>Departure</option>';
							while ($row = mysqli_fetch_assoc($result)) {
								echo "<option value='{$row['city']}'>{$row['city']}</option>";
							}
							?>
							</select>
						</div>
						<div class="to">
							<h3><i class="fa-solid fa-plane-arrival"></i> To</h3>
							<?php
							$sql = 'SELECT * FROM Cities ';
							$stmt = mysqli_stmt_init($conn);
							mysqli_stmt_prepare($stmt, $sql);
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);
							echo '<select value="0" name="arr_city" id="w3_country1">
								<option selected disabled>Arrival</option>';
							while ($row = mysqli_fetch_assoc($result)) {
								echo "<option value='{$row['city']}'>{$row['city']}</option>";
							}
							?>
							</select>
						</div>
						<div class="clear"></div>
						<div class="date">
							<div class="depart">
								<h3>Departure Date</h3>
								<input name="dep_date" style="width: 487px;" type="date" class="form-control" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}" required="">
							</div>
						</div>
						<div class="class">
							<h3><i class="fa-solid fa-ticket"></i> Class</h3>
							<select id="w3_country1" name="f_class" onchange="change_country(this.value)" class="frm-field required">
								<option value="E">Economy</option>
								<option value="B">Business</option>
							</select>

						</div>
						<div class="adults">
							<h3><i class="fa-solid fa-user"></i> Passenger</h3>
								<input type="number" name="passengers" class="input_val" value="1" id="w3_country1">
						</div>
						<input type="submit" value="Search Flights" name="search_but" >
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>



<?php subview('footer.php'); ?>
<script src="https://kit.fontawesome.com/d70c1f6414.js" crossorigin="anonymous"></script>
<script src="assets/js/easyResponsiveTabs.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#horizontalTab').easyResponsiveTabs({
			type: 'default',
			width: 'auto',
			fit: true
		});
	});
</script>

