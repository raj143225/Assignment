<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>MINDFIRE</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
   <link href="css/styleform.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> <link href="css/business-casual.css" rel="stylesheet">
     <script>
        function readURL(input) 
        {
            if (input.files && input.files[0]) 
            {
            var reader = new FileReader();

            reader.onload = function (e) 
            {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(130);
            };

            reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</head>
<body>
    <div class="brand">Mindfire Solutions</div>
    <div class="address-bar">MANCHESHWAR | BHUBANESHWAR | ORISSA</div>
    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="#">Mindfire Solutions</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                        if(!$_SESSION['id'])
                        {
                    ?>
                    <li>
                        <a href="login.php">LogIn</a>
                    </li>
                    <li>
                        <a href="form.php">Register</a>
                    </li><?php } ?>
                    <li>
                     <?php
                        if($_SESSION['id'])
                        {
                    ?>
                        <a href="profile.php">Update</a>
                    </li>
                    <li>
                        <a href="detail.php">Profile</a>

                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                    <?php } ?>
                </ul>
                <?php
                    if($_SESSION['id'])
                    {
                ?>
                <div class="namee">Welcome <?php echo $_SESSION['username']; ?></div>
                 <?php
                    }
                 ?>   
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<div class="container">


