
/* Load Data script for STORE table */
LOAD DATA INFILE '/Users/aishwaryajakka/Desktop/dbms/Online-Pharmacy-Application-Management-System/data/data/1store.csv'
INTO TABLE store
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

/* Load Data script for CUSTOMERS table */
LOAD DATA INFILE '/Users/aishwaryajakka/Desktop/dbms/Online-Pharmacy-Application-Management-System/data/2customers.csv'
INTO TABLE CUSTOMERS
 FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(CUST_ID,FIRST_NAME,LAST_NAME,EMAIL_ADDRESS,PASSWD,PHONE_NUMBER,ADDRESS,GENDER,@DOB)
SET DOB  = STR_TO_DATE(@DOB, '%m/%d/%y');

/* Load Data script for STAFF table */
LOAD DATA INFILE '/Users/aishwaryajakka/Desktop/dbms/Online-Pharmacy-Application-Management-System/data/3staff.csv'
INTO TABLE STAFF
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(STAFF_ID	,FIRST_NAME	,LAST_NAME	,EMAIL_ADDRESS	,PASSWD,	PHONE_NUMBER,	SSN,	@DATE_OF_JOINING,	SALARY,	STORE_ID	,ROLE)
SET DATE_OF_JOINING  = STR_TO_DATE(@DATE_OF_JOINING, '%m/%d/%y');

/* Load Data script for MEDICINE table */
LOAD DATA INFILE '/Users/aishwaryajakka/Desktop/dbms/Online-Pharmacy-Application-Management-System/data/4medicine.csv'
INTO TABLE medicine
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

/* Load Data script for CATEGORY table */
LOAD DATA INFILE '/Users/aishwaryajakka/Desktop/dbms/Online-Pharmacy-Application-Management-System/data/5category.csv'
INTO TABLE category
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS

/* Load Data script for MEDICINE_CATEGORY table */
LOAD DATA INFILE '/Users/aishwaryajakka/Desktop/dbms/Online-Pharmacy-Application-Management-System/data/6medicine_category.csv'
INTO TABLE medicine_category
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

/* Load Data script for SUPPLIER table */
LOAD DATA INFILE '/Users/aishwaryajakka/Desktop/dbms/Online-Pharmacy-Application-Management-System//data/7supplier.csv'
INTO TABLE supplier
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

/* Load Data script for STORE table */
LOAD DATA INFILE '/Users/aishwaryajakka/Desktop/dbms/Online-Pharmacy-Application-Management-System/data/8stock.csv'
INTO TABLE STOCK FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n'
IGNORE 1 ROWS (STOCK_ID,	@SUPPLY_DATE,	OVERHEAD_PCT,TOTAL_COST,	SUPPLIER_ID)
SET SUPPLY_DATE  = STR_TO_DATE(@SUPPLY_DATE, '%m/%d/%y')

/* Load Data script for HAS_STOCK_SUPPLY table */
LOAD DATA INFILE '/Users/aishwaryajakka/Desktop/dbms/Online-Pharmacy-Application-Management-System/data/9has_stock_supply.csv'
INTO TABLE HAS_STOCK_SUPPLY
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(STOCK_ID,	SUPPLIER_ID,	UNIT_COST_PRICE,	MEDICINE_ID,	@MANUFACTURE_DATE	, @EXPIRY_DATE,	QUANTITY)
SET MANUFACTURE_DATE  = STR_TO_DATE(@MANUFACTURE_DATE, '%m/%d/%y'),
EXPIRY_DATE  = STR_TO_DATE(@EXPIRY_DATE, '%m/%d/%y')

/* Load Data script for HAS_STORE_STOCK table */
LOAD DATA INFILE '/Users/aishwaryajakka/Desktop/dbms/Online-Pharmacy-Application-Management-System/data/10has_store_stock.csv'
INTO TABLE HAS_STORE_STOCK
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

/* Load Data script for ORDERS table */
LOAD DATA INFILE '/Users/aishwaryajakka/Desktop/dbms/Online-Pharmacy-Application-Management-System/data/11orders.csv'
INTO TABLE ORDERS
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(ORDER_ID,TOTAL_AMT,@ORDER_DATE,CUST_ID,STORE_ID)
SET ORDER_DATE  = STR_TO_DATE(@ORDER_DATE, '%m/%d/%y'),
ORDER_DATE  = STR_TO_DATE(@ORDER_DATE, '%m/%d/%y')

/* Load Data script for ORDER_ITEMS table */
LOAD DATA INFILE '/Users/aishwaryajakka/Desktop/dbms/Online-Pharmacy-Application-Management-System/data/12order_items.csv'
INTO TABLE ORDER_ITEMS
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;
