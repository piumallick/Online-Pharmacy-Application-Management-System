<?php
 
include("includes.php"); // Contain all necessary include files 


if ( isset($_REQUEST['form_action']) ) {


    $form_action = $_REQUEST['form_action'];
    $error_msg = "";
   
    $staff_id = $_REQUEST["staff_id"];
    $first_name = trim($_REQUEST["first_name"]);
    $last_name = trim($_REQUEST["last_name"]);
    $email_address = trim($_REQUEST["email_address"]);
    $passwd = trim($_REQUEST["passwd"]);
    $rpasswd = trim($_REQUEST["rpasswd"]);
    $phone_number = trim($_REQUEST["phone_number"]);
    $ssn = trim($_REQUEST["ssn"]);
    $date_of_joining = trim($_REQUEST["date_of_joining"]);
    $salary = trim($_REQUEST["salary"]);
    
    echo "Captured Values: ".$action.", ".$first_name.", ".$last_name.", ".$email_address.",
    	   ".$passwd.", ".$rpasswd.", ".$phone_number.", ".$ssn.", ".$date_of_joining.", 
            ".$salary.", ".$store_id.", ".$role.",".$form_action;

    // Validation :
    if ($passwd != "") { 

        if ($passwd != $rpasswd) { $error_msg .= "Password and repeat password do not match<br />"; }
    
    }
	   
    if ($error_msg == "") {
			
        if  ($form_action == "update") {

            $update = "UPDATE STAFF SET first_name='".$first_name."', 
                                        last_name='".$last_name."',      
                                        email_address='".$email_address."', 
                                        phone_number='".$phone_number."', 
                                        ssn='".$ssn."', 
                                        date_of_joining='".$date_of_joining."', 
                                        salary='".$salary."'";   
            
            if ($passwd != "") {
            
                $update .= "', passwd='".$passwd."'";
            }
            
            $update .= " WHERE staff_id=".$staff_id;

        }
	    echo "SQL: ".$update;
        if (mysqli_query($con, $update)) {
					      
            $_SESSION['staff_id'] = $staff_id;
            $_SESSION['form_action'] = $form_action;
            header("Location: viewStaff.php"); // Redirect user to viewCustomers.php

        } else {

            echo "Error: " . $sql . "" . mysqli_error($con);
        }
    } 
        
} else {
       
    // First time hiting the page so set defaults 
   
    $form_action = $_SESSION['form_action'];
    $error_msg = "";
   
    $query = "SELECT * FROM STAFF WHERE staff_id=".$_REQUEST['staff_id'];
        
    //echo "SQL: ".$query;
        
    if ($result = mysqli_query($con, $query)) {
            
        $row = mysqli_fetch_array($result);
    }
    $error_msg = "";

}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>	Edit Staff Information </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>
    <body> 
        <div class="menu"> <?php include("nav_menu.php"); ?> </div>
       
        <div class="form">
            
		    <h1> Edit Staff Information </h1>
			
		    <form name="form" method="post" action=""> 
			
                <div class="error_msg">  <?php echo $error_msg; ?>   </div>
                
                <p><input type="text" name="first_name" value="<?php echo $row["first_name"]; ?>" required /></p>

                <p><input type="text" name="last_name"  value="<?php echo $row["last_name"]; ?>" required /></p>

                <p><input type="text" name="email_address" value="<?php echo $row["email_address"]; ?>" required /></p>

                <p><input type="text" name="phone_number" value="<?php echo $row["phone_number"]; ?>" required /></p>

                <p><input type="text" name="ssn" value="<?php echo $row["ssn"]; ?>" required /></p>
                
                <p><input type="text" name="date_of_joining" value="<?php echo $row["date_of_joining"]; ?>" required /></p>
                
                <p><input type="text" name="salary" value="<?php echo $row["salary"]; ?>" required /></p>
                
                <p><input type="password" name="passwd" placeholder="Enter Password" /> Leave Blank To Keep Old Password</p>

                <p><input type="password" name="rpasswd" placeholder="Re-enter Password" /></p>		
                
                <p><input type="hidden" name="form_action" value="update" /></p>
			
                <p><input name="Update" type="submit" value="submit" /></p>

		    </form>
		</div>

    	    <br /><br /><br />
    </body>
</html>
