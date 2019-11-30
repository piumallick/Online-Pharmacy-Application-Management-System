<?php

//include("includes.php"); // Contain all necessary include files 

include("db.php");
?>


<!DOCTYPE html>
<html>
<img src="/images/Statistics.png" width="280" height="125" align="right" />

    <head>
        <meta charset="utf-8">
        <title>
            View Statistics
        </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>

    <body>
    	<div class="form">

    		<h1><u> View Statistics for all the stores </u></h1>
    		
    		<br><br>

    		<h2> 1. Availability of medicines (quantity) in all the stores: </h2>
                <h2><a href="availability_giant_eagle.php"> a. Giant Eagle Pharmacy</a></h2>
                <h2><a href="availability_cvs.php"> b. CVS Pharmacy </a></h2>
                <h2><a href="availability_rite_aid.php"> c. Rite Aid Pharmacy </a></h2>

    		

    		<h2> 2. Maximum order items purchased by customers (usually when quantity is greater than 10): <a href="MaxOrders.php">Click here for the report </a> </h2>
    		

    		<h2> 3. Medicine Backlog: <a href="BacklogMedicine.php">Click here for the report</a>  </h2>
    		

    		<h2> 4. List of medicines whose availability is less (usually less than 7): <a href="LessAvailableMedicine.php">Click here for the report</a> </h2>
    		

    		<h2> 5. Total Sales done by all salesperson in each store: <a href="Salespersonsales.php">Click here for the report </a> </h2>
    		



    </body>

 </html>