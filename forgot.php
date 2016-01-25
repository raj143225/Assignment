<?php
require 'header1.php';
require 'dbinfo.php';
require 'test.php';
session_start();
?>
<?php	
if(isset($_POST['send']))
{
	$email=trim($_POST['email']);
	$password=md5(trim($_POST["password"]));
	if((isset($_POST['email']) && $_POST['email']!=="") && (isset($_POST['password']) && $_POST['password']!==""))
	{
		$activate=md5(uniqid(rand(), true));
		$q1="SELECT IF(EXISTS(SELECT id FROM reg WHERE email_id='$email'),1,0)";
		$val=mysqli_query($connection,$q1);
		$val1=mysqli_fetch_assoc($val);
		$val2= $val1["IF(EXISTS(SELECT id FROM reg WHERE email_id='$email'),1,0)"];
		if($val2) 
		{
			$q="UPDATE reg SET activation='0',password='$password',act_com='$activate' where email_id='$email'";
			$result=mysqli_query($connection,$q);
			if($result)
			{
				mymail1($email,"click on the below link to login",$activate);
				$_SESSION['re_act']="Check your mail for Re-activation";
			}
			else
			{
				$_SESSION['wrong_email']="Somthing Wrong"; 
			}
		}
	}
	else
	{
		if($email=="")
		{
			$_SESSION['blank_email']="email can't be blank";
		}
		if($_POST["password"]=="")
		{
			$_SESSION['blank_passs']="Password can't be blank";
			
		}
	
		//$_SESSION['no_act']="Please Enter values "; 
	}
}
?>
<h1 class="well">Forgot Password</h1>
<div class="col-lg-12 well">
	<div class="row">
		<form class="form" action="forgot.php" method="post">
			<div class="col-sm-12 row">
				<?php if($_SESSION['wrong_email']) { ?>
					<lable class="lab1"><?php echo $_SESSION['wrong_email']; $_SESSION['wrong_email']=null ?></lable><?php } ?>
				<?php if($_SESSION['re_act']) { ?>
					<lable class="lab1"><?php echo $_SESSION['re_act']; $_SESSION['re_act']=null ?></lable><?php } ?>
				<div class="form-group">
					<label class="control-label col-sm-4" for="email"><h4><center>Email</h4></label>
					<div class="col-sm-8">
						<input type="text" name="email" class="form-control" id="email" placeholder="Email" value="<?php echo $_POST['email'] ?>">
						<?php if($_SESSION['blank_email']) { ?>
					<lable class="lab1"><?php echo $_SESSION['blank_email']; $_SESSION['blank_email']=null ?></lable><?php } ?>
					</div>
				</div>
			</div>
			<div class="col-sm-12 row">
				<div class="form-group">
					<label class="control-label col-sm-4" for="password"><h4><center>New password</h4></label>
					<div class="col-sm-8">
						<input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" value="<?php echo $_POST['password'] ?>">
						<?php if($_SESSION['blank_passs']) { ?>
					<lable class="lab1"><?php echo $_SESSION['blank_passs']; $_SESSION['blank_passs']=null ?></lable><?php } ?>
					</div>
				</div>
			</div>
			<div class="col-sm-12 row">	
				<div class="form-group col-sm-12 b1">	
					<center><input type="submit" class="btn btn-lg btn-info" name="send" value="send" placeholder="Send"></center>	
				</div >		
			</div>
		</form> 
	</div>
</div>
<?php
require 'footer.php';
?>