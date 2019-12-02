<?php

include("includes.php"); // Contain all necessary include files 
//include("db.php");
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>
            Total Sales by Salesperson
        </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>

    <body>
        <div class="menu"> <?php include("nav_menu.php"); ?> </div>
    	<div class="form">

    		          <h1> Total Sales by Salesperson in each store: </h1>
                      <h2 align="right"><a href="viewstats.php">Back to Statistics page</a></h2>
            
        <div class="msg">  <?php echo $msg; ?> </div>


            <font size="3" >
            <table width="100%" border="1" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        
                        <th><strong>Store Name</strong></th>
                        <th><strong>Salesperson First Name</strong></th>
                        <th><strong>Salesperson Last Name</strong></th>
                        <th><strong>Sales Amount</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    
            $query="select st.store_name,
                    s.first_name, 
                    s.last_name, 
                    sum(oi.total_amt) as 'total_amt'
                    from ORDERS o, staff s, STORE st, CUSTOMERS c, ORDER_ITEMS oi
                    where o.store_id = s.store_id
                    and c.cust_id = o.cust_id
                    and o.order_id = oi.order_id
                    group by st.store_name, s.first_name, s.last_name
                    ORDER by st.store_name, s.first_name, s.last_name desc";
           
            //echo $query;
            $result = mysqli_query($con, $query);

            if (is_null($result))
            {
                echo 'There are no records';
            }

                while($row = mysqli_fetch_assoc($result)) { ?>
                    
                    <tr>
                        
                       <td align="right" style="padding-right: 10px" >
                            <?php echo $row["store_name"]; ?>
                        </td>  
                        <td align="right" style="padding-right: 10px" >
                            <?php echo $row["first_name"]; ?>
                        </td>
                        <td align="right" style="padding-right: 10px" >
                            <?php echo $row["last_name"]; ?>
                        </td>
                        <td align="center">
                            <?php echo "$".number_format($row["total_amt"], 2, '.', ','); ?>
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