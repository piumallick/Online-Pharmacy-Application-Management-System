<?php

include("includes.php"); // Contain all necessary include files 

/* This page is for customer to view available MEDS on HAS_STORE_STOCK */

$store_id = $_SESSION["store_id"];
echo $store_id;
if (isset($_GET['show'])) {
	
    //echo "No Results";
    $query="SELECT
    HAS_STORE_STOCK.stock_id,
    HAS_STORE_STOCK.medicine_id,
    MEDICINE.medicine_name,
    MEDICINE.medicine_desc,
    HAS_STORE_STOCK.unit_selling_price,
     HAS_STORE_STOCK.availability_of_medicine
   
FROM
    HAS_STORE_STOCK, MEDICINE
WHERE
	HAS_STORE_STOCK.medicine_id = MEDICINE.medicine_id AND
    HAS_STORE_STOCK.availability_of_medicine > 0 ";
    // AND HAS_STORE_STOCK.store_id =".$store_id;

//Need code to add to cart
// } elseif (isset($_SESSION['cust_id'])) {

//     $cust_id =  $_SESSION['cust_id'];
    
//         $msg = "Added to cart ";
    
//     } elseif ($_SESSION['form_action']== 'update') {
    
//         $msg = "The Customer Below was Updated successfully: ";
//     }
   
//     $query="SELECT * FROM CUSTOMERS WHERE cust_id =".$cust_id;
 
}
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>
            List Of Available Medicines 
        </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>

    <body>

        <div class="form">

            <?php include("nav_menu.php"); ?>

            <h1> List of Available Medicines </h1>
            
	    <div class="msg"> <p><?php echo $msg; ?></p> </div>
         <table>
           <tr>
                <td colspan="5">
                    <select class="select" name="store">
                                  <option value="">Select Store...</option>
                                  <?php $query = "SELECT store_id, store_name FROM STORE";
                                      $result = mysqli_query($con, $query);
                                               while($row = mysqli_fetch_assoc($result)) {
                        ?>
                              <option value="<?php echo $row['store_id'] ?>"> <?php echo $row["store_name"]?></option>
                                                
                        <?php }
                         $form_action = $_SESSION['form_action'];
                        echo $form_action
                        ?>
                    </select>
                </td>
                </tr>
         </table>

            <table width="100%" border="1" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th><strong>Name of the Medicine</strong></th>
                        <th><strong>Medicine Description</strong></th>
                        <th><strong>Unit Selling Price</strong></th>
                        <th><strong>Availablity</strong></th>
                        <th><strong>Number of items</strong></th>
                        <th><strong>Add to Cart</strong></th>
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
                                <?php echo $row["medicine_name"]; ?>
                            </td>
                            <td align="center">
                                <?php echo $row["medicine_desc"]; ?>
                            </td>
                            <td align="center">
                                <?php echo $row["unit_selling_price"]; ?>
                            </td>
                            <td align="center">
                                <?php echo $row["availability_of_medicine"]; ?>
                            </td>
                            <td align="center">
                            <input type="text" name="req_quantity" placeholder="Enter Number of Items"   />
                                <?php 

                                ?>
                            </td>
                        
                            <td align="center">
                            <a href="editStockItem.php?stock_id=<?php echo $row['stock_id']; ?>&medicine_id=<?php echo $row['medicine_id']; ?>">Add to Cart</a>
                              
                            </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
                    
                   
            <br />
        </div>
    </body>
</html>
