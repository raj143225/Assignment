<?php
require 'header1.php';
require 'dbinfo.php';
require 'validate.php';
require 'test.php';
session_start();

?>
<?php

$errors=array();
if(isset($_POST["submit"]))
{
	
	$username=trim($_POST["username"]);
	$password=md5(trim($_POST["password"]));
	$email=trim($_POST["email"]);
	$first_name=trim($_POST["first_name"]);
	$last_name=trim($_POST["last_name"]);
	$middle_name=trim($_POST["middle_name"]);
	$pno=trim($_POST["pno"]);
	$gender=trim($_POST["gender"]);
	$marital=trim($_POST["marital"]);
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
	$comment=stripslashes(trim($_POST["text1"]));
	$check=trim($_POST["check"]);
	//POST values
	$target_dir = "/var/www/html/new/img/$img";
	$target_file = $target_dir . basename($_FILES["img1"]["name"]);
	$img_var=basename($_FILES["img1"]["name"]);
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
    		move_uploaded_file($_FILES["img1"]["tmp_name"], $target_file);
	}//uploading image
	$name_regular=array("first_name","last_name","middle_name");
	all_regular($name_regular);	//for regular message check	
	$name_fields_presence=array("username","password","email","first_name","last_name","dob","pno","employement","employer","street","city","state","zip","fax","street1","city1","state1","zip1","fax1","dob","text1");
	all_prestnt($name_fields_presence);	//values are present or not
	$fields_max_length=array("username"=>20,"password"=>20,"first_name"=>20,"last_name"=>20,"pno"=>15);
	validate_max_lengths($fields_max_length);		//max length check
	$fields_min_length=array("username"=>8,"password"=>8,"email"=>8,"pno"=>9);	
	validate_min_lengths($fields_min_length);
	$name_fields_presence=array("username","password","email","first_name","last_name","pno","employement","employer","street","city","state","zip","fax","street1","city1","state1","zip1","fax1","dob");
	all_prestnt($name_fields_presence);
	if (!preg_match('/^[a-z0-9_-]+@[a-z0-9._-]+\.[a-z]+$/i', $email))
	{
		$errors["email"]=" wrong" . ucfirst("email") .  " pattern ";
	}		//email format checking
	if($check=="")
	{	
		$errors["check"]=ucfirst("check") . " needs to done to register ";
	}		//for email varification;
	$q1="SELECT id FROM reg where email_id='$email'";
	$res=mysqli_query($connection,$q1);
	if($rows=mysqli_fetch_assoc($res))
	{
		$errors["email"]=ucfirst("email") . "already used";
	}//for username verification
	$q2="SELECT id FROM reg where user_name='$username'";
	$res2=mysqli_query($connection,$q2);
	if($rows=mysqli_fetch_assoc($res2))
	{
		$errors["username"]=ucfirst("username") . "already used";
	}
	$output=form_errors($errors);//end of validations
	if(!$output)
	{
   				//creating new unique activation code
		$activate=md5(uniqid(rand(), true));
		$q="INSERT INTO reg (user_name, 
			password, 
			email_id, 
			first_name, 
			last_name, 
			middle_name, 
			ph_no, 
			gender, 
			marital, 
			employement, 
			employer, 
			street, 
			city, 
			state, 
			zip, 
			fax, 
			street1, 
			city1, 
			state1, 
			zip1, 
			fax1, 
			comment, 
			dob, 
			img, 
			check1,
			act_com)                
VALUES ('$username',
	'$password', 
	'$email', 
	'$first_name', 
	'$last_name', 
	'$middle_name', 
	'$pno', 
	'$gender', 
	'$marital', 
	'$employement', 
	'$employer', 
	'$street', 
	'$city', 
	'$state', 
	'$zip', 
	'$fax', 
	'$street1', 
	'$city1', 
	'$state1', 
	'$zip1', 
	'$fax1', 
	'$comment', 
	'$dob', 
	'$img_var', 
	'$check',
	'$activate')";


if (mysqli_query($connection, $q)) 
{	

	$subject="Activation mail";
	$var1=mymail1($email,$subject,$activate);				
	$_SESSION['active_msg']="Activation link sent to your mail";
	header("Location:login.php");
} 
else 
{
	?><div class="colo"><?php echo "Error: " . $q . "<br>" . mysqli_error($connection); ?></div><?php
}


			}
			
		}
		?>
		<div class="col-lg-12 h1 well">
			<center> Registration Form</center>
		</div>
		<div class="col-lg-12 well">
			<div class="row">
				<form class="form" action="form.php" method="post"  enctype="multipart/form-data">
					<div class="col-sm-12">

						<div class="row">
							<div class="col-sm-4 form-group">
								<label>Username</label>
								<input type="text" placeholder="Username" name="username" class="form-control" value="<?php echo $username; ?>">
								<?php if($errors["username"]) { ?>
								<lable class="flab1"><?php echo $errors["username"]; $errors["username"]=null ?></lable><?php } ?>
							</div>

							<div class="col-sm-4 form-group">
								<label>Password</label>
								<input type="password" placeholder="Password" name="password" class="form-control" value="<?php echo $_POST['password'];?>">
								<?php if($errors["password"]) { ?>
								<lable class="flab1"><?php echo $errors["password"]; $errors["password"]=null ?></lable><?php } ?>
							</div>
							
							<div class="col-sm-4 form-group">
								<label>Email-id</label>
								<input type="text" placeholder="Email_Id" name="email" class="form-control" value="<?php echo $email;?>">
								<?php if($errors["email"]) { ?>
								<lable class="flab1"><?php echo $errors["email"]; $errors["email"]=null ?></lable><?php } ?>
							</div>
						</div> 
						<div class="row">
							<div class="col-sm-4 form-group">
								<label>first_name</label>
								<input type="text" placeholder="First_name" name="first_name" class="form-control" value="<?php echo $first_name;?>">
								<?php if($errors["first_name"]) { ?>
								<lable class="flab1"><?php echo $errors["first_name"]; $errors["first_name"]=null ?></lable><?php } ?>
							</div>
							<div class="col-sm-4 form-group">
								<label>Last_name</label>
								<input type="text" placeholder="Last_name" name="last_name" class="form-control" value="<?php echo $last_name;?>">
								<?php if($errors["last_name"]) { ?>
								<lable class="flab1"><?php echo $errors["last_name"]; $errors["last_name"]=null ?></lable><?php } ?>
							</div>
							<div class="col-sm-4 form-group">
								<label>Middle_name</label>
								<input type="text" placeholder="Middle_name" name="middle_name" class="form-control" value="<?php echo $middle_name;?>">
							</div>
						</div>//end of the row   
						<div class="row">
							<div class="col-sm-4 form-group">
								<div class="form-group">
									<label>Gender</label>
									<div class="radio">
										<label><input type="radio" name="gender" value="male" checked>Male</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="gender" value="female">female</label>
									</div>
								</div>
							</div>	
							<div class="col-sm-4 form-group">
								<label>Marital Status</label>
								<div class="radio">
									<label><input type="radio" name="marital" value="Married" checked>Married</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="marital" value="Un-Married">Un-Married</label>
								</div>
							</div>
							<div class="form-group c1">
								<div class="col-sm-4">
									<label>Date-Of-Birth</label>
									<input type="date" class="form-control" name="dob" id="dob" value="<?php echo $dob;?>">
								</div>
							</div>		
						</div><!--row  ending-->
						<div class="row">
							<div class="col-sm-4 form-group">
								<label>Employement</label>
								<select class="form-control" name="employement">
									<option>Unemplyed</option>
									<option>Emplyee</option>
									<option>Student</option>
								</select>
							</div>
							<div class="col-sm-4 form-group">
								<label>Employer</label>
								<input type="text" class="form-control" name="employer" id="Employer" placeholder="EMPLOYER" value="<?php echo $employer;?>">
								<?php if($errors["employer"]) { ?>
								<lable class="flab1"><?php echo $errors["employer"]; $errors["employer"]=null ?></lable><?php } ?>
							</div>	
							<div class="col-sm-4 form-group">
								<label>Ph.No</label>
								<input type="text" placeholder="phone number" name="pno" class="form-control" value="<?php echo $pno;?>">
								<?php if($errors["pno"]) { ?>
								<lable class="flab1"><?php echo $errors["pno"]; $errors["pno"]=null ?></lable><?php } ?>
							</div>	
						</div><!--row  ending-->
						<div class="row">
							<div class="col-sm-6 a2">
								<center><h3>Residential Address</h3></center>
								<div class="col-sm-12 form-group">
									<label>Street</label>
									<input type="text" placeholder="Street" name="street"  class="form-control" value="<?php echo $street;?>">
									<?php if($errors["street"]) { ?>
									<lable class="flab1"><?php echo $errors["street"]; $errors["street"]=null ?></lable><?php } ?>
								</div>
								<div class="col-sm-12 form-group">
									<label>City</label>
									<input type="text" placeholder="City" name="city"  class="form-control" value="<?php echo $city;?>">
									<?php if($errors["city"]) { ?>
									<lable class="flab1"><?php echo $errors["city"]; $errors["city"]=null ?></lable><?php } ?>
								</div>
								<div class="col-sm-12 form-group">
									<label>State</label>
									<input type="text" placeholder="State" name="state"  class="form-control" value="<?php echo $state;?>">
									<?php if($errors["state"]) { ?>
									<lable class="flab1"><?php echo $errors["state"]; $errors["state"]=null ?></lable><?php } ?>								
								</div>
								<div class="col-sm-12 form-group">
									<label>Zip</label>
									<input type="text" placeholder="Zip" name="zip" class="form-control" value="<?php echo $zip;?>">
									<?php if($errors["zip"]) { ?>
									<lable class="flab1"><?php echo $errors["zip"]; $errors["zip"]=null ?></lable><?php } ?>
								</div>
								<div class="col-sm-12 form-group">
									<label>Fax</label>
									<input type="text" placeholder="Fax" name="fax" class="form-control" value="<?php echo $fax;?>">
									<?php if($errors["fax"]) { ?>
									<lable class="flab1"><?php echo $errors["fax"]; $errors["fax"]=null ?></lable><?php } ?>
								</div>
							</div>	
							<div class="col-sm-6 a2">
								<center><h3>Office Address</h3></center>
								<div class="col-sm-12 form-group">
									<label>Street</label>
									<input type="text" placeholder="Street" name="street1"  class="form-control" value="<?php echo $street1;?>">
									<?php if($errors["street1"]) { ?>
									<lable class="flab1"><?php echo $errors["street1"]; $errors["street1"]=null ?></lable><?php } ?>
								</div>
								<div class="col-sm-12 form-group">
									<label>City</label>
									<input type="text" placeholder="City" name="city1"  class="form-control" value="<?php echo $city1;?>">
									<?php if($errors["city1"]) { ?>
									<lable class="flab1"><?php echo $errors["city1"]; $errors["city1"]=null ?></lable><?php } ?>
								</div>
								<div class="col-sm-12 form-group">
									<label>State</label>
									<input type="text" placeholder="State" name="state1"  class="form-control" value="<?php echo $state1;?>">
									<?php if($errors["state1"]) { ?>
									<lable class="flab1"><?php echo $errors["state1"]; $errors["state1"]=null ?></lable><?php } ?>
								</div>
								<div class="col-sm-12 form-group">
									<label>Zip</label>
									<input type="text" placeholder="Zip" name="zip1" class="form-control" value="<?php echo $zip1;?>">
									<?php if($errors["zip1"]) { ?>
									<lable class="flab1"><?php echo $errors["zip1"]; $errors["zip1"]=null ?></lable><?php } ?>
								</div>
								<div class="col-sm-12 form-group">
									<label>Fax</label>
									<input type="text" placeholder="Fax" name="fax1" class="form-control" value="<?php echo $fax1;?>">
									<?php if($errors["fax1"]) { ?>
									<lable class="flab1"><?php echo $errors["fax1"]; $errors["fax1"]=null ?></lable><?php } ?>
								</div>

							</div>
						</div><!--row 3 ending-->
						<div class="row col-sm-12">
							<div class="form-group col-sm-6">
								<label for="upload">Upload Image:</label>
								<input type='file' name="img1" onchange="readURL(this)" />
								<img id="blah" src="<?php echo $img;?>" alt="your image" />-
								<?php if($errors["img"]) { ?>
									<lable class="flab1"><?php echo "<br/>" . $errors["img"]; $errors["img"]=null ?></lable><?php } ?>
							</div>
							<div class="form-group col-sm-5 c1">
								<label for="comment">Comment:</label>
								<textarea class="form-control" rows="5" id="comment" name="text1" value="<?php echo $comment;?>"></textarea>
								<?php if($errors["text1"]) { ?>
								<lable class="flab1"><?php echo $errors["text1"]; $errors["text1"]=null ?></lable><?php } ?>
							</div>
						</div><!--row 4 ending-->
						<div class="row col-sm-12">
							<div class="form-group col-sm-1">
								<input  type="checkbox" class="form-control" id="check" name="check"> 
							</div>
							<div class="con">
								<label >
									Check me if you agree terms and conditions
								</label>
								<?php if($errors["check"]) { ?>
										<lable class="flab1"><?php echo "<br/>" . $errors["check"]; $errors["check"]=null ?></lable><?php } ?>
							</div>
						</div>
					<center><button type="submit" name="submit" value="submit" class="btn btn-lg btn-info">Submit</button></center>					
				</div>
			</form> 
		</div>
	</div>
	
	<?php
	require 'footer.php';
	?>