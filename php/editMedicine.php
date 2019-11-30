<?php
 
include("includes.php"); // Contain all necessary include files 


if ( isset($_REQUEST['form_action']) ) {


    $form_action = $_REQUEST['form_action'];
    $error_msg = "";
   
    $category_id = $_REQUEST["category_id"];
    $category_name = $_REQUEST["category_name"];
    $lower_age = $_REQUEST["lower_age"];
    $upper_age = $_REQUEST["upper_age"];
    $gender = $_REQUEST["gender"];
    
    //echo "Captured Values: ".$category_name.", ".$lower_age.", ".$upper_age.", ".$gender." ";

    // Validation :
		   
    if ($error_msg == "") {
			

        if  ($form_action == "update") {

            $update = "UPDATE CATEGORY SET category_name='".$category_name."', 
                                           lower_age='".$lower_age."',      
                                           upper_age='".$upper_age."', 
                                           gender='".$gender."'
                                           WHERE category_id=".$category_id;
            
        }
	    //echo "SQL: ".$update;
        
        if (mysqli_query($con, $update)) {
					   
            $_SESSION['category_id'] = $category_id;
            $_SESSION['form_action'] = $form_action;
            header("Location: viewCategories.php"); // Redirect user to viewCategories.php

        } else {

            echo "Error: " . $sql . "" . mysqli_error($con);
        }

    } 

        
} else {
       
    // First time hiting the page so set defaults 
   
    //echo "First time here";
    $form_action = $_SESSION['form_action'];
    $error_msg = "";
   
    $query = "SELECT * FROM CATEGORY WHERE category_id=".$_GET['category_id'];
        
    echo "SQL: ".$query;
        
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
        <title>	Edit Category </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>
    <body> 
        <div class="menu"> <?php include("nav_menu.php"); ?> </div>
       
        <div class="form">
            
		    <h1> Edit Category </h1>
			
		    <form name="form" method="post" action=""> 
			
                <div class="error_msg">  <?php echo $error_msg; ?>   </div>
                
                <p><input type="text" name="category_name" value="<?php echo $row["category_name"]; ?>" required /></p>

                <p><input type="text" name="lower_age"  value="<?php echo $row["lower_age"]; ?>" required /></p>

                <p><input type="text" name="upper_age" value="<?php echo $row["upper_age"]; ?>" required /></p>
                <p>       
			       <select class="select" name="gender" required>
                      <option value="">Select gender...</option>
                      <option <?php if ($row['gender'] == 'M' ) echo 'selected' ; ?> value="M">Male</option>
                      <option <?php if ($row['gender'] == 'F' ) echo 'selected' ; ?> value="F">Female</option>
                      <option <?php if ($row['gender'] == 'A' ) echo 'selected' ; ?> value="A">All Genders</option>
                   </select>
                </p>
            
                <p><input type="hidden" name="category_id" value="<?php echo $row["category_id"]; ?>"  /></p>
                
                <p><input type="hidden" name="form_action" value="update"  /></p>
			
                <p><input name="Update" type="submit" value="submit" /></p>

		    </form>
		</div>

    	    <br /><br /><br />
    </body>
</html>
