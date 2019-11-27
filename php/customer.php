<?php
 
include("includes.php"); // Contain all necessary include files 


if (isset($_REQUEST['form_action'])) {


    $form_action = $_REQUEST['form_action'];
    
    if ($form_action == "insert") {

		$first_name = $_REQUEST["first_name"];
		$last_name = $_REQUEST["last_name"];
		$email_address = $_REQUEST["email_address"];
		$passwd = $_REQUEST["passwd"];
		$rpasswd = $_REQUEST["rpasswd"];
		$phone_number = $_REQUEST["phone_number"];
		$address = $_REQUEST["address"];
		$gender = $_REQUEST["gender"];
		$dob = $_REQUEST["dob"];
		   
			//echo "Captured Values: ".$action.", ".$first_name.", ".$last_name.", ".$email_address.",
			//	   ".$passwd.", ".$rpasswd.", ".$phone_number.", ".$address.", ".$gender.", ".$dob.", ".$form_action;

		$error_msg = "";
			

		if (trim($first_name) == "") { $error_msg .= "Please provide your first name.<br />"; }
					
		if (trim($last_name) == "") { $error_msg .= "Please provide your last name.<br />"; }
		
		if (trim($email_address) == "") { $error_msg .= "Please provide your email address.<br />"; }
			
		if (trim($phone_number) == "") { $error_msg .= "Please provide a contact phone number.<br />"; }
			
		if (trim($address) == "") { $error_msg .= "Please provide your address.<br />"; }
			
		if (trim($gender) == "") { $error_msg .= "Please select a gender.<br />"; }
			
		if (trim($dob) == "") { $error_msg .= "Please provide your date of birth YYYY-MM-DD.<br />"; }
			
		if (trim($passwd) == "") { $error_msg .= "Please provide a password<br />"; }
			
		if (trim($passwd) != trim($rpasswd)) { $error_msg .= "Password and repeat password do not match<br />"; }
			
			
		   
		if ($error_msg == "") {
			

			if  ($form_action == "update") {

				// Build update query 
				// Remember to check if password is different before updating

			} elseif  ($form_action == "insert") {

				// Put insert code here
				$sql = "INSERT INTO CUSTOMERS (first_name, last_name, email_address, passwd, phone_number, 
								  address, gender, dob)
					VALUES ('".$first_name."', '".$last_name."', '".$email_address."', '".$password."',
						'".$phone_number."', '".$address."', '".$gender."', '".$dob."');";
			}

			echo "SQL: ".$sql;
			//$_SESSION['new_customer'] = 102;
			//header("Location: listCustomer.php");
			//mysqli_query($con, $sql);
			//echo "The id of the last record inserted is: ".$last_id;
			//die();
			
			if (mysqli_query($con, $sql)) {
					   
				$last_id = mysqli_insert_id($con);
				$_SESSION['new_customer'] = $last_id;
				header("Location: viewCustomers.php"); // Redirect user to listCustomer.php

				} else {
				
				echo "Error: " . $sql . "" . mysqli_error($con);
				}

			} 
			
		} elseif ($form_action == "update") {


    }
} else {
    
    
    // First time hiting the page so set defaults 
   
    //echo "First time here";
    $form_action = "insert";
    $error_msg = "";

}

?>

<!DOCTYPE html>
<html>
    <head>
   
   	<meta charset="utf-8">
	<title>	Create Customer </title>
	<link rel="stylesheet" href="../css/style.css" />
    
    </head>
    <body>
	 
	<div class="menu">
	    <?php include("nav_menu.php"); ?>
        </div>
    	<div class="form">
	

     	    <!-- INSERT YOUR CODE AFTER THIS LINE --> 

		<div>
		    <h1> Create New User</h1>
			
		    <form name="form" method="post" action=""> 
			
			<div class="error_msg">
			    <?php echo $error_msg; ?>
			</div>

			<p><input type="text" name="first_name" placeholder="Enter First Name" required /></p>
			
			<p><input type="text" name="last_name" placeholder="Enter Last Name" required /></p>
			
			<p><input type="text" name="email_address" placeholder="Enter Email" required /></p>
			
			<p><input type="text" name="phone_number" placeholder="Enter Phone Number" required /></p>

			<p><input type="text" name="address" placeholder="Enter Address" required /></p>
                        
			   <select class="select" name="gender">
                              <option value="">Select gender...</option>
                              <option value="M">Male</option>
                              <option value="F">Female</option>
                           </select>

			<p><input type="text" name="dob" placeholder="Enter Date of Birth YYYY-MM-DD" required /></p>
			
			<p><input type="password" name="passwd" placeholder="Enter Password" required /></p>
			
			<p><input type="password" name="rpasswd" placeholder="Re-enter Password" required /></p>		
			
			<p><input type="hidden" name="form_action" value="<?php echo $form_action; ?>" required /></p>
			
			<p><input name="submit" type="submit" value="Submit" /></p>

		    </form>
		    <p style="color:#FF0000;"><?php echo $status; ?></p>
		</div>

     	    <!-- INSERT YOUR CODE BEFORE THIS LINE --> 

    	    <br /><br /><br /><br />

        </div>
    </body>
</html>
