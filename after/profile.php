<?php
	//session_start();
require 'header1.php';
require 'dbinfo.php';
session_start();
require 'validate.php';
?>
<?php
$errors=array();
if(isset($_POST["update"]))
{
	$id=$_SESSION['id'];
	$username=trim($_POST["username"]);
	$email=trim($_POST["email"]);
	$dob=trim($_POST["dob"]);
	$first_name=trim($_POST["first_name"]);
	$last_name=trim($_POST["last_name"]);
	$middle_name=trim($_POST["middle_name"]);
	$pno=trim($_POST["pno"]);
	$employer=trim($_POST["employer"]);
	$employement=trim($_POST["employement"]);
	$dob=trim($_POST["dob"]);
	$street=trim($_POST["street"]);
	$city=trim($_POST["city"]);
	$state=trim($_POST["state"]);
	$zip=trim($_POST["zip"]);
	$fax=trim($_POST["fax"]);
	$street1=trim($_POST["street1"]);
	$city1=trim($_POST["city1"]);
	$state1=trim($_POST["state1"]);
	$zip1=trim($_POST["zip1"]);
	$fax1=trim($_POST["fax1"]);
	$comment=addslashes(trim($_POST["text1"]));
	//POST values
	if($_FILES["img"]["name"]=="")
	{
		$query2="SELECT img FROM reg WHERE id='$_SESSION[id]'";
		$result1=mysqli_query($connection, $query2);
		$rows1=mysqli_fetch_assoc($result1);
		if($result1 && $rows1)
		{
			$img_var=trim($rows1['img']);	
    	}	//Old Imag
     }
    else
     {
    	$target_dir = "/var/www/html/new/img/$img";
		$target_file = $target_dir . basename($_FILES["img"]["name"]);
		$img_var=basename($_FILES["img"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) 
		{
    		$errors["img"]="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    		$uploadOk = 0;
		}
		if($uploadok==1)
		{
    		move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
		}
		if($_FILES["img"]["name"]=="")
		{
			$query2="SELECT img FROM reg WHERE id='$_SESSION[id]'";
			$result1=mysqli_query($connection, $query2);
			$rows1=mysqli_fetch_assoc($result1);
			if($result1 && $rows1)
			{
				$img_var=trim($rows1['img']);	
    		}//Old Image
    	}// Updated Image Upload
	}
	$name_regular=array("first_name","last_name","middle_name");
	all_regular($name_regular);
	$name_fields_presence=array("username","email","first_name","last_name","pno","employement","employer","street","city","state","zip","fax","street1","zip1","fax1","dob");
	all_prestnt($name_fields_presence);
			//values are present or not
	$fields_max_length=array("username"=>20,"first_name"=>20,"last_name"=>20,"pno"=>15);
	validate_max_lengths($fields_max_length);
			//max length check
	$fields_min_length=array("username"=>8,"email"=>8,"pno"=>9);	
	validate_min_lengths($fields_min_length);
	if (!preg_match('/^[a-z0-9_-]+@[a-z0-9._-]+\.[a-z]+$/i', $email))
	{
		$errors["email"]=" wrong" . ucfirst("email") .  " pattern ";
	}//email format checking//for email varification;
	$output=form_errors($errors);
   //end of validations
	if(!$output)
	{
   		$activate=md5(uniqid(rand(), true));
   		//creating new unique activation code
		$q="UPDATE reg SET user_name='$username', 
		dob='$dob', 
		email_id='$email', 
		first_name='$first_name', 
		last_name='$last_name', 
		middle_name='$middle_name', 
		ph_no='$pno',  
		employement='$employement', 
		employer='$employer', 
		street='$street', 
		city='$city', 
		state='$state', 
		zip='$zip', 
		fax='$fax', 
		street1='$street1', 
		city1='$city1', 
		state1='$state1', 
		zip1='$zip1', 
		fax1='$fax1', 
		comment='$comment', 
		dob='$dob', 
		img='$img_var' WHERE id='$id'";
		if (mysqli_query($connection, $q)) 
		{		
			$_SESSION["succ"]="Profile updated successfully";
			header("Location:detail.php");
		} 
		else 
		{
			?><div class="colo"><?php echo "Error: " . $q . "<br>" . mysqli_error($connection); ?></div><?php
		}
	}	//for $output
}//for submit
		?>
		<!-- updation -->
		<?php
		if($_SESSION['id'])
		{
			$id=$_SESSION['id'];
			$query1="SELECT * FROM reg WHERE id='$id'";
			$result=mysqli_query($connection, $query1);
			$rows=mysqli_fetch_assoc($result); 
		}
		else
		{
			header("Location: login.php");
		}
		/*function display($rows,$result) 
		{
			if(isset($_POST['update']))
			{ 
				return $_POST[$rows];
			} 
			else
			{
				return $result[$field];   
			}
		}*/
		?>
		<div class="col-lg-12 h1 well">
			<center> Update </center>
		</div>
		<div class="col-lg-12 well">
			<div class="row">
				<form class="form" action="profile.php" method="post" enctype="multipart/form-data">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-4 form-group">
								<label>Username</label>
								<input type="text" value="<?php echo $rows['user_name'];?>" name="username" class="form-control"  />
								<?php if($errors["username"]) { ?>
								<lable class="flab1"><?php echo $errors["username"]; $errors["username"]=null ?></lable><?php } ?>
							</div>
							<div class="col-sm-4 form-group">
								<label>Email-id</label>
								<input type="text" value="<?php echo $rows['email_id'];?>" name="email" class="form-control">
								<?php if($errors["email"]) { ?>
								<lable class="flab1"><?php echo $errors["email"]; $errors["email"]=null ?></lable><?php } ?>
							</div>
							<div class="col-sm-4 form-group">
								<label>DateOfBirth</label>
								<input type="date" value="<?php echo $rows['dob'];?>" name="dob" class="form-control">
							</div>
						</div>   
						<div class="row">
							<div class="col-sm-4 form-group">
								<label>first_name</label>
								<input type="text" value="<?php echo $rows['first_name'];?>" name="first_name" class="form-control">
								<?php if($errors["first_name"]) { ?>
								<lable class="flab1"><?php echo $errors["first_name"]; $errors["first_name"]=null ?></lable><?php } ?>
							</div>
							<div class="col-sm-4 form-group">
								<label>Last_name</label>
								<input type="text" value="<?php echo $rows['last_name'];?>" name="last_name" class="form-control">
								<?php if($errors["last_name"]) { ?>
								<lable class="flab1"><?php echo $errors["last_name"]; $errors["last_name"]=null ?></lable><?php } ?>
							</div>
							<div class="col-sm-4 form-group">
								<label>Middle_name</label>
								<input type="text" value="<?php echo $rows['middle_name'];?>" name="middle_name" class="form-control">
							</div>
						</div>   
						<div class="row">
							<div class="col-sm-4 form-group">
								<label>Employement</label>
								<select class="form-control" name="employement" value="<?php echo $rows['employement'];?>">
									<option>Unemplyed</option>
									<option>Emplyee</option>
									<option>Student</option>
								</select>
							</div>
							<div class="col-sm-4 form-group">
								<label>Employer</label>
								<input type="text" class="form-control" value="<?php echo $rows['employer'];?>" name="employer" id="Employer" >
								<?php if($errors["employer"]) { ?>
								<lable class="flab1"><?php echo $errors["employer"]; $errors["employer"]=null ?></lable><?php } ?>									
							</div>	
							<div class="col-sm-4 form-group">
								<label>Ph.No</label>
								<input type="text" value="<?php echo $rows['ph_no'];?>" name="pno" class="form-control">
								<?php if($errors["pno"]) { ?>
								<lable class="flab1"><?php echo $errors["pno"]; $errors["pno"]=null ?></lable><?php } ?>
							</div>	
						</div><!--row  ending-->
						<div class="row">
							<div class="col-sm-6 a2">
								<center><h3>Residential Address</h3></center>
								<div class="col-sm-12 form-group">
									<label>Street</label>
									<input type="text" value="<?php echo $rows['street'];?>" name="street"  class="form-control">
									<?php if($errors["street"]) { ?>
									<lable class="flab1"><?php echo $errors["street"]; $errors["street"]=null ?></lable><?php } ?>
								</div>
								<div class="col-sm-12 form-group">
									<label>City</label>
									<input type="text" value="<?php echo $rows['city'];?>" name="city"  class="form-control">
										<?php if($errors["city"]) { ?>
									<lable class="flab1"><?php echo $errors["city"]; $errors["city"]=null ?></lable><?php } ?>
								</div>
								<div class="col-sm-12 form-group">
									<label>State</label>
									<input type="text" value="<?php echo $rows['state']; ?>" name="state"  class="form-control">
									<?php if($errors["state"]) { ?>
									<lable class="flab1"><?php echo $errors["state"]; $errors["state"]=null ?></lable><?php } ?>		
								</div>
								<div class="col-sm-12 form-group">
									<label>Zip</label>
									<input type="text" value="<?php echo $rows['zip'];?>" name="zip" class="form-control">
									<?php if($errors["zip"]) { ?>
									<lable class="flab1"><?php echo $errors["zip"]; $errors["zip"]=null ?></lable><?php } ?>
								</div>
								<div class="col-sm-12 form-group">
									<label>Fax</label>
									<input type="text" value="<?php echo $rows['fax'];?>" name="fax" class="form-control">
									<?php if($errors["fax"]) { ?>
									<lable class="flab1"><?php echo $errors["fax"]; $errors["fax"]=null ?></lable><?php } ?>
								</div>
							</div>	
							<div class="col-sm-6 a2">
								<center><h3>Office Address</h3></center>
								<div class="col-sm-12 form-group">
									<label>Street</label>
									<input type="text" value="<?php echo $rows['street1'];?>" name="street1"  class="form-control">
									<?php if($errors["street1"]) { ?>
									<lable class="flab1"><?php echo $errors["street1"]; $errors["street1"]=null ?></lable><?php } ?>
								</div>
								<div class="col-sm-12 form-group">
									<label>City</label>
									<input type="text" value="<?php echo $rows['city1'];?>" name="city1"  class="form-control">
									<?php if($errors["city1"]) { ?>
									<lable class="flab1"><?php echo $errors["city1"]; $errors["city1"]=null ?></lable><?php } ?>
								</div>
								<div class="col-sm-12 form-group">
									<label>State</label>
									<input type="text"  value="<?php echo $rows['state1'];?>" name="state1"  class="form-control" >
									<?php if($errors["state1"]) { ?>
									<lable class="flab1"><?php echo $errors["state1"]; $errors["state1"]=null ?></lable><?php } ?>
								</div>
								<div class="col-sm-12 form-group">
									<label>Zip</label>
									<input type="text" value="<?php echo $rows['zip1'];?>" name="zip1" class="form-control">
									<?php if($errors["zip1"]) { ?>
									<lable class="flab1"><?php echo $errors["zip1"]; $errors["zip1"]=null ?></lable><?php } ?>
								</div>
								<div class="col-sm-12 form-group">
									<label>Fax</label>
									<input type="text" value="<?php echo $rows['fax1'];?>" name="fax1" class="form-control">
									<?php if($errors["fax1"]) { ?>
									<lable class="flab1"><?php echo $errors["fax1"]; $errors["fax1"]=null ?></lable><?php } ?>
								</div>
							</div>
						</div><!--row 3 ending-->
						<div class="row col-sm-12">
							<div class="form-group col-sm-6">
								<label for="upload">Upload Image:</label>
								<input type='file' name="img" onchange="readURL(this);"/>
								<img id="blah" src="img/<?php echo $rows['img'];?>"  alt="your image" />
								<?php if($errors["img"]) { ?>
									<lable class="flab1"><?php echo "<br/>" . $errors["img"]; $errors["img"]=null ?></lable><?php } ?>
							</div>
							<div class="form-group col-sm-5 c1">
								<label for="comment">Comment:</label>
								<textarea class="form-control" rows="5" id="comment" name="text1"><?php echo $rows['comment'];?></textarea>	
		
								<?php if($errors["text1"]) { ?>
								<lable class="flab1"><?php echo $errors["text1"]; $errors["text1"]=null ?></lable><?php } ?>
							</div>
						</div><!--row 4 ending-->
						<center><button type="submit" name="update" value="Update" class="btn btn-lg btn-info">Update</button></center>					
					</div>
				</form> 
			</div>
		</div>
		<?php
			require 'footer.php';
		?>