<!DOCTYPE html>
<html>
<head>
	<title>Online Mobile Shopping</title>
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->

</head>
<?php
     include("header.php"); 
     include("connection.php");
    if(!isset($_SESSION["username"])){
        //echo $_SESSION["username"];
        header("location: login.php");
    }
    if(isset($_POST["btn_psubmit"])){
        header("location: bill.php");
    }
?>
<body>
    <?php
       
        $_SESSION["PRODUCT_ID"] =  $_POST["id"];
        $ID = $_SESSION["PRODUCT_ID"];
        $sql = "SELECT * FROM products where PRODUCT_ID='$ID'";
		$result = mysqli_query($conn,$sql);
		$count = mysqli_num_rows($result);
    ?>
   
	<div class="container-fluid" style="width: 90%;">
    <?php 
    
    while($row = mysqli_fetch_array($result)) { ?>
        <div class="row" style="margin: 4%;">
            <div class="col-4">
                <img style="border-radius: 20px;" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['PRODUCT_IMAGE']); ?>" alt="Card image cap">
            </div>
            <div class="col-4" style="margin-top: 3%;">
                <h5 class="card-title font-weight-bold" style="width:100%;margin: 0%;"><?php echo $row["PRODUCT_NAME"]; ?></h5>
                <p class="card-text" style="margin: 0%;">Brand Name : <?php echo $row["PRODUCT_BRAND"] ?></p>

                <p class="card-text" style="margin: 0%;">6 Months Free Screen Replacement for Prime</p>
                <p class="card-text">Available Quantity : <?php echo $row["PRODUCT_QTY"]; ?></p>
                <p>Deal Price : <?php echo $row["PRODUCT_PRICE"]; ?></p>
                <table>
                    <tr><td><b>Model Name</b></td><td><?php echo $row["PRODUCT_NAME"]; ?></td></tr>	
                    <tr><td><b>Wireless Carrier</b></td><td>Unlocked for All Carriers</td></tr>	
                    <tr><td><b>Brand</b></td><td> <?php echo $row["PRODUCT_BRAND"] ?></td></tr>	
                    <tr><td><b>Form factor</b></td><td>Brand</td></tr>
                </table>
                <div>
                    <!-- <a href="bill.php"><button class="btn btn-warning" name="btn_submit">Buy Now</button></a> -->
                    <form method="POST" action="bill.php">    
                        <?php
                            $_SESSION["PRODUCT_NAME"] = $row["PRODUCT_NAME"];
                            $_SESSION["PRODUCT_PRICE"] = $row["PRODUCT_PRICE"];
                            $_SESSION["PRODUCT_ID"] = $row["PRODUCT_ID"];
                        ?>
                        <input name="PRODUCT_NAME" type="hidden" value=<?php echo $row["PRODUCT_NAME"];?> style="display:none;"  />
                        <input name="PRODUCT_PRICE" type="hidden" value=<?php echo $row["PRODUCT_PRICE"];?> style="display:none;" />
				        <input name="ID" type="hidden" value=<?php echo $row["PRODUCT_ID"]; ?> style="display:none;"/>
				  	    <input type="submit" class="btn btn-warning" name="btn_psubmit" value="Buy Now">
				    </form>
                </div>
            </div>
            <div class="col-4">
                
                    <p class="font-weight-bold">About this item</p>
                    <div class="d-flex justify-content-center">
                        <ul>
                            <?php echo $row["PRODUCT_DESCRIPTION"]; ?>
                        </ul>
                    </div>
            </div>
        </div>
        <div>
            <b><hr></b>
        </div>
    <?php }?>	
   
	</div>

    
</body>
</html>