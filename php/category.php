<?php
 
include("includes.php"); // Contain all necessary include files 


if ( isset($_REQUEST['form_action']) ) {


    $form_action = $_REQUEST['form_action'];
    $error_msg = "";
    
    $category_name = $_REQUEST["category_name"];
    $lower_age = $_REQUEST["lower_age"];
    $upper_age = $_REQUEST["upper_age"];
    $gender = $_REQUEST["gender"];
    
    //echo "Captured Values: ".$category_name.", ".$lower_age.", ".$upper_age.", ".$gender." ";

    // Validation :

    if ($error_msg == "") {
			
        // Put insert code here
        $sql = "INSERT INTO CATEGORY (category_name, lower_age, upper_age, gender)
                VALUES ('".$category_name."', '".$lower_age."', '".$upper_age."', '".$gender."');";

        //echo "SQL: ".$sql;

        if (mysqli_query($con, $sql)) {

            $category_id = mysqli_insert_id($con);
            $_SESSION['category_id'] = $category_id;
            $_SESSION['form_action'] = $form_action;
            header("Location: viewCategories.php"); // Redirect user to listCustomer.php

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
	<title>	Create Category </title>
	<link rel="stylesheet" href="../css/style.css" />
    
    </head>
    <body>
	 
        <div class="menu"> <?php include("nav_menu.php"); ?> </div>
       
        <div class="form">
        
        <h1> Create New Category</h1>
			
            <form name="form" method="post" action=""> 
			
                <div class="error_msg"> <?php echo $error_msg; ?> </div>

                <p><input type="text" name="category_name" placeholder="Enter Category Name" required /></p>

                <p><input type="text" name="lower_age"  placeholder="Enter Lower Age Limit" required /></p>

                <p><input type="text" name="upper_age" placeholder="Enter Upper Age Limit" required /></p>
                <p>
                    <select class="select" name="gender" required>
                        <option value="">Select gender...</option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                        <option value="A">All Genders</option>
                    </select>
                </p>	

                <p><input type="hidden" name="form_action" value="<?php echo $form_action; ?>" required /></p>

                <p><input name="submit" type="submit" value="Submit" /></p>

		    </form>
            
		 </div>

         <br />
         <br />

        </div>
    </body>
</html>
