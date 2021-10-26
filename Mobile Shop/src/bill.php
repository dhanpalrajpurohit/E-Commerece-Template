<!DOCTYPE html>
<html>
<head>
	<title>Payment</title>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
</head>
<body>
    <?php
		
        include("header.php");		
		if(!isset($_SESSION["username"])){
			header("location: login.php");
		}
		$ID = $_SESSION["PRODUCT_ID"];
		$ProductName = $_SESSION["PRODUCT_NAME"];
		$ProudctPrice = $_SESSION["PRODUCT_PRICE"];

    ?>
	<?php 
			include("connection.php");
			if(isset($_POST["btn_paid"]) && $_SERVER['REQUEST_METHOD'] == 'POST' ){
				$address = $_POST["address"];
				if($address!=null){
					$sql = "SELECT * FROM orders";
					$result = mysqli_query($conn,$sql);
					$count = mysqli_num_rows($result);
					$count = $count+1;
					$id = $ID;
					$username = $_SESSION["username"];
					$productid = $ID;
					$address = $_POST["address"];
					$orderid = "O".$count;
					$sql = "insert into orders(ORDERID,EMAIL,PRODUCT_ID) values('$orderid','$username','$productid')";
					if($conn->query($sql)===True){
						$sql = "SELECT * FROM products where PRODUCT_ID='$productid'";
						$result = mysqli_query($conn,$sql);
						$record = mysqli_fetch_array($result);
						echo "".$record["PRODUCT_QTY"];
						$count = $record["PRODUCT_QTY"]-1;
						$sql = "update products set PRODUCT_QTY=$count where PRODUCT_ID='$productid'";
						if($conn->query($sql)===True){
							header("location: success.php");
						}
						else{
							echo "<div class='alert alert-danger text-center' role='alert'>
											Error Occured.
										</div>";	
						}
					}
					else{
						echo "<div class='alert alert-danger text-center' role='alert'>
											Error Occured.
										</div>";
					}
				}
				
			}
		?>
	<div class="container">
	<div class="mt-10 card w-50 mx-auto" style="margin-top: 10%;">
		<form class="card-body col-sm-8 mx-auto" action="" method="POST">
            <div class="text-center">
                <h4>Payment</h4>
            </div>
			<div class="mb-3 row">
    			<label for="staticEmail" class="col-sm-4 col-form-label">Email</label>
    			<div class="col-sm-8">
      				<input type="email" class="form-control" id="staticEmail" value="<?php echo ''.$_SESSION['username']; ?>" readonly>
					
    			</div>
  			</div>
  			<div class="mb-3 row">
    			<label for="staticEmail" class="col-sm-4 col-form-label">Name</label>
    			<div class="col-sm-8">
				<input type="email" class="form-control" id="staticEmail" value="<?php echo ''.$_SESSION['Name']; ?>" readonly>
    			</div>
  			</div>
  			<div class="mb-3 row">
    			<label for="staticEmail" class="col-sm-4 col-form-label">Address</label>
    			<div class="col-sm-8">
      				<input type="text" class="form-control" name="address" required>
    			</div>
  			</div>

            <div class="mb-3 row">
    			<label for="staticEmail" class="col-sm-4 col-form-label">Product Name</label>
    			<div class="col-sm-8">
      				<?php echo "".$_SESSION["PRODUCT_NAME"]; ?>
    			</div>
  			</div>

              <div class="mb-3 row">
    			<label for="staticEmail" class="col-sm-4 col-form-label">Total Amount</label>
    			<div class="col-sm-8">
      			<?php echo "".$_SESSION["PRODUCT_PRICE"]; ?>
    			</div>
  			</div>
  			
  			<div class="mb-3 row">
    			<div class="col-sm-4 mx-auto">
      			<button type="submit" class="btn btn-dark form-control" name="btn_paid">Paid</button>
      			</div>
  			</div>

		</form>
	</div>
</div>
</body>
</html>