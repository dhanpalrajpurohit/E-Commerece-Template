<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
</head>
<body>
    <?php
        include("header.php");
		
    ?>
	<div class="container">
	<div class="mt-10 card w-50 mx-auto" style="margin-top: 10%;">
		<form class="card-body col-sm-8 mx-auto" method="POST">
			<div class="mb-3 row">
    			<label for="staticEmail" class="col-sm-4 col-form-label">Email</label>
    			<div class="col-sm-8">
      				<input type="email" class="form-control" id="staticEmail" name="txt_email">
    			</div>
  			</div>
  			<div class="mb-3 row">
    			<label for="inputPassword" class="col-sm-4 col-form-label">Password</label>
    			<div class="col-sm-8">
      				<input type="password" class="form-control" id="inputPassword" name="txt_password">
    			</div>
  			</div>
  			<div class="mb-3 row">

    			<div class="col-sm-4">
      			<button type="submit" class="btn btn-dark form-control" name="btn_login">SignIn</button>
    			</div>
  			</div>
		</form>
        
        <div class="mb-3 row">
			<div class="col-sm-4 mx-auto">
                <span>Haven't account?<a href="signup.php">Click Here</a></span>
        	</div>
		</div>
	</div>
</div>
<?php
	include("connection.php");
    if(isset($_POST["btn_login"]) ){

        $username = $_POST["txt_email"];
		$password = $_POST["txt_password"];
		$sql = "SELECT * FROM accounts WHERE Email = '$username' and Password = '$password'";
		$result = mysqli_query($conn,$sql);
		$count = mysqli_num_rows($result);
		$result=mysqli_fetch_array($result);		
		if($count == 1) {
			$_SESSION['username'] = $username;
			$_SESSION["Name"] = $result["Name"]; 
			header("location: index.php");
		}else {
			echo "<div class='alert alert-danger text-center' role='alert'>
								Invalid Username and Password.
				 </div>";
		}
    }

?>
</body>
</html>