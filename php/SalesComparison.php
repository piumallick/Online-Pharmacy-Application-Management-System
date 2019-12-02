<?php

include("includes.php"); // Contain all necessary include files 
//include("db.php");
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>
            Total Sales per store
        </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>

    <body>
        <div class="menu"> <?php include("nav_menu.php"); ?> </div>
    	<div class="form" style="margin: auto">
            <h1> Total Sales comparison in all the stores </h1>
            <h2 align="center"><a href="viewstats.php">Back to Statistics page</a></h2>            
        <div class="msg">  <?php echo $msg; ?> </div>


            <font size="3" >
            <table width="75%" border="1" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        
                        <th><strong>Store Name</strong></th>
                        <th><strong>Total Sales</strong></th>
                       
                </tr>
            </thead>
            <tbody>
                <?php
                    
            $query="select st.store_name, 
            trim(sum(oi.total_amt))+0 as 'TotalSales'
            FROM STORE st, HAS_STORE_STOCK hss, ORDER_ITEMS oi
            where st.store_id = hss.store_id
            and hss.stock_id = oi.stock_id
            GROUP by st.store_id
            ORDER BY trim(sum(oi.total_amt))+0;";
           
            //echo $query;
            $result = mysqli_query($con, $query);

            if (is_null($result))
            {
                echo 'There are no records';
            }

                while($row = mysqli_fetch_assoc($result)) { ?>
                    
                    <tr>
                        
                       <td align="right" style="padding-right: 10px">
                            <?php echo $row["store_name"]; ?>
                        </td>  
                        <td align="center">
                            <?php echo "$".number_format($row["TotalSales"], 2, '.', ','); ?>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
        </font>
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