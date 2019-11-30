<?php
 
include("includes.php"); // Contain all necessary include files 


if ( isset($_REQUEST['form_action']) ) {


    $form_action = $_REQUEST['form_action'];
    $error_msg = "";
   
    $cust_id = $_REQUEST["cust_id"];
    $first_name = trim($_REQUEST["first_name"]);
    $last_name = trim($_REQUEST["last_name"]);
    $email_address = trim($_REQUEST["email_address"]);
    $passwd = trim($_REQUEST["passwd"]);
    $rpasswd = trim($_REQUEST["rpasswd"]);
    $phone_number = trim($_REQUEST["phone_number"]);
    $address = trim($_REQUEST["address"]);
    $gender = trim($_REQUEST["gender"]);
    $dob = trim($_REQUEST["dob"]);

    echo "Captured Values: ".$action.", ".$first_name.", ".$last_name.", ".$email_address.",
    	   ".$passwd.", ".$rpasswd.", ".$phone_number.", ".$address.", ".$gender.", ".$dob.", ".$form_action;

    // Validation :
    if ($passwd != "") { 

        if ($passwd != $rpasswd) { $error_msg .= "Password and repeat password do not match<br />"; }
    
    }

		   
    if ($error_msg == "") {
			

        if  ($form_action == "update") {

            $update = "UPDATE CUSTOMERS SET first_name='".$first_name."', 
                                            last_name='".$last_name."',      
                                            email_address='".$email_address."', 
                                            phone_number='".$phone_number."', 
                                            address='".$address."', 
                                            gender='".$gender."', 
                                            dob='".$dob."'";   
                   
            if ($passwd != "") {
            
                $update .= "', passwd='".$password."'";
            }
            
            $update .= " WHERE cust_id=".$cust_id;

            
        }
	    echo "SQL: ".$update;
        if (mysqli_query($con, $update)) {
					   
            $last_id = $cust_id;
            $_SESSION['cust_id'] = $last_id;
            $_SESSION['form_action'] = $form_action;
            header("Location: viewCustomers.php"); // Redirect user to viewCustomers.php

        } else {

            echo "Error: " . $sql . "" . mysqli_error($con);
        }

    } 

        
} else {
       
    // First time hiting the page so set defaults 
   
    //echo "First time here";
    $form_action = $_SESSION['form_action'];
    $error_msg = "";
   
    $query = "SELECT * FROM CUSTOMERS WHERE cust_id=".$_GET['cust_id'];
        
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
        <title>	Edit Customer </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>
    <body> 
        <div class="menu"> <?php include("nav_menu.php"); ?> </div>
       
        <div class="form">
            
		    <h1> Edit Customer </h1>
			
		    <form name="form" method="post" action=""> 
			
                <div class="error_msg">  <?php echo $error_msg; ?>   </div>
            
                <p><input type="text" name="first_name" value="<?php echo $row["first_name"]; ?>"required /></p>
                
                <p><input type="text" name="last_name" value="<?php echo $row["last_name"]; ?>" required /></p>
                
                <p><input type="text" name="email_address" value="<?php echo $row["email_address"]; ?>" required /></p>
                
                <p><input type="text" name="phone_number" value="<?php echo $row["phone_number"]; ?>" required /></p>
                
                <p><input type="text" name="address" value="<?php echo $row["address"]; ?>" required /></p>
                <p>       
			       <select class="select" name="gender" required>
                      <option value="">Select gender...</option>
                      <option <?php if ($row['gender'] == 'M' ) echo 'selected' ; ?> value="M">Male</option>
                      <option <?php if ($row['gender'] == 'F' ) echo 'selected' ; ?> value="F">Female</option>
                   </select>
                </p>
                <p><input type="text" name="dob" value="<?php echo $row["dob"]; ?>" required /></p>
			
                <p><input type="password" name="passwd" placeholder="New Password" /> Leave blank to keep old password</p>
			
                <p><input type="password" name="rpasswd" placeholder="Repeat New Password" /></p>		
            
                <p><input type="hidden" name="cust_id" value="<?php echo $row["cust_id"]; ?>"  /></p>
                
                <p><input type="hidden" name="form_action" value="update"  /></p>
			
                <p><input name="Update" type="submit" value="submit" /></p>

		    </form>
		</div>

    	    <br /><br /><br />
    </body>
</html>
