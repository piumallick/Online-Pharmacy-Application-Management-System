<?php

    include "includes.php"; // Contain all necessary include files 

    // Initialize to an empty cart
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    /* THIS PAGE IS FOR SALESPERSON to view meds */
    if(isset($_GET['storeid'])) {
        $storeid = intval($_GET['storeid']);
    } else {
        if(isset($_SESSION['cart-storeid'])) {
            if($_SESSION['cart-storeid'] > 0) {
                $storeid = $_SESSION['cart-storeid'];
            }
        } else {
            $storeid = 0;
        }
    }

    if ($_SESSION['role'] == "customer" ) {
        $query="SELECT `medicine`.`medicine_id`,`medicine`.`medicine_name`, `medicine`.`medicine_desc`,`has_store_stock`.`store_id`,`has_store_stock`.`availability_of_medicine`,`has_store_stock`.`unit_selling_price`FROM `medicine` , `has_store_stock` where medicine.medicine_id=has_store_stock.medicine_id and `has_store_stock`.`availability_of_medicine`>1 and `has_store_stock`.`store_id` = ".$storeid.";";
    }

    // Code to handle cart add button action
    if(!empty($_GET["action"])) {
        $medid = intval($_GET['medid']);
        switch($_GET["action"]) {
            
            /* [INVALID REQUEST] */
            default:
                echo "INVALID REQUEST";
                break;

            /* [ADD ITEM TO CART] */
            case "add":

                
                if(isset($_SESSION['cart'][$medid])) {
                    $_SESSION['cart'][$medid] = $_SESSION['cart'][$medid] + $_POST["quantity"];
                } else {
                    $_SESSION['cart'][$medid] = $_POST["quantity"];
                }
                $_SESSION['cart-storeid'] = $storeid;
                echo '<script language="javascript">alert("Added to cart!")</script>';
                break;
        }
    }
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>
            Medicines
        </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>

         <body>      
            <div class="form">
                
                <?php include "nav_menu.php";
                ?>
                <div>
                    <br>
                    <h1>
                    Available Medicines
                    </h1> 
                    <br>
                    <!-- INSERT YOUR HTML CODE AFTER THIS LINE -->
                    <!-- This div will hold the dropdown for selecting a store -->
                    <h2>Please select a store to display the available medicine(s)</h2>
                    <div>
                        <select id="selectedstore" name="selectedstore">
                            <option value="">Select Store...</option>
                            <?php 
                                $storequery = "SELECT store_name, store_id FROM store";
                                $storeresult = mysqli_query($con, $storequery);
                                while($storerow = mysqli_fetch_assoc($storeresult)) {
                            ?>
                                    <option value="<?php echo $storerow['store_id'] ?>"
                                        <?php if ($storeid == $storerow['store_id']) echo "selected='selected'";?>
                                        <?php if(count($_SESSION['cart']) > 0) echo " disabled ";?>
                                        > <?php echo $storerow["store_name"]?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <br>
                    <br>

                    <!-- Only show the div below if a valid store has been selected -->
                    <?php
                        if($storeid > 0) {
                    ?>
                        <div>
                            <table>
                                <thead>
                                    <tr>
                                        <th><strong>Medicine ID</strong></th>
                                        <th><strong>Medicine Name</strong></th>
                                        <th><strong>Medicine Description</strong></th>
                                        <th><strong>Unit Price</strong></th>
                                        <th><strong>Quantity Available</strong></th>
                                        <th><strong>Add to cart</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // Now execute the query
                                        $result = mysqli_query($con, $query);
                                        while($row = mysqli_fetch_assoc($result)) { 
                                    ?> 
                                        <form method="post" action="viewMeds.php?action=add&medid=<?php echo $row["medicine_id"]; ?>&storeid=<?php echo $storeid; ?>">
                                            <tr>
                                                <td align="center">
                                                    <?php echo $row["medicine_id"]; ?>
                                                </td>
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
                                                    <input type="number" max="<?php echo $row["availability_of_medicine"]; ?>" maxclass="medicine-quanity" name="quantity" value="1" size="1" />
                                                    <input type="submit" value="Add to Cart" class="btnAddAction" />
                                                </td>
                                            </tr>
                                        </form>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                    <!-- INSERT YOUR HTML CODE BEFORE THIS LINE -->
                </div>
            </div>
        </div>
    </body>
</html>

<script type="text/JavaScript"> 
    document.getElementById('selectedstore').onchange = function() {
        window.location = "viewMeds.php?storeid=" + this.value;
    };
</script> 
