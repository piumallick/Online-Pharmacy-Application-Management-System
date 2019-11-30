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
    $store_id = $_SESSION['store_id'];

    //echo "Captured Values: ".$action.", ".$first_name.", ".$last_name.", ".$email_address.",
    //	   ".$passwd.", ".$rpasswd.", ".$phone_number.", ".$ssn.", ".$date_of_joining.", 
    //        ".$salary.", ".$store_id.", ".$role.",".$form_action;

    // Validation :
    if (trim($passwd) != trim($rpasswd)) { $error_msg .= "Password and repeat password do not match<br />"; }

    if ($error_msg == "") {
			
        // Put insert code here
        $sql = "INSERT INTO STAFF (first_name, last_name, email_address, passwd, phone_number, 
                                    ssn, date_of_joining, salary, store_id, role)
                VALUES ('".$first_name."', '".$last_name."', '".$email_address."', '".$password."',
                        '".$phone_number."', ".$ssn.", '".$date_of_joining."', ".$salary.", ".$store_id.", 'S');";

        echo "SQL: ".$sql;

        if (mysqli_query($con, $sql)) {

            $staff_id = mysqli_insert_id($con);
            $_SESSION['staff_id'] = $staff_id;
            $_SESSION['form_action'] = $form_action;
            header("Location: viewStaff.php"); // Redirect user to viewStaff.php

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
	<title>	Create Staff </title>
	<link rel="stylesheet" href="../css/style.css" />
    
    </head>
    <body>
	 
        <div class="menu"> <?php include("nav_menu.php"); ?> </div>
       
        <div class="form">
        
        <h1> Create New Staff </h1>
			
            <form name="form" method="post" action=""> 
			
                <div class="error_msg"> <?php echo $error_msg; ?> </div>
                
                <p><input type="text" name="first_name" placeholder="Enter First Name" required /></p>

                <p><input type="text" name="last_name"  placeholder="Enter Last Name" required /></p>

                <p><input type="text" name="email_address" placeholder="Enter Email" required /></p>

                <p><input type="text" name="phone_number" placeholder="Enter Phone Number" required /></p>

                <p><input type="text" name="ssn" placeholder="Enter SSN" required /></p>
                
                <p><input type="text" name="date_of_joining" placeholder="Enter Date Hired YYYY-MM-DD" required /></p>
                
                <p><input type="text" name="salary" placeholder="Enter Staff Salary" required /></p>
                
                <p><input type="password" name="passwd" placeholder="Enter Password" required /></p>

                <p><input type="password" name="rpasswd" placeholder="Re-enter Password" required /></p>		
                
                <p><input type="hidden" name="form_action" value="<?php echo $form_action; ?>" required /></p>

                <p><input name="submit" type="submit" value="Submit" /></p>

		    </form>
		    <p style="color:#FF0000;"><?php echo $status; ?></p>
            
		 </div>

         <br />
         <br />

    </body>
</html>
