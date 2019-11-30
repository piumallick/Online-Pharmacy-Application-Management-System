<?php 

//echo "i am here";
include("includes.php"); // Contain all necessary include files 

if ( isset($_REQUEST['form_action']) ) {

$supplier = $_POST["supplier"];

if($supplier == "3001"){
$overhead_pct = 3.5;
} elseif($supplier == "3002"){
    $overhead_pct = 3.7;
} elseif($supplier == "3003"){
    $overhead_pct = 3.2;
}

if (trim($_POST["medicine1"]) != "") {

    $medicine1 = $_POST["medicine1"];
    $unit_cost_price1 = $_POST["unit_cost_price1"];
    $manufacture_date1 = $_POST["manufacture_date1"];
    $expiry_date1 = $_POST["expiry_date1"];
    $quantity1 = $_POST["quantity1"];

} else { $medicine1 = ""; }

if( trim($unit_cost_price1) != "" & trim($quantity1 != "" ) ) {
    $sub_total1 = $unit_cost_price1 * $quantity1 ;
}else{
    $sub_total1 = 0;
}

if (trim($_POST["medicine2"]) != "") {
    
    $medicine2 = $_POST["medicine2"];
    $unit_cost_price2 = $_POST["unit_cost_price2"];
    $manufacture_date2 = $_POST["manufacture_date2"];
    $expiry_date2 = $_POST["expiry_date2"];
    $quantity2 = $_POST["quantity2"];

} else { $medicine2 = ""; }

if( trim($unit_cost_price2) != "" & trim($quantity2 != "" ) ) {
    $sub_total2 = $unit_cost_price2 * $quantity2 ;
}else{
    $sub_total2 = 0;
}
if (trim($_POST["medicine3"]) != "") {
    
    $medicine3 = $_POST["medicine3"];
    $unit_cost_price3 = $_POST["unit_cost_price3"];
    $manufacture_date3 = $_POST["manufacture_date3"];
    $expiry_date3 = $_POST["expiry_date3"];
    $quantity3 = $_POST["quantity3"];
}else { $medicine3 = ""; }

if( trim($unit_cost_price3) != "" & trim($quantity3 != "" ) ) {
    $sub_total3 = $unit_cost_price3 * $quantity3 ;
}else{
    $sub_total3 = 0;
}

if (trim($_POST["medicine4"]) != "") {
    
    $medicine4 = $_POST["medicine4"];
    $unit_cost_price4 = $_POST["unit_cost_price4"];
    $manufacture_date4 = $_POST["manufacture_date4"];
    $expiry_date4 = $_POST["expiry_date4"];
    $quantity4 = $_POST["quantity4"];

}else { $medicine4 = ""; }

    if( trim($unit_cost_price4) != "" & trim($quantity4 != "" ) ) {
    $sub_total4 = $unit_cost_price4 * $quantity4 ;
}else{
    $sub_total4 = 0;
}

if (trim($_POST["medicine5"]) != "") {

    $medicine5 = $_POST["medicine5"];
    $unit_cost_price5 = $_POST["unit_cost_price5"];
    $manufacture_date5 = $_POST["manufacture_date5"];
    $expiry_date5 = $_POST["expiry_date5"];
    $quantity5 = $_POST["quantity5"];
} else { $medicine5 = ""; }

if( trim($unit_cost_price5) != "" & trim($quantity5 != "" ) ) {
    $sub_total5 = $unit_cost_price5 * $quantity5 ;
}
else{
    $sub_total5 = 0;
}
//echo $supplier;
//echo $medicine1;
//echo $unit_cost_price1;
//echo $manufacture_date1;
//echo $expiry_date1;
//echo $quantity1;
//echo $overhead_pct;

  
$stock_total_amt = $sub_total1 + $sub_total2 + $sub_total3 + $sub_total4 + $sub_total5;
$stock_total_amt = $stock_total_amt * (1 + $overhead_pct * 0.01);

$insert_stock = "INSERT INTO STOCK(supply_date, overhead_pct, total_cost,supplier_id) values (curdate(), ".$overhead_pct.", ".$stock_total_amt.", ".$supplier.")";

//echo $insert_stock;

if (mysqli_query($con, $insert_stock)) {

    $stock_id = mysqli_insert_id($con);
    
    if ($medicine1 != "") {
        
        $insert_has_stock_supply1 = "INSERT INTO HAS_STOCK_SUPPLY(stock_id, supplier_id, unit_cost_price, medicine_id,manufacture_date, expiry_date, quantity, total_cost) VALUES(".$stock_id.", ".$supplier.", ".$unit_cost_price1.", ".$medicine1.", '".$manufacture_date1."', '".$expiry_date1."', ".$quantity1.", ".$sub_total1.")";
       
        mysqli_query($con, $insert_has_stock_supply1);
        
    }
  
    if ($medicine2 != "") {
        $insert_has_stock_supply2 = "INSERT INTO HAS_STOCK_SUPPLY(stock_id, supplier_id, unit_cost_price, medicine_id,manufacture_date, expiry_date, quantity, total_cost) VALUES(".$stock_id.", ".$supplier.", ".$unit_cost_price2.", ".$medicine2.", '".$manufacture_date2."', '".$expiry_date2."', ".$quantity2.", ".$sub_total2.")";
       
        mysqli_query($con, $insert_has_stock_supply2);
    }

    if ($medicine3 != "") {
        $insert_has_stock_supply3 ="INSERT INTO HAS_STOCK_SUPPLY(stock_id, supplier_id, unit_cost_price, medicine_id,manufacture_date, expiry_date, quantity, total_cost) VALUES(".$stock_id.", ".$supplier.", ".$unit_cost_price3.", ".$medicine3.", '".$manufacture_date3."', '".$expiry_date3."', ".$quantity3.", ".$sub_total3.")";
       
        mysqli_query($con, $insert_has_stock_supply3);
    }

    if ($medicine4 != "") {
        $insert_has_stock_supply4 = "INSERT INTO HAS_STOCK_SUPPLY(stock_id, supplier_id, unit_cost_price, medicine_id,manufacture_date, expiry_date, quantity, total_cost) VALUES(".$stock_id.", ".$supplier.", ".$unit_cost_price4.", ".$medicine4.", '".$manufacture_date4."', '".$expiry_date4."', ".$quantity4.", ".$sub_total4.")";
       
        mysqli_query($con, $insert_has_stock_supply4);
    }
    

    if ($medicine5 != "") {
        $insert_has_stock_supply5 = "INSERT INTO HAS_STOCK_SUPPLY(stock_id, supplier_id, unit_cost_price, medicine_id,manufacture_date, expiry_date, quantity, total_cost) VALUES(".$stock_id.", ".$supplier.", ".$unit_cost_price1.", ".$medicine5.", '".$manufacture_date5."', '".$expiry_date5."', ".$quantity5.", ".$sub_total5.")";
       
        mysqli_query($con, $insert_has_stock_supply5);
    }
 
    
    
    $store_id = $_SESSION["store_id"];
    //echo $store_id;
 
    if ($medicine1 != "") {
        
        $insert_has_store_stock1 = "INSERT INTO `HAS_STORE_STOCK`(`store_id`, `stock_id`, `medicine_id`, `availability_of_medicine`, `unit_selling_price`) VALUES (".$store_id.", ".$stock_id.", ".$medicine1.", ".$quantity1.", 0 )";
       // echo $insert_has_store_stock1;
        mysqli_query($con, $insert_has_store_stock1);
    }
  

    if ($medicine2 != "") {
        $insert_has_store_stock2 = "INSERT INTO `HAS_STORE_STOCK`(`store_id`, `stock_id`, `medicine_id`, `availability_of_medicine`, `unit_selling_price`) VALUES (".$store_id.", ".$stock_id.", ".$medicine2.", ".$quantity2.", 0 )";
       
        mysqli_query($con, $insert_has_store_stock2);
    }

    if ($medicine3 != "") {
        $insert_has_store_stock3 = "INSERT INTO `HAS_STORE_STOCK`(`store_id`, `stock_id`, `medicine_id`, `availability_of_medicine`, `unit_selling_price`) VALUES (".$store_id.", ".$stock_id.", ".$medicine3.", ".$quantity3.", 0 )";
       
        mysqli_query($con, $insert_has_store_stock3);
    }

    if ($medicine4 != "") {
        $insert_has_store_stock4 = "INSERT INTO `HAS_STORE_STOCK`(`store_id`, `stock_id`, `medicine_id`, `availability_of_medicine`, `unit_selling_price`) VALUES (".$store_id.", ".$stock_id.", ".$medicine4.", ".$quantity4.", 0 )";
       
        mysqli_query($con, $insert_has_store_stock4);
    }
    

    if ($medicine5 != "") {
        $insert_has_store_stock5 = "INSERT INTO `HAS_STORE_STOCK`(`store_id`, `stock_id`, `medicine_id`, `availability_of_medicine`, `unit_selling_price`) VALUES (".$store_id.", ".$stock_id.", ".$medicine5.", ".$quantity5.", 0 )";
       
        mysqli_query($con, $insert_has_store_stock5);
    }
  
     $update_has_store_stock = "UPDATE `HAS_STORE_STOCK`  SET `UNIT_SELLING_PRICE` 
     = ((SELECT `UNIT_COST_PRICE` FROM `HAS_STOCK_SUPPLY` WHERE
   `HAS_STOCK_SUPPLY`.`stock_id` =  `HAS_STORE_STOCK`.`stock_id` and `HAS_STOCK_SUPPLY`.`medicine_id`
       = `HAS_STORE_STOCK`.`medicine_id`) * 1.15) WHERE `HAS_STORE_STOCK`.`stock_id` = ".$stock_id;
     echo $update_has_store_stock;
      mysqli_query($con, $update_has_store_stock);
     
    $_SESSION['stock_id'] = $stock_id;
    header("Location: storeStockItems.php");

} else {
    
    echo "Was not able to insert stock" . $sql . "" . mysqli_error($con);
   }
}

else{
    echo "Please enter the inventory details ... You may add upto 5 items at a time!";
}

?>


<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>
            Add New Stock
        </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>

    <body>

        <div class="form">

            <?php include("nav_menu.php"); ?>

                <div>

                    <h1> <!-- Insert Page Name Here --> </h1>
                    <form name="form" method="post" action=""> 
			
			<div class="error_msg">
			    <?php echo $error_msg; ?>
			</div>
            <table>
                <tr>
                <td colspan="5">
                    <select class="select" name="supplier">
                                  <option value="">Select Supplier...</option>
                                  <?php $query = "SELECT supplier_id, supplier_name FROM SUPPLIER";
                                      $result = mysqli_query($con, $query);
                                               while($row = mysqli_fetch_assoc($result)) {
                        ?>
                              <option value="<?php echo $row['supplier_id'] ?>"> <?php echo $row["supplier_name"]?></option>

                        <?php } ?>
                    </select>
                </td>
                </tr>

            <tr>
               
                <td>
                 <select class="select" name="medicine1">
                  <option value="">Select Medication...</option>
                 <?php $query = "SELECT medicine_id, medicine_name FROM MEDICINE";
                       $result = mysqli_query($con, $query);
                        while($row = mysqli_fetch_assoc($result)) {
                        ?>
                              <option value="<?php echo $row['medicine_id'] ?>"> <?php echo $row["medicine_name"]?></option>

                        <?php } ?>
                  </select>
                </td>
                <td><input type="text" name="unit_cost_price1" placeholder="Enter Unit Price"   /></td>

                <td><input type="text" name="manufacture_date1" placeholder="Enter Manufacturer Date YYYY-MM-DD"   /></td>

                <td><input type="text" name="expiry_date1" placeholder="Enter Expiry Date YYYY-MM-DD"   /></td>

                <td><input type="text" name="quantity1" placeholder="Enter Quantity"   /></td>

               
            </tr>

            <tr>
               
                <td>
                 <select class="select" name="medicine2">
                  <option value="">Select Medication...</option>
                 <?php $query = "SELECT medicine_id, medicine_name FROM MEDICINE";
                       $result = mysqli_query($con, $query);
                        while($row = mysqli_fetch_assoc($result)) {
                        ?>
                              <option value="<?php echo $row['medicine_id'] ?>"> <?php echo $row["medicine_name"]?></option>

                        <?php } ?>
                  </select>
                </td>
                <td><input type="text" name="unit_cost_price2" placeholder="Enter Unit Price"   /></td>

                <td><input type="text" name="manufacture_date2" placeholder="Enter Manufacturer Date YYYY-MM-DD"   /></td>

                <td><input type="text" name="expiry_date2" placeholder="Enter Expiry Date YYYY-MM-DD"   /></td>

                <td><input type="text" name="quantity2" placeholder="Enter Quantity"   /></td>

               
            </tr>

            <tr>
               
                <td>
                 <select class="select" name="medicine3">
                  <option value="">Select Medication...</option>
                 <?php $query = "SELECT medicine_id, medicine_name FROM MEDICINE";
                       $result = mysqli_query($con, $query);
                        while($row = mysqli_fetch_assoc($result)) {
                        ?>
                              <option value="<?php echo $row['medicine_id'] ?>"> <?php echo $row["medicine_name"]?></option>

                        <?php } ?>
                  </select>
                </td>
                <td><input type="text" name="unit_cost_price3" placeholder="Enter Unit Price"   /></td>

                <td><input type="text" name="manufacture_date3" placeholder="Enter Manufacturer Date YYYY-MM-DD"   /></td>

                <td><input type="text" name="expiry_date3" placeholder="Enter Expiry Date YYYY-MM-DD"   /></td>

                <td><input type="text" name="quantity3" placeholder="Enter Quantity"   /></td>

               
            </tr>

            <tr>
               
                <td>
                 <select class="select" name="medicine4">
                  <option value="">Select Medication...</option>
                 <?php $query = "SELECT medicine_id, medicine_name FROM MEDICINE";
                       $result = mysqli_query($con, $query);
                        while($row = mysqli_fetch_assoc($result)) {
                        ?>
                              <option value="<?php echo $row['medicine_id'] ?>"> <?php echo $row["medicine_name"]?></option>

                        <?php } ?>
                  </select>
                </td>
                <td><input type="text" name="unit_cost_price4" placeholder="Enter Unit Price"   /></td>

                <td><input type="text" name="manufacture_date4" placeholder="Enter Manufacturer Date YYYY-MM-DD"   /></td>

                <td><input type="text" name="expiry_date4" placeholder="Enter Expiry Date YYYY-MM-DD"   /></td>

                <td><input type="text" name="quantity4" placeholder="Enter Quantity"   /></td>

               
            </tr>  
            <tr>
               
                <td>
                 <select class="select" name="medicine5">
                  <option value="">Select Medication...</option>
                 <?php $query = "SELECT medicine_id, medicine_name FROM MEDICINE";
                       $result = mysqli_query($con, $query);
                        while($row = mysqli_fetch_assoc($result)) {
                        ?>
                              <option value="<?php echo $row['medicine_id'] ?>"> <?php echo $row["medicine_name"]?></option>

                        <?php } ?>
                  </select>
                </td>
                <td><input type="text" name="unit_cost_price5" placeholder="Enter Unit Price"   /></td>

                <td><input type="text" name="manufacture_date5" placeholder="Enter Manufacturer Date YYYY-MM-DD"   /></td>

                <td><input type="text" name="expiry_date5" placeholder="Enter Expiry Date YYYY-MM-DD"   /></td>

                <td><input type="text" name="quantity5" placeholder="Enter Quantity"   /></td>

               
            </tr>
                <tr><input type="hidden" name="form_action" value=“insert”/></tr>            
                <tr> <td colspan="5" ><input name="submit" type="submit" value="Submit" /></td></tr>
            </table>
		    </form>
                    <br />
                    <br />
                    <br />
                    <br />
                </div>
        </div>
    </body>
</html>
