<?php

    session_start();
    
    if (!isset($_SESSION["email"])) {
	header("Location: login.php");
	exit(); 
    } 
    $guest = array("dashboard", "index", "searchMeds","cart");

    $customer =  array("dashboard","index", "searchMeds","cart","orderMeds", "viewOrders","viewOrderDetail");
    
    $salesperson =  array("dashboard", "index", "searchMeds", "orderMeds", "processOrders", 
                          "customer", "viewCustomers", "editCustomer", 
                          "category", "viewCategories", "editCategory", 
                          "stock", "viewStocks", 
                          "order", "viewOrders", 
                          "viewStoreStocks", "storeStockItems","viewOrderDetail");
    
    $manager =  array("dashboard", "index", "searchMeds", "orderMeds", "processOrders", "viewOrders", "customer", 
                      "viewCustomers", "editCustomer", "stock", "viewStocks", "order", "viewOrders", "viewStoreStocks", 
                      "storeStockItems", "staff", "viewStaff", "store", "viewStores", "supplier", "viewSuppliers", "annualReport",
                      "viewOrderDetail");

    $cur_page = basename($_SERVER['SCRIPT_NAME'], ".php");
    $role = $_SESSION["role"];
  	
    $have_access = FALSE;

    //echo "role: ".$role;
    
    if ($role == "guest") {
	$have_access = in_array($cur_page, $guest); 
    } elseif ($role == "customer") {
	$have_access = in_array($cur_page, $customer);
    } elseif ($role == "S") {
	$have_access = in_array($cur_page, $salesperson);
    } elseif ($role == "M") {
	$have_access = in_array($cur_page, $manager);
    }	
    
    if (!$have_access) {

	echo "<div class='form'><h3> Sorry you do not have privileges to use this page.</h3>";
	echo "<br/>Click here to get back to your <a href='dashboard.php'>Dashborad</a></div>";
	exit();
    }
?>

