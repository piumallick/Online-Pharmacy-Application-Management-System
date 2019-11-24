
/* Load Data script for STORE table */
LOAD DATA INFILE '1store.csv' 
INTO TABLE store 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

/* Load Data script for CUSTOMERS table */
LOAD DATA INFILE '2customers.csv' 
INTO TABLE customers 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

/* Load Data script for STAFF table */
LOAD DATA INFILE '3staff.csv' 
INTO TABLE staff 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

/* Load Data script for MEDICINE table */
LOAD DATA INFILE '4medicine.csv' 
INTO TABLE medicine 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

/* Load Data script for MEDICINE_CATEGORY table */
LOAD DATA INFILE '5medicine_category.csv' 
INTO TABLE medicine_category 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

/* Load Data script for SUPPLIER table */
LOAD DATA INFILE '6supplier.csv' 
INTO TABLE supplier 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

/* Load Data script for STORE table */
LOAD DATA INFILE '7stock.csv' 
INTO TABLE stock 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

/* Load Data script for HAS_STOCK_SUPPLY table */
LOAD DATA INFILE '8has_stock_supply.csv' 
INTO TABLE has_stock_supply 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

/* Load Data script for HAS_STORE_STOCK table */
LOAD DATA INFILE '9has_store_stock.csv' 
INTO TABLE has_store_stock 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

/* Load Data script for ORDERS table */
LOAD DATA INFILE '10orders.csv' 
INTO TABLE orders 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

/* Load Data script for ORDER_ITEMS table */
LOAD DATA INFILE '11order_items.csv' 
INTO TABLE order_items 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

