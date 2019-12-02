<?php

   if ($_SESSION['role'] == "guest") {
?>
   <p>   
	<a href="index.php">Index</a> | 
    <a href="searchMeds.php">Search Medication</a> | 
	<a href="cart.php">Cart</a>
   </p>

<?php

   } elseif ($_SESSION['role'] == "customer") {

?>
   <p>  
	<a href="index.php">Index</a> | 
    <a href="viewOrders.php">Orders</a> |
    <a href="viewMeds.php">Medicines</a> |
	<a href="cart.php">Cart</a> |
	<a href="logout.php">Logout</a>
   </p>
<?php

   } elseif ($_SESSION['role'] == "S") {

?>
   <p>  
	<a href="index.php">Index</a> | 
	<a href="customer.php">Add Customer</a> | 
	<a href="viewCustomers.php?show=all">View Customers</a> | 
    <a href="category.php">Add Category</a> | 
	<a href="viewCategories.php?show=all">View Categories</a> | 
    <a href="medicine.php">Add Medicine Info</a> | 
	<a href="viewMedicines.php?show=all">View Medicines</a> | 
	<a href="stock.php">Add Stock</a> | 
	<a href="viewStocks.php?show=all">View Stocks</a> | 
    <a href="viewOrders.php?show=all">View Sales</a> | 
    <a href="viewStoreStocks.php?show=all">View Store Stocks</a> |  
	<a href="logout.php">Logout</a>
   </p>

<?php

   } elseif ($_SESSION['role'] == "M") {

?>
   <p>   
	<a href="index.php">Index</a> | 
	<a href="customer.php">Add Customer</a> | 
	<a href="viewCustomers.php?show=all">View Customers</a> | 
    <a href="category.php">Add Category</a> | 
	<a href="viewCategories.php?show=all">View Categories</a> | 
    <a href="medicine.php">Medicine Info</a> | 
	<a href="viewMedicines.php?show=all">View Medicines</a> | 
	<a href="stock.php">Add Stock</a> | 
	<a href="viewStocks.php?show=all">View Stocks</a> | 
    <a href="viewOrders.php?show=all">View Sales</a> | 
    <a href="viewStoreStocks.php?show=all">View Store Stocks</a> |  
	<a href="staff.php">Staff Info</a> | 
    <a href="viewStaff.php?show=all">View Staff</a> | 
	<a href="store.php">Store Info</a> | 
    <a href="viewStores.php?show=all">View Stores</a> | 
    <a href="supplier.php">Supplier Info</a> | 
    <a href="viewSuppliers.php?show=all">View Supplier</a> | 
<!--
    <a href="annualReport.php">Annual Report</a> | 
    <a href="availability_giant_eagle.php">Availability GE</a> | 
    <a href="availability_cvs.php">Availability CVS</a> | 
    <a href="availability_rite_aid.php">Availability RA</a> | 
    <a href="MaxOrders.php">Annual Report</a> | 
    <a href="BacklogMedicine.php">Backlog Medication</a> | 
    <a href="LessAvailableMedicine.php">Low Stock Medication</a> | 
    <a href="Salespersonsales.php">Salesperson Sales Report</a> | 
    
-->
    <a href="viewstats.php">Statistics</a> |
    <a href="logout.php">Logout</a>
   </p>

<?php } ?>
