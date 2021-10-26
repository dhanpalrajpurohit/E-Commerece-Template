<!DOCTYPE html>
<html>
<head>
	<title>Sign-In</title>
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
</head>
<body>
    <?php
        include("header.php");
		include("connection.php");
		
		$sql = "SELECT * FROM products";
		$result = mysqli_query($conn,$sql);
		$count = mysqli_num_rows($result);	
		if(isset($_SESSION["PRODUCT_ID"]) && $_SERVER['REQUEST_METHOD'] == 'POST'){
			header("location: product.php");
		}
		
			
    ?>
	<div class="container-fluid" style="width: 90%;">
		<div class="row" style="margin-left: auto; margin-right: auto; width: 100%;">
            <?php while($row = mysqli_fetch_array($result)) { ?>
			<div class="card m-3" style="width: 18rem;border-radius: 20px;">
				<img class="card-img-top" style="border-radius: 20px; width:250px;height:300px;" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['PRODUCT_IMAGE']); ?>" alt="Card image cap">
				<div class="card-body" >
				  <h5 class="card-title" style="width:100%;margin: 0%;"><?php echo $row["PRODUCT_NAME"]; ?></h5>
				  <p class="card-text" style="margin: 0%;"><?php echo $row["PRODUCT_DESC"]; ?></p>
				  
				  <p>Price : <?php echo $row["PRODUCT_PRICE"]; ?></p>
				
				  <form method="POST" action="product.php">
					  <input type="hidden" value="<?php echo $row["PRODUCT_ID"]; ?>" name="id" />
				  	<input type="submit" value="View Details" class="btn btn-warning" name="btn_submit">
				  </form>
				  <?php
				  	if(isset($_POST["btn_submit"])){
						$_SESSION["PRODUCT_ID"] =  $row["PRODUCT_ID"];
					}
					
				  ?>
				</div>
			</div>	
            <?php }?>		  
		</div>
	</div>
</body>
</html>