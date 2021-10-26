<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Online Mobile Shopping</title>
    <?php 
        include("header.php"); 
        include("connection.php");
        if(!isset($_SESSION["username"])){
			header("location: login.php");
		}
        else{
            

            $username = $_SESSION['username'];
            $sql = "SELECT * FROM orders,products where orders.Email='$username' and orders.PRODUCT_ID=products.PRODUCT_ID";
            $result = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($result);
            if($count==0){
                echo "<div class='alert alert-secondary text-center' role='alert'>
                                            There is no order.
                                        </div>";
            }
            //$record = mysqli_fetch_array($result);
            //print_r($record["EMAIL"]);	
            //if(isset($_SESSION["ID"]) && $_SERVER['REQUEST_METHOD'] == 'POST'){
            //	header("location: product.php");
            //}
            
            
                if(isset($_SESSION["orderid"]) && $_SERVER['REQUEST_METHOD'] == 'POST'){    
                    $orderid = $_SESSION["orderid"];          
                    $sql = "SELECT * FROM products where PRODUCT_ID IN (Select PRODUCT_ID FROM orders where ORDERID='$orderid')";      
                    $result = mysqli_query($conn,$sql);
                    $record = mysqli_fetch_array($result);
                    $productid = $record["PRODUCT_ID"];
                    $sql = "Delete from orders where ORDERID='$orderid'";
                   
                    if($conn->query($sql)===True){
                        /*$sql = "SELECT * FROM products where PRODUCT_ID IN '(Select PRODUCT_ID FROM orders where ORDERID='$orderid')'";
                        $result = mysqli_query($conn,$sql);
                        $record = mysqli_fetch_array($result);
                        print_r($record);*/
                        $count = $record["PRODUCT_QTY"];
                        echo $count;
                        $count = $count+1;
                        $sql = "update products set PRODUCT_QTY=$count where PRODUCT_ID='$productid'";
                        echo $sql;
                        if($conn->query($sql)===True){
                            header("location: cancelmessage.php");
                        }
                        else{
                            echo "<div class='alert alert-danger text-center' role='alert'>
                                            Error Occured.
                                        </div>";	
                        }
                    }
                    /*else{
                        echo "<div class='alert alert-danger text-center' role='alert'>
                                            Error Occured.
                                        </div>";
                    }*/
            
                }
            
                
        }
       
    ?>
</head>
<body>
	<div class="container-fluid" style="width: 90%;">
    <?php while($row = mysqli_fetch_array($result)) { ?>
        <div class="row" style="margin: 3%;">
            <div class="card text-black bg-light mb-3 w-100">                    
                <div class="card-body row">
                    <div class="col-2">
                        <img style="border-radius: 5px;height: 250px;width: 150px;" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['PRODUCT_IMAGE']); ?>" alt="Card image cap">
                    </div>
                    <div class="col-6" style="padding: 0%;">
                        <h5 class="card-title"><?php echo $row["PRODUCT_NAME"]; ?> </h5>
                        <p class="card-text"><?php echo $row["PRODUCT_BRAND"]; ?></p>
                        <ul>
                            <?php echo $row["PRODUCT_DESCRIPTION"]; ?>
                        </ul>
                    </div>
                    <div style="margin-top: 6%;">
                        <h4>₹<?php echo $row["PRODUCT_PRICE"]; ?></h4>
                        <form method="POST">
                        <!-- <a href="cancelmessage.html"><button class="btn btn-danger">Cancel Order</button></a> -->
                        <input class="btn btn-danger" type="submit" name="btn_submit" value="Cancel Order">    
                    </form>
                        <?php 
                            if(isset($_POST["btn_submit"])){
                               $_SESSION["orderid"] = $row["ORDERID"];
                                    
                                
                            }
                        ?>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>
        </div>
    <?php }?>

    </div>
</body>
</html>
<?php ob_end_flush(); ?>
