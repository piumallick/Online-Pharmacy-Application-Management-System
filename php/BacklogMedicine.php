<?php

include("includes.php"); // Contain all necessary include files 
//include("db.php");
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>
            Medicine Backlog
        </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>

    <body>
        <div class="menu"> <?php include("nav_menu.php"); ?> </div>
    	<div class="form">

    		   <h1> Medicine Backlog (Medicines which are  in store for > 1 year) </h1>
               <h2 align="right"><a href="viewstats.php">Back to Statistics page</a></h2>

                <div class="msg">  <?php echo $msg; ?> </div>

            <table width="100%" border="1" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th><strong>Store Name</strong></th>
                        <th><strong>Medicine Name</strong></th>
                        <th><strong>Medicine Availability/Count</strong></th>
                        <th><strong>Supply Date</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    
            $query="SELECT st.store_name,
                    m.medicine_name, 
                    hss.availability_of_medicine, 
                    s.supply_date
                    FROM MEDICINE m, STOCK s, HAS_STORE_STOCK hss, store st
                    where m.medicine_id = hss.medicine_id
                    and hss.stock_id = s.stock_id
                    and st.store_id = hss.store_id
                    and DATEDIFF(SYSDATE(), supply_date) > 365
                    ORDER BY m.medicine_name, hss.availability_of_medicine;";
           
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
                        <td align="center">
                            <?php echo $row["availability_of_medicine"]; ?>
                        </td>
                        <td align="center">
                            <?php echo $row["supply_date"]; ?>
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