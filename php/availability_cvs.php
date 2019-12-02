<?php

include("includes.php"); // Contain all necessary include files 
//include("db.php");
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>
            Availability of Medicine in CVS Pharmacy
        </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>

    <body>
        <div class="menu"> <?php include("nav_menu.php"); ?> </div>
        <div class="form">

             <h1> Availability of Medicines in CVS Pharmacy </h1>
            <h2 align="right"><a href="viewstats.php">Back to Statistics page</a></h2>
            
	    <div class="msg">  <?php echo $msg; ?> </div>

            <table width="100%" border="1" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        
                        <th><strong>Medicine Name</strong></th>
                        <th><strong>Availability of Medicine</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    
		    $query="SELECT m.medicine_name, hss.availability_of_medicine
                    from store s inner join HAS_STORE_STOCK hss
                    on s.store_id = hss.store_id
                    INNER join MEDICINE m
                    on m.medicine_id = hss.medicine_id
                    where s.store_name ='CVS Pharmacy'
                    order by s.store_name, hss.availability_of_medicine;";
		   
		    //echo $query;
		    $result = mysqli_query($con, $query);
		    while($row = mysqli_fetch_assoc($result)) { ?>
                    
		    <tr>
                        
                        <td align="center">
                            <?php echo $row["medicine_name"]; ?>
                        </td>
                        <td align="center">
                            <?php echo $row["availability_of_medicine"]; ?>
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
