<?php
 
include("includes.php"); // Contain all necessary include files 


if ( isset($_REQUEST['form_action']) ) {


    $form_action = $_REQUEST['form_action'];
    $error_msg = "";
   
    $the_supplier_id = $_REQUEST["the_supplier_id"];
    $supplier_name = $_REQUEST["supplier_name"];
    $address = $_REQUEST["address"];
    $phone_number = $_REQUEST["phone_number"];
    $email_address = $_REQUEST["email_address"];
    
    //echo "Captured Values: ".$category_name.", ".$lower_age.", ".$upper_age.", ".$gender." ";

    // Validation :
		   
    if ($error_msg == "") {
			

        if  ($form_action == "update") {

            $update = "UPDATE SUPPLIER SET supplier_name='".$supplier_name."', 
                                           address='".$address."',      
                                           phone_number='".$phone_number."', 
                                           email_address='".$email_address."'
                                           WHERE supplier_id=".$the_supplier_id;
            
        }
	    //echo "SQL: ".$update;
        
        if (mysqli_query($con, $update)) {
					   
            $_SESSION['the_supplier_id'] = $the_supplier_id;
            $_SESSION['form_action'] = $form_action;
            header("Location: viewSuppliers.php"); // Redirect user to viewSuppliers.php

        } else {

            echo "Error: " . $sql . "" . mysqli_error($con);
        }

    } 
        
} else {
       
    // First time hiting the page so set defaults 
   
    //echo "First time here";
    $form_action = $_SESSION['form_action'];
    $error_msg = "";
   
    $query = "SELECT * FROM SUPPLIER WHERE supplier_id=".$_GET['the_supplier_id'];
        
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
        <title>	Edit Supplier </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>
    <body> 
        <div class="menu"> <?php include("nav_menu.php"); ?> </div>
       
        <div class="form">
            
		    <h1> Edit Supplier </h1>
			
		    <form name="form" method="post" action=""> 
			
                <div class="error_msg">  <?php echo $error_msg; ?>   </div>
                                
                <p><input type="text" name="supplier_name" value="<?php echo $row["supplier_name"]; ?>" required /></p>

                <p><input type="text" name="address"  value="<?php echo $row["address"]; ?>" required /></p>

                <p><input type="text" name="phone_number" value="<?php echo $row["phone_number"]; ?>" required /></p>
                
                <p><input type="text" name="email_address" value="<?php echo $row["email_address"]; ?>" required /></p>
                
                <p><input type="hidden" name="the_supplier_id" value="<?php echo $row["supplier_id"]; ?>"  /></p>
                
                <p><input type="hidden" name="form_action" value="update"  /></p>
			
                <p><input name="Update" type="submit" value="submit" /></p>

		    </form>
		</div>

    	    <br /><br /><br />
    </body>
</html>
