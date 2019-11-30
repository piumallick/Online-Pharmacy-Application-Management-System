<?php

   if ($_SESSION['role'] == "guest") {
?>
   <p>  
   	<a href="dashboard.php">Dashboard</a> | 
	<a href="index.php">Index</a> | 
    <a href="searchMeds.php">Search Medication</a> | 
	<a href="cart.php">Cart</a>
   </p>

<?php

   } elseif ($_SESSION['role'] == "customer") {

?>
   <p>  
   	<a href="dashboard.php">Dashboard</a> | 
	<a href="index.php">Index</a> | 
    <a href="searchMeds.php">Search Medication</a> | 
    <a href="viewOrders.php">View Orders</a> |
    <a href="viewMeds.php">View Medicines</a>|
	<a href="cart.php">Cart</a> |
	<a href="logout.php">Logout</a>
   </p>
<?php

   } elseif ($_SESSION['role'] == "S") {

?>
   <p>  
   	<a href="dashboard.php">Dashboard</a> | 
	<a href="index.php">Index</a> | 
    <a href="searchMeds.php">Search Medication</a> | 
	<a href="orderMeds.php">Order Medications</a> |
    <a href="processOrder.php">Process Order</a> |
	<a href="customer.php">Customer Info</a> | 
	<a href="viewCustomers.php?show=all">View Customers</a> | 
    <a href="category.php">Category Info</a> | 
	<a href="viewCategories.php?show=all">View Categories</a> | 
    <a href="medicine.php">Medicine Info</a> | 
	<a href="viewMedicines.php?show=all">View Medicines</a> | 
	<a href="stock.php">Add Stock</a> | 
	<a href="viewStocks.php">View Stocks</a> | 
	<a href="order.php">Order Info</a> | 
    <a href="viewOrders.php">View Orders</a> | 
    <a href="viewStoreStocks.php">View Store Stocks</a> | 
    <a href="storeStockItems.php">Stock Item Info</a> | 
	<a href="logout.php">Logout</a>
   </p>

<?php

   } elseif ($_SESSION['role'] == "M") {

?>
   <p>  
   	<a href="dashboard.php">Dashboard</a> | 
	<a href="index.php">Index</a> | 
    <a href="searchMeds.php">Search Medication</a> | 
	<a href="orderMeds.php">Order Medications</a> |
    <a href="processOrder.php">Process Order</a> |
	<a href="customer.php">Customer Info</a> | 
	<a href="viewCustomers.php?show=all">View Customers</a> |
    <a href="category.php">Category Info</a> | 
	<a href="viewCategories.php?show=all">View Categories</a> |
    <a href="medicine.php">Medicine Info</a> | 
	<a href="viewMedicines.php?show=all">View Medicines</a> | 
	<a href="stock.php">Add Stock</a> | 
	<a href="viewStocks.php">View Stocks</a> | 
	<a href="order.php">Order Info</a> | 
    <a href="viewOrders.php">View Orders</a> | 
    <a href="viewStoreStocks.php">View Store Stocks</a> | 
    <a href="storeStockItems.php">Stock Item Info</a> | 
	<a href="staff.php">Staff Info</a> | 
    <a href="viewStaff.php?show=all">View Staff</a> | 
	<a href="store.php">Store Info</a> | 
    <a href="viewStores.php?show=all">View Stores</a> | 
    <a href="supplier.php">Supplier Info</a> | 
    <a href="viewSuppliers.php?show=all">View Supplier</a> | 
    <a href="annualReport.php">Annual Report</a> | 
    <a href="logout.php">Logout</a>
   </p>

<?php } ?>
