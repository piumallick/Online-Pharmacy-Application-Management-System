<?php
/*
Author: Javed Ur Rehman
Website: https://www.allphptricks.com/
*/

include("includes.php"); // Contain all necessary include files 

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Welcome Home</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body>
    <div class="form">
        <?php include("nav_menu.php"); ?>
            <p>Welcome
                <?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?>!</p>
            <p>This is secure area.</p>

            <br />
            <br />
            <br />
            <br />
    </div>
</body>

</html>
