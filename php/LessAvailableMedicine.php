<?php

include("includes.php"); // Contain all necessary include files 
//include("db.php");
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>
            Less Available Medicines
        </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>

    <body>
        <div class="menu"> <?php include("nav_menu.php"); ?> </div>
    	<div class="form">

        <h1> List of medicines whose availability is less (usually less than 7): </h1>
        <h2 align="center"><a href="viewstats.php">Back to Statistics page</a></h2>
        <h2 >Giant Eagle Pharmacy</h2>
            
        <div class="msg">  <?php echo $msg; ?> </div>


            <font size="3" >
            <table width="50%" border="1" style="border-collapse:collapse;">
                <thead>
                    <tr>   
                        <th><strong>Medicine Name</strong></th>
                        <th><strong>Medicine Count</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                $query="SELECT  
                               m.medicine_name, 
                               hss.availability_of_medicine
                        from store s inner join HAS_STORE_STOCK hss
                        on s.store_id = hss.store_id
                        INNER join MEDICINE m
                        on m.medicine_id = hss.medicine_id
                        where availability_of_medicine < 7
                        and s.store_name = 'Giant Eagle Pharmacy'
                        order by s.store_name, m.medicine_name;";

                //echo $query;
                $result = mysqli_query($con, $query);
                while($row = mysqli_fetch_assoc($result)) { ?>

                <tr>


                            <td align="left">
                                <?php echo $row["medicine_name"]; ?>
                            </td>
                            <td align="center">
                                <?php echo $row["availability_of_medicine"]; ?>
                            </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            </font>
             <h2 >CVS Pharmacy</h2>

            <div class="msg">  <?php echo $msg; ?> </div>

                <font size="3" >
                <table width="50%" border="1" style="border-collapse:collapse;">
                    <thead>
                        <tr>


                            <th><strong>Medicine Name</strong></th>
                            <th><strong>Medicine Count</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                $query="SELECT  
                               m.medicine_name, 
                               hss.availability_of_medicine
                        from store s inner join HAS_STORE_STOCK hss
                        on s.store_id = hss.store_id
                        INNER join MEDICINE m
                        on m.medicine_id = hss.medicine_id
                        where availability_of_medicine < 7
                        and s.store_name = 'CVS Pharmacy'
                        order by s.store_name, m.medicine_name;";

                //echo $query;
                $result = mysqli_query($con, $query);
                while($row = mysqli_fetch_assoc($result)) { ?>

                <tr>


                            <td align="left">
                                <?php echo $row["medicine_name"]; ?>
                            </td>
                            <td align="center">
                                <?php echo $row["availability_of_medicine"]; ?>
                            </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            </font>
            
            <h2>Rite Aid Pharmacy</h2>

            <div class="msg">  <?php echo $msg; ?> </div>

                <font size="3" >
                <table width="50%" border="1" style="border-collapse:collapse;">
                    <thead>
                        <tr>


                            <th><strong>Medicine Name</strong></th>
                            <th><strong>Medicine Count</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                $query="SELECT  
                               m.medicine_name, 
                               hss.availability_of_medicine
                        from store s inner join HAS_STORE_STOCK hss
                        on s.store_id = hss.store_id
                        INNER join MEDICINE m
                        on m.medicine_id = hss.medicine_id
                        where availability_of_medicine < 7
                        and s.store_name = 'Rite Aid Pharmacy'
                        order by s.store_name, m.medicine_name;";

                //echo $query;
                $result = mysqli_query($con, $query);
                while($row = mysqli_fetch_assoc($result)) { ?>

                <tr>


                            <td align="left">
                                <?php echo $row["medicine_name"]; ?>
                            </td>
                            <td align="center">
                                <?php echo $row["availability_of_medicine"]; ?>
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