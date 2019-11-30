<?php

require('db.php');
session_start();
if (isset($_POST['email'])) {

    $email = stripslashes($_REQUEST['email']); // removes backslashes
    $email = mysqli_real_escape_string($con, $email); //escapes special characters in a string
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);

    $role = $_POST['role'];
    //echo "role: ".$role;

    //Checking is user existing in the database or not
    
    if ($role == 'staff') {    
       $query = "SELECT * FROM STAFF WHERE email_address='".$email."' and passwd='".$password."'";
    } else {
       $query = "SELECT * FROM CUSTOMERS WHERE email_address='".$email."' and passwd='".$password."'";
    }

    // Sanity check 
    //echo "sql".$query;

    // Execute query
    if ($result = mysqli_query($con, $query)) {

        $rows = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result);

        // Sanity check
        //echo "rows: ".$rows;
        //echo "role: ".$row['role'];
        //echo "role: ".role;

        if ($rows == 1) {
            $_SESSION['email'] = $row['email_address'];
            $_SESSION['fname'] = $row['first_name'];
            $_SESSION['lname'] = $row['last_name'];
	        $_SESSION['store_id'] = $row['store_id'];
            
	        //echo "role: ".$role;
	     
            if ($role == 'staff') { 
               $_SESSION['role'] = $row['role'];
               $_SESSION['user_id'] = $row['staff_id'];
            } else {
               $_SESSION['role'] = $role;
               $_SESSION['user_id'] = $row['cust_id'];
            }

            /* free result set */ 
            mysqli_free_result($result);

            //echo "In secure are ".$_SESSION['email'].", ".$_SESSION['fname'].", ".$_SESSION['lname'].", //"$_SESSION['role'];
	        header("Location: index.php"); // Redirect user to index.php
	        //die();

        } else {
            echo "<div class='form'><h3>Username/password is incorrect.</h3><br/>";
            echo "Click here to <a href='login.php'>Login</a></div>";
            die();
        }

    } else {
        echo "<div class='form'><h3>Something went wrong.</h3><br/>";
        echo "Click here to <a href='login.php'>Login</a></div>";
        die();
   }
      

}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>
        Login Page 
    </title>
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body>

    <div class="form">

			<h1>Log In</h1>
			<form action="" method="post" name="login">

				<select name="role">
					<option value="customer">Customer</option>
					<option value="staff">Staff</option>
				</select>

				<input type="text" name="email" placeholder="Email" required />
				<input type="password" name="password" placeholder="Password" required />
				<input name="submit" type="submit" value="Login" />
			</form>

			<!-- INSERT YOUR CODE BEFORE THIS LINE -->

			<br />
			<br />
			<br />
			<br />
       </div>
</body>

</html>
