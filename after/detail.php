<?php
session_start();
require 'header1.php';
require 'dbinfo.php';
?>

<?php
if($_SESSION['id'])
{
	$id=$_SESSION['id'];
	$query1="SELECT * FROM reg WHERE id='$id'";
	$result=mysqli_query($connection, $query1);
	if ($result && $rows=mysqli_fetch_assoc($result)) 
	{
		$first_name=trim($rows["first_name"]);
		$last_name=trim($rows["last_name"]);
		$middle_name=trim($rows["middle_name"]);
		$pno=trim($rows["ph_no"]);
		$gender=trim($rows["gender"]);
		$marital=trim($rows["marital"]);
		$employer=trim($rows["employer"]);
		$employement=trim($rows["employement"]);
		$dob=trim($rows["dob"]);
		$marital=trim($rows["marital"]);
		$street=trim($rows["street"]);
		$city=trim($rows["city"]);
		$state=trim($rows["state"]);
		$zip=trim($rows["zip"]);
		$fax=trim($rows["fax"]);
		$street1=trim($rows["street1"]);
		$city1=trim($rows["city1"]);
		$state1=trim($rows["state1"]);
		$zip1=trim($rows["zip1"]);
		$img=trim($rows['img1']);
		$fax1=trim($rows["fax1"]);
		$comment=addslashes(trim($rows["comment"]));
		$username=trim($rows['user_name']);
		$email=trim($rows['email_id']);
		$img=trim($rows["img"]);   			     
	} 
	else 
	{
		echo "Error: " . $q . "<br>" . mysqli_error($connection);
	}
}
else
{
	header("Location: login.php");
}
?>
<div class="col-lg-12 h1 well">
	<?php if($_SESSION["succ"]) { ?>
	<center><lable class="lab4"><?php echo "<br/>" . $_SESSION["succ"]; $_SESSION["succ"]=null ?></lable><?php } ?></center>
	<center> Profile</center>
</div>
<div class="col-lg-12 well">
	<div class="row">
		<form class="form" action="update.php" method="post">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-4 form-group">
						<label>First_Name:</label>
						<label><?php echo $first_name; ?></label>
					</div>

					<div class="col-sm-4 form-group">
						
						<label>Last_Name:</label>
						<label><?php echo $last_name; ?></label>
					</div>
					<div class="col-sm-4 form-group">
						<label>Middle_Name:</label>
						<label><?php echo $middle_name; ?></label>
					</div>
				</div>     
				<!--end of row1--> 
				<div class="row">
					<div class="col-sm-4 form-group">
						<label>Username:</label>
						<label><?php echo $username; ?></label>
					</div>
					<div class="col-sm-4 form-group">
						<label>Phone No:</label>
						<label><?php echo $pno; ?></label>
					</div>
					<div class="col-sm-4 form-group">
						<label>Marital:</label>
						<label><?php echo $marital; ?></label>
					</div>
				</div> 
				<!--end of row-->
				<div class="row">
					<div class="col-sm-4 form-group">
						<label>Employer:</label>
						<label><?php echo $employer; ?></label>
					</div>
					<div class="col-sm-4 form-group">	
						<label>Employement:</label>
						<label><?php echo $employement; ?></label>
					</div>
					<div class="col-sm-4 form-group">
						<label>Date of birth:</label>
						<label><?php echo $dob; ?></label>
					</div>
				</div> <!--end of the row3--> 
				<div class="row col-sm-6 ">
					<h4>Residential Address</h4>
					<div class="col-sm-12 form-group">
						<label>Street:</label>
						<label><?php echo $street; ?></label>
					</div>
					<div class="col-sm-12 form-group">	
						<label>City  :</label>
						<label><?php echo $city; ?></label>
					</div>
					<div class="col-sm-12 form-group">
						<label>State :</label>
						<label><?php echo $state; ?></label>
					</div>
					<div class="col-sm-12 form-group">
						<label>Zip   :</label>
						<label><?php echo $zip; ?></label>
					</div>
					<div class="col-sm-12 form-group">
						<label>Fax   :</label>
						<label><?php echo $fax; ?></label>
					</div>
				</div><!-- end of the  -->
				<div class="col-sm-6 off1">
					<h4>Office Address</h4>
					<div class="col-sm-12 form-group">
						<label>Street:</label>
						<label><?php echo $street1; ?></label>
					</div>
					<div class="col-sm-12 form-group">	
						<label>City  :</label>
						<label><?php echo $city1; ?></label>
					</div>
					<div class="col-sm-12 form-group">
						<label>State :</label>
						<label><?php echo $state1; ?></label>
					</div>
					<div class="col-sm-12 form-group">
						<label>Zip   :</label>
						<label><?php echo $zip1; ?></label>
					</div>
					<div class="col-sm-12 form-group">
						<label>Fax   :</label>
						<label><?php echo $fax1; ?></label>
					</div>
				</div><!-- 5end of the  -->
				<div class="row">
					<div class="col-sm-12 form-group">
						<div class="form-group col-sm-6">
							<img id="blah" src="img/<?php echo $img; ?>" alt="your image" />-
						</div>
						<div class="form-group col-sm-6">
							<label>Your Comment :</label><br/>
							<label><?php echo $comment; ?></label>
						</div>
					</div>
				</div><!--end of the row-->
			</div>
		</form>
	</div>
</div>
<?php
require 'footer.php';
?>