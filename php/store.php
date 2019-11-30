<?php
 
include("includes.php"); // Contain all necessary include files 


if ( isset($_REQUEST['form_action']) ) {


    $form_action = $_REQUEST['form_action'];
    $error_msg = "";
    
    $store_name = $_REQUEST["store_name"];
    $store_address = $_REQUEST["store_address"];
    
    //echo "Captured Values: ".$store_name.", ".$store_address." ";

    // Validation :

    if ($error_msg == "") {
			
        // Put insert code here
        $sql = "INSERT INTO STORE (store_name, store_address)
                VALUES ('".$store_name."', '".$store_address."');";

        //echo "SQL: ".$sql;

        if (mysqli_query($con, $sql)) {

            $the_store_id = mysqli_insert_id($con);
            $_SESSION['the_store_id'] = $the_store_id;
            $_SESSION['form_action'] = $form_action;
            header("Location: viewStores.php"); // Redirect user to viewStores.php

        } else {

            echo "Error: " . $sql . "" . mysqli_error($con);
        }

    } 
        
} else {
    
    //echo "First time here";
    $form_action = "insert";
    $error_msg = "";
    
}

?>

<!DOCTYPE html>
<html>
    <head>
   
   	<meta charset="utf-8">
	<title>	Create Store </title>
	<link rel="stylesheet" href="../css/style.css" />
    
    </head>
    <body>
	 
        <div class="menu"> <?php include("nav_menu.php"); ?> </div>
       
        <div class="form">
        
        <h1> Create New Store </h1>
			
            <form name="form" method="post" action=""> 
			
                <div class="error_msg"> <?php echo $error_msg; ?> </div>

                <p><input type="text" name="store_name" placeholder="Enter Store Name" required /></p>

                <p><input type="text" name="store_address"  placeholder="Enter Store Address" required /></p>

                <p><input type="hidden" name="form_action" value="<?php echo $form_action; ?>" required /></p>

                <p><input name="submit" type="submit" value="Submit" /></p>

		    </form>
            
		 </div>

         <br />
         <br />

        </div>
    </body>
</html>
