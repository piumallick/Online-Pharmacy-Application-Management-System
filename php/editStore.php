<?php
 
include("includes.php"); // Contain all necessary include files 


if ( isset($_REQUEST['form_action']) ) {


    $form_action = $_REQUEST['form_action'];
    $error_msg = "";
   
    $the_store_id = $_REQUEST["the_store_id"];
    $store_name = $_REQUEST["store_name"];
    $store_address = $_REQUEST["store_address"];
    
    //echo "Captured Values: ".$the_store_id.", ".$store_name.", ".$store_address." ";

    // Validation :
		   
    if ($error_msg == "") {
			

        if  ($form_action == "update") {

            $update = "UPDATE STORE SET store_name='".$store_name."', 
                                        store_address='".$store_address."'                                        
                                        WHERE store_id=".$the_store_id;
            
        }
	    //echo "SQL: ".$update;
        
        if (mysqli_query($con, $update)) {
					   
            $_SESSION['the_store_id'] = $the_store_id;
            $_SESSION['form_action'] = $form_action;
            header("Location: viewStores.php"); // Redirect user to viewStores.php

        } else {

            echo "Error: " . $sql . "" . mysqli_error($con);
        }

    } 

        
} else {
       
    // First time hiting the page so set defaults 
   
    //echo "First time here";
    $form_action = $_SESSION['form_action'];
    $error_msg = "";
   
    $query = "SELECT * FROM STORE WHERE store_id=".$_GET['the_store_id'];
        
    //echo "SQL: ".$query;
        
    if ($result = mysqli_query($con, $query)) {
            
        $row = mysqli_fetch_array($result);
        //echo $row["first_name"];
    }
    $error_msg = "";

}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>	Edit Store </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>
    <body> 
        <div class="menu"> <?php include("nav_menu.php"); ?> </div>
       
        <div class="form">
            
		    <h1> Edit Store </h1>
			
		    <form name="form" method="post" action=""> 
			
                <div class="error_msg">  <?php echo $error_msg; ?>   </div>
                
                <p><input type="text" name="store_name" value="<?php echo $row["store_name"]; ?>" required /></p>

                <p><input type="text" name="store_address"  value="<?php echo $row["store_address"]; ?>" required /></p>

                <p><input type="hidden" name="the_store_id" value="<?php echo $row["store_id"]; ?>"  /></p>
                
                <p><input type="hidden" name="form_action" value="update"  /></p>
			
                <p><input name="Update" type="submit" value="submit" /></p>

		    </form>
		</div>

    	    <br /><br /><br />
    </body>
</html>
