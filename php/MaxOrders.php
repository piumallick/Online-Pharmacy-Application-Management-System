<?php

include("includes.php"); // Contain all necessary include files 
//include("db.php");
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>
            Max Orders
        </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>

    <body>
    	<div class="menu"> <?php include("nav_menu.php"); ?> </div>
        <div class="form">


            <h1> Maximum order items purchased by customers (usually when quantity > 10) </h1>
            <h2 align="right"><a href="viewstats.php">Back to Statistics page</a></h2>
            
        <div class="msg">  <?php echo $msg; ?> </div>

            <table width="100%" border="1" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        
                        <th><strong>Store Name</strong></th>
                        <th><strong>Medicine Name</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    
            $query="select DISTINCT s.store_name, m.medicine_name 
                    from ORDER_ITEMS oi, MEDICINE m, ORDERS o, STORE s
                    where oi.medicine_id = m.medicine_id
                    and oi.order_id = o.order_id
                    and s.store_id = o.store_id
                    AND oi.quantity >=10
                    order by m.medicine_name;";
           
            //echo $query;
            $result = mysqli_query($con, $query);
            while($row = mysqli_fetch_assoc($result)) { ?>
                    
            <tr>
                        
                        <td align="center">
                            <?php echo $row["store_name"]; ?>
                        </td>
                        <td align="center">
                            <?php echo $row["medicine_name"]; ?>
                        </td>
                        
                    </tr>
                <?php } ?>
            </tbody>
        </table>
                    <br />
                    <br />
                    <h2><a href="viewstats.php">Back to Statistics page</a></h2>
                    <br />
                    <br />
                    <br />
                    <br />
        </div>
    </body>
</html>


    </body>

 </html>