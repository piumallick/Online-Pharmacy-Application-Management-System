<?php
 
include("includes.php"); // Contain all necessary include files 
$store_id = $_SESSION["store_id"];
$stock_id = $_REQUEST["stock_id"];
$medicine_id = trim($_REQUEST["medicine_id"]);
//if ( isset($_REQUEST['Update'] ) {

 if ( isset($_REQUEST['form_action']) ) {


    $form_action = $_REQUEST['form_action'];
    $error_msg = "";
   
    
    $unit_cost_price = trim($_REQUEST["unit_cost_price"]);
    $manufacture_date = trim($_REQUEST["manufacture_date"]);
    $expiry_date = trim($_REQUEST["expiry_date"]);
    $quantity = trim($_REQUEST["quantity"]);

    // echo "Captured Values: ".$action.", ".$unit_cost_price.", ".$unit_cost_price.", ".$email_address.",
    // 	   ".$passwd.", ".$rpasswd.", ".$phone_number.", ".$address.", ".$gender.", ".$dob.", ".$form_action;

    // Validation :	   
    if ($error_msg == "") {
			

        if  ($form_action == "update") {

            $update = "UPDATE HAS_STOCK_SUPPLY SET unit_cost_price=".$unit_cost_price.", 
                                            manufacture_date='".$manufacture_date."',      
                                            expiry_date='".$expiry_date."', 
                                            quantity=".$quantity;   
                   
           
            
            $update .= " WHERE stock_id=".$stock_id;
            $update .= " AND medicine_id=".$medicine_id;
            
        }
        //echo "SQL: ".$update;
        

        if (mysqli_query($con, $update)) {
            $update_has_store_stock_total_amt = " UPDATE HAS_STOCK_SUPPLY SET total_cost= (quantity*unit_cost_price) " ;
            mysqli_query($con, $update_has_store_stock_total_amt);
            
            $update_has_store_stock_record = "UPDATE HAS_STORE_STOCK SET UNIT_SELLING_PRICE = 
            ((SELECT HAS_STOCK_SUPPLY.UNIT_COST_PRICE FROM HAS_STOCK_SUPPLY 
            WHERE HAS_STOCK_SUPPLY.stock_id = HAS_STORE_STOCK.stock_id and HAS_STOCK_SUPPLY.medicine_id = HAS_STORE_STOCK.medicine_id) * 1.15) ,
             HAS_STORE_STOCK.availability_of_medicine = ".$quantity.
                         "  WHERE HAS_STORE_STOCK.stock_id = ".$stock_id." and HAS_STORE_STOCK.medicine_id = ".$medicine_id; 

             mysqli_query($con, $update_has_store_stock_record);

            $update_stock_total_amt = "UPDATE STOCK
             SET total_cost = (SELECT SUM(HAS_STOCK_SUPPLY.total_cost) 
             FROM HAS_STOCK_SUPPLY WHERE 
             HAS_STOCK_SUPPLY.stock_id =  STOCK.stock_id and
             HAS_STOCK_SUPPLY.supplier_id =  STOCK.supplier_id 
             GROUP BY HAS_STOCK_SUPPLY.stock_id ) ";

             mysqli_query($con, $update_stock_total_amt); 

             $update_stock_total_amt = " update STOCK
             SET total_cost = total_cost * (1 + overhead_pct*0.01)";  
             mysqli_query($con, $update_stock_total_amt); 


            $last_id = $stock_id;
            $_SESSION['stock_id'] = $last_id;
            $_SESSION['form_action'] = $form_action;
            header("Location: storeStockItems.php"); // storeStockItems.php

        } else {

            echo "Error: " . $sql . "" . mysqli_error($con);
        }

    } 

        
}
 else {
       
    // First time hiting the page so set defaults 
   
    //echo "First time here";
    $form_action = $_SESSION['form_action'];
    $error_msg = "";
    $stock_id = $_REQUEST["stock_id"];
    $medicine_id = trim($_REQUEST["medicine_id"]);

    $query = "SELECT HAS_STOCK_SUPPLY.stock_id,HAS_STOCK_SUPPLY.medicine_id, MEDICINE.medicine_name,HAS_STOCK_SUPPLY.unit_cost_price,HAS_STOCK_SUPPLY.manufacture_date, 
    HAS_STOCK_SUPPLY.expiry_date , HAS_STOCK_SUPPLY.quantity, HAS_STOCK_SUPPLY.total_cost from HAS_STOCK_SUPPLY, MEDICINE
                where HAS_STOCK_SUPPLY.medicine_id = MEDICINE.medicine_id  and stock_id = ".$stock_id." and HAS_STOCK_SUPPLY.medicine_id = ".$medicine_id; 

        
    //echo "SQL: ".$query;
        
    if ($result = mysqli_query($con, $query)) {
            
        $row = mysqli_fetch_array($result);
        //echo $row["first_name"];
    }
    $error_msg = "";

} 
// } elseif (isset($_REQUEST['Delete']){

//     echo "Delete";
//     $_SESSION['stock_id'] = $stock_id;
//     header("Location: storeStockItems.php");
// }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>	Edit Stock Item </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>
    <body> 
        <div class="menu"> <?php include("nav_menu.php"); ?> </div>
       
        <div class="form">
            
		    <h1> Edit Stock Item </h1>
			
		    <form name="form" method="post" action=""> 
			
                <div class="error_msg">  <?php echo $error_msg; ?>   </div>
                 
                 <table>
                <tr><td>MEDICINE_NAME </td><td><h2><?php echo $row['medicine_name']; ?> </h2></tr> </td>
                <tr>
                <td>UNIT COST PRICE </td> <td><input type="text" name="unit_cost_price" value="<?php echo $row["unit_cost_price"]; ?>"required /></td> </tr>
                <tr>
                <td>MANUFACTURE DATE </td> <td><input type="text" name="manufacture_date" value="<?php echo $row["manufacture_date"]; ?>" required /></td> </tr>
                <tr>
                <td>EXPIRY DATE</td> <td><input type="text" name="expiry_date" value="<?php echo $row["expiry_date"]; ?>" required /></td> </tr>
                <tr>
                <td>QUANTITY</td> <td><input type="text" name="quantity" value="<?php echo $row["quantity"]; ?>" required /></td> </tr>
            
                <p><input type="hidden" name="stock_id" value="<?php echo $row["stock_id"]; ?>"  /></p>
                <p><input type="hidden" name="medicine_id" value="<?php echo $row["medicine_id"]; ?>"  /></p>
                
                <tr>
                <td><input type="hidden" name="form_action" value="update"  /></p></td></tr>
                <tr>
                <td colspan = 2><input name="Update" type="submit" value="Submit" /></td></tr>
             </table>   
		    </form>
		</div>

    	    <br /><br /><br />
    </body>
</html>
