<?php
	require 'header1.php';
	require 'dbinfo.php';
	require 'validate.php';
	session_start();
?>
<?php
		$errors=array();
		if(isset($_POST["update"]))
		{
			$id=$_SESSION['id'];
			$username=trim($_POST["username"]);
			$password=trim($_POST["password"]);
			$email=trim($_POST["email"]);
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
			//post elements
			$target_dir = "/var/www/html/new/img/$img";
    		$target_file = $target_dir . basename($_FILES["img"]["name"]);
    		$img_var=basename($_FILES["img"]["name"]);
    		move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
			//image upload		
			$name_fields_presence=array("username","password","email","first_name","last_name","pno","employement","employer","street","city","state","zip","fax","street1","zip1","fax1");
			all_prestnt($name_fields_presence);
			//values are present or not
			$fields_max_length=array("username"=>20,"password"=>40,"first_name"=>20,"last_name"=>20,"pno"=>15);
			validate_max_lengths($fields_max_length);
			//max length check
			$fields_min_length=array("username"=>8,"password"=>8,"email"=>8,"pno"=>9);	
			validate_min_lengths($fields_min_length);
			if (!preg_match('/^[a-z0-9_-]+@[a-z0-9._-]+\.[a-z]+$/i', $email))
 			{
    				$errors["email"]=" wrong" . ucfirst("email") .  " pattern ";
  			}
  			//email format checking//for email varification;
  			$output=form_errors($errors);//end of validations
   			if(!$output)
   			{
   				$activate=md5(uniqid(rand(), true));//creating new unique activation code
   				$q="UPDATE reg SET user_name='$username', 
					password='$password', 
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
   					
    	 			header("Location:detail.php");
    			} 
   			 	else 
    			{
     				?><div class="colo"><?php echo "Error: " . $q . "<br>" . mysqli_error($connection); ?></div><?php
				}
			}	//for $output
			else 
			{
				?><div class="colo"><?php echo $output; ?></div><?php
			} //echo $connection->error; 
		}//for submit
?>
<?php
	require 'footer.php';
?>
