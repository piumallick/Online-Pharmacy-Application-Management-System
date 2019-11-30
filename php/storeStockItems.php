<?php

include("includes.php"); // Contain all necessary include files 
$store_id = $_SESSION["store_id"];
if(isset($_REQUEST["stock_id"])){
    $stock_id1 = $_REQUEST["stock_id"]; //viewStocks.php, viewStoreStocks.php - store_id
} else{
    $stock_id1 = $_SESSION["stock_id"]; //stocks.php
}


$medicine_id1 = $_REQUEST["medicine_id"];
//echo $stock_id1;
//echo $store_id;
if ($stock_id1 !="") {
	
    
    $query= "select HAS_STOCK_SUPPLY.stock_id,HAS_STOCK_SUPPLY.medicine_id, MEDICINE.medicine_name,HAS_STOCK_SUPPLY.unit_cost_price,HAS_STOCK_SUPPLY.manufacture_date, 
        HAS_STOCK_SUPPLY.expiry_date , HAS_STOCK_SUPPLY.quantity, HAS_STOCK_SUPPLY.total_cost from HAS_STOCK_SUPPLY, MEDICINE
    where HAS_STOCK_SUPPLY.medicine_id = MEDICINE.medicine_id  and stock_id = ".$stock_id1;
    //echo $query;

} elseif($medicine_id1 == "")
{
    echo "No Results";
} elseif ($_SESSION['form_action']== 'update') {
    
        $msg = "The Stock Item Below was Updated successfully: ";
    
    $query= "select HAS_STOCK_SUPPLY.stock_id,HAS_STOCK_SUPPLY.medicine_id, MEDICINE.medicine_name,HAS_STOCK_SUPPLY.unit_cost_price,HAS_STOCK_SUPPLY.manufacture_date, 
                 HAS_STOCK_SUPPLY.expiry_date , HAS_STOCK_SUPPLY.quantity, HAS_STOCK_SUPPLY.total_cost from HAS_STOCK_SUPPLY, MEDICINE
                             where HAS_STOCK_SUPPLY.medicine_id = MEDICINE.medicine_id  and stock_id = ".$stock_id1." and HAS_STOCK_SUPPLY.medicine_id = ".$medicine_id1; 
}

$check_order_items = "SELECT * FROM ORDER_ITEMS WHERE stock_id = ".$stock_id1;
$result2 = mysqli_query($con, $check_order_items);
if(mysqli_num_rows($result2) == 0){
    $flag = 1;
} else{
    $flag = 0;
}

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>
            List of Stocks Items
        </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>

    <body>

        <div class="form">

            <?php include("nav_menu.php"); ?>

            <h1> List of Items in the Stock </h1>
            
	    <div class="msg"> <p><?php echo $msg; ?></p> </div>

            <table width="100%" border="1" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th><strong>Medicine Name </strong></th>
                        <th><strong>Unit Cost Price</strong></th>
                        <th><strong>Date of Manufacturing</strong></th>
                        <th><strong>Date of Expiry </strong></th>
                        <th><strong>Quantity</strong></th>
                        <th><strong>Total Amount </strong></th>
                        <th><strong>Edit</strong></th>
                        <th><strong>Delete</strong></th>
                    </tr>
                </thead>
            <tbody>
                <?php

                  //echo $query;
                  $form_action = "edit";
                  $result = mysqli_query($con, $query);
                  while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td align="center">
                                <?php echo $row["medicine_name"] ; ?>
                            </td>
                            <td align="center">
                                <?php echo $row["unit_cost_price"]; ?>
                            </td>
                            <td align="center">
                                <?php echo $row["manufacture_date"]; ?>
                            </td>
                            <td align="center">
                                <?php echo $row["expiry_date"]; ?> 
                            </td>  
                            <td align="center">
                                <?php echo $row["quantity"]; ?> 
                            </td> 
                            <td align="center">
                                <?php echo $row["total_cost"]; ?> 
                            </td>   
                            <td align="center">
                            <?php if($flag){ ?>
                               <a href="editStockItem.php?stock_id=<?php echo $row['stock_id']; ?>&medicine_id=<?php echo $row['medicine_id']; ?>">Edit</a>
                            <?php }?>   
                            </td>
                            <td align="center">
                            <?php if($flag){ ?>
                               <a href="deleteStockItem.php?stock_id=<?php echo $row['stock_id']; ?>&medicine_id=<?php echo $row['medicine_id']; ?>">Delete</a>
                            <?php }?>   
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br />
        </div>
    </body>
</html>
