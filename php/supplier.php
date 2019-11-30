<?php
 
include("includes.php"); // Contain all necessary include files 


if ( isset($_REQUEST['form_action']) ) {


    $form_action = $_REQUEST['form_action'];
    $error_msg = "";
    
    $supplier_name = $_REQUEST["supplier_name"];
    $address = $_REQUEST["address"];
    $phone_number = $_REQUEST["phone_number"];
    $email_address = $_REQUEST["email_address"];
    
    //echo "Captured Values: ".$supplier_name.", ".$address.", ".$phone_number.", ".$email_address." ";

    if ($error_msg == "") {
			
        // Put insert code here
        $sql = "INSERT INTO SUPPLIER (supplier_name, address, phone_number, email_address)
                VALUES ('".$supplier_name."', '".$address."', '".$phone_number."', '".$email_address."');";

        //echo "SQL: ".$sql;

        if (mysqli_query($con, $sql)) {

            $the_supplier_id = mysqli_insert_id($con);
            $_SESSION['the_supplier_id'] = $the_supplier_id;
            $_SESSION['form_action'] = $form_action;
            header("Location: viewSuppliers.php"); // Redirect user to viewSuppliers.php

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
	<title>	Create Supplier </title>
	<link rel="stylesheet" href="../css/style.css" />
    
    </head>
    <body>
	 
        <div class="menu"> <?php include("nav_menu.php"); ?> </div>
       
        <div class="form">
        
        <h1> Create New Supplier</h1>
			
            <form name="form" method="post" action=""> 
			
                <div class="error_msg"> <?php echo $error_msg; ?> </div>

                <p><input type="text" name="supplier_name" placeholder="Enter Supplier Name" required /></p>

                <p><input type="text" name="address"  placeholder="Enter Supplier Address" required /></p>

                <p><input type="text" name="phone_number" placeholder="Enter Supplier Phone Number" required /></p>
                
                <p><input type="text" name="email_address" placeholder="Enter Supplier Address" required /></p>
                
                <p><input type="hidden" name="form_action" value="<?php echo $form_action; ?>" required /></p>

                <p><input name="submit" type="submit" value="Submit" /></p>

		    </form>
            
		 </div>

         <br />
         <br />

    </body>
</html>
