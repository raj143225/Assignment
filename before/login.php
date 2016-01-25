<?php
session_start();
require 'header1.php';
require 'dbinfo.php';
?>
<?php
if(isset($_POST["submit"]))
{
	$username=trim($_POST["username"]);
	$password=trim($_POST["password"]);
	if($username=="")
	{
		$_SESSION['blank_user']="Username can't be blank";
	}
	if($password=="")
	{
		$_SESSION['blank_pass']="Password can't be blank";
	}
	else
	{
		$password=md5($password);
		$query1="SELECT id FROM reg where user_name='$username' AND password='$password' And activation='1'";
		$result=mysqli_query($connection, $query1);
		if($result && $rows=mysqli_fetch_assoc($result)) 
		{
			$_SESSION["id"]=$rows["id"];
			$_SESSION["username"]=$username;
			header("Location: detail.php");
			}
		else 
		{
			$query2="SELECT id FROM reg where user_name='$username' AND password='$password'";
		    $resul1=mysqli_query($connection, $query2);
		    if(!$result1 && !$rows1=mysqli_fetch_assoc($result1)) 
			{
				$_SESSION['wrong']="Not activated";
			}
			else
			{
				$_SESSION['wrong']="Wrong username and password";
			}
		}
	}
} 
?>
<div class="col-lg-12 h1 well">	
<?php if($_SESSION['not_conf_msg']) { ?>
<lable class="lab2"><?php echo $_SESSION['not_conf_msg']; $_SESSION['not_conf_msg']=null ?></lable><?php } ?>
<?php if($_SESSION['conf_msg']) { ?>
<lable class="lab2"><?php echo $_SESSION['conf_msg']; $_SESSION['conf_msg']=null ?></lable><?php } ?>
<?php if($_SESSION['active_msg']) { ?>
<lable class="lab2"><?php echo $_SESSION['active_msg']; $_SESSION['active_msg']=null ?></lable><?php } ?>
<?php if($_SESSION['logout']) { ?>
<lable class="lab2"><?php echo $_SESSION['logout']; $_SESSION['logout']=null ?></lable><?php } ?>
<center> LogIn</center> </div>
<div class="col-lg-12 well">
	<div class="row">
		<form class="form" action="login.php" method="post">
			<div class="col-sm-12 row">
				<?php if($_SESSION['wrong']) { ?>
				<lable class="lab3"><?php echo $_SESSION['wrong']; $_SESSION['wrong']=null ?></lable><?php } ?>
				<div class="form-group">
					<label class="control-label col-sm-4" for="username"><h4><center>Username</h4></center></label>
					<div class="col-sm-8">
						<input type="text" name="username" class="form-control" id="username" placeholder="Username" value="<?php echo $username; ?>">
					</div>
					<?php if($_SESSION['blank_user']) { ?>
					<lable class="lab1"><?php echo $_SESSION['blank_user']; $_SESSION['blank_user']=null ?></lable><?php } ?>
				</div>
			</div>
			<div class="col-sm-12 row">
				<div class="form-group">
					<label class="control-label col-sm-4" name="password" for="email"><h4><center>Password</h4></center></label>
					<div class="col-sm-8">
						<input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $_SESSION['password']; ?>">
					</div>
					<?php if($_SESSION['blank_pass']) { ?>
					<lable class="lab1"><?php echo $_SESSION['blank_pass']; $_SESSION['blank_pass']=null ?></lable><?php } ?>
				</div>
			</div>
			<div class="col-sm-12 row">	
				<div class="form-group col-sm-8 b1 lb">	
					<center><button type="submit" class="btn btn-lg btn-info" name="submit" value="submit">LogIn</button></center>	
				</div >		
				<div class="form-group col-sm-4 ">			
					<a class="a1" href="forgot.php">Forgot/Change Password</a>
				</div>
			</div>
		</form> 
	</div>
</div>
<?php
require 'footer.php';
?>
