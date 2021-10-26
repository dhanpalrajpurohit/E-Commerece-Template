<!DOCTYPE html>
<html>
<head>
	<title>Sign-In</title>
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
		<?php 
			echo isset($error);
			if(isset($error)){ ?>
			<div class="alert alert-danger" role="alert">
  				This is a danger alert—check it out!
			</div>

		<?php	}?>
		
		<form class="card-body col-sm-8 mx-auto" name="signupform" onsubmit="formvalidation()" method="POST">
            <div class="text-center">
                <h4>Sign-Up</h4>
            </div>
			<div class="mb-3 row">
    			<label for="staticEmail" class="col-sm-4 col-form-label">Name</label>
    			<div class="col-sm-8">
      				<input type="text" class="form-control" name="txt_name" minlength="8" maxlength="16">
    			</div>
  			</div>
			<div class="mb-3 row">
    			<label for="staticEmail" class="col-sm-4 col-form-label">Email</label>
    			<div class="col-sm-8">
      				<input type="email" class="form-control" name="txt_email">
    			</div>
  			</div>
  			<div class="mb-3 row">
    			<label for="staticEmail" class="col-sm-4 col-form-label">Password</label>
    			<div class="col-sm-8">
      				<input type="password" class="form-control" name="txt_password" minlength="8" maxlength="16">
    			</div>
  			</div>
  						
  			<div class="mb-3 row">
    			<div class="col-sm-4 mx-auto">
      			<button type="submit" class="btn btn-dark form-control" name="btn_submit">SignUp</button>
      			</div>
  			</div>
		</form>
		<div class="mb-3 row">
			<div class="col-sm-4 mx-auto">
			  <span>Already have account?<a href="login.php">Click Here</a></span>
			</div>
		</div>
	</div>
</div>
<script src="signup.js"></script>
<?php
	include("connection.php");
    if(isset($_POST["btn_submit"]) ){

        $useremail = $_POST["txt_email"];
		$username = $_POST["txt_name"];
		$password = $_POST["txt_password"];
		if($username!=null && $useremail!=null && $password!=null){
			$sql = "SELECT * FROM accounts WHERE Email = '$useremail'";
		$result = mysqli_query($conn,$sql);
		$count = mysqli_num_rows($result);
		if($count==0){
			$sql = "SELECT * FROM accounts";
			$result = mysqli_query($conn,$sql);
			$count = mysqli_num_rows($result);
			$count=$count+1;
			$sql = "insert into accounts(UserID,Name,Email,Password) values($count,'$username','$useremail','$password')";
			if($conn->query($sql)===True){
				header("location: login.php");
			}
		}
		else{
				echo "<div class='alert alert-danger text-center' role='alert'>
								Email Address is already taken.
							</div>";
		}
	
		}
		
    }
?>
</body>
</html>