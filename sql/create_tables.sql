/* CREATING DATABASE 'ONLINE_DATABASE_PHARMACY' */
CREATE DATABASE `ONLINE_DATABASE_PHARMACY`;
/* CREATING TABLE 'STORE' */
CREATE TABLE IF NOT EXISTS STORE(
    store_id INT NOT NULL AUTO_INCREMENT,
    store_name VARCHAR(50) NOT NULL,
    store_address VARCHAR(50) NOT NULL,
    PRIMARY KEY(store_id)
);
/* CREATING TABLE 'CUSTOMERS' */
CREATE TABLE IF NOT EXISTS CUSTOMERS(
    cust_id INT NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email_address VARCHAR(255) NOT NULL,
    passwd VARCHAR(255) NOT NULL,
    phone_number VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    gender VARCHAR(1) NOT NULL,
    dob DATE NOT NULL,
    PRIMARY KEY(cust_id),
    CONSTRAINT unique_email UNIQUE(email_address),
    CONSTRAINT unique_phone UNIQUE(phone_number)
);
/* ALTER TABLE SCRIPT FOR AUTO_INCREMENT ON PRIMARY KEY */
ALTER TABLE
    CUSTOMERS AUTO_INCREMENT = 100;
    /* CREATING INDEX ON CUSTOMERS TABLE */
CREATE INDEX idx_cust ON
    CUSTOMERS(cust_id);
    /* CREATING TABLE 'STAFF' */
CREATE TABLE IF NOT EXISTS STAFF(
    staff_id INT NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email_address VARCHAR(255) NOT NULL,
    passwd VARCHAR(255) NOT NULL,
    phone_number VARCHAR(255) NOT NULL,
    ssn INT NOT NULL,
    date_of_joining DATE NOT NULL,
    salary INT NOT NULL,
    store_id INT NOT NULL,
    role VARCHAR(20) NOT NULL,
    PRIMARY KEY(staff_id),
    CONSTRAINT Store_details FOREIGN KEY(store_id) REFERENCES STORE(store_id),
    CONSTRAINT unique_email UNIQUE(email_address),
    CONSTRAINT unique_phone UNIQUE(phone_number)
);
/* ALTER TABLE SCRIPT FOR AUTO_INCREMENT ON PRIMARY KEY */
ALTER TABLE
    STAFF AUTO_INCREMENT = 200;
    /* CREATING TABLE 'MEDICINE' */
CREATE TABLE IF NOT EXISTS MEDICINE(
    medicine_id INT NOT NULL AUTO_INCREMENT,
    medicine_name VARCHAR(255) NOT NULL,
    medicine_desc VARCHAR(255) NOT NULL,
    PRIMARY KEY(medicine_id)
);
/* ALTER TABLE SCRIPT FOR AUTO_INCREMENT ON PRIMARY KEY */
ALTER TABLE
    MEDICINE AUTO_INCREMENT = 1000;
    /* CREATING TABLE 'CATEGORY' */
CREATE TABLE IF NOT EXISTS CATEGORY(
    category_id INT NOT NULL AUTO_INCREMENT,
    category_name VARCHAR(20) NOT NULL,
    lower_age VARCHAR(10) NOT NULL,
    upper_age VARCHAR(10) NOT NULL,
    gender VARCHAR(2) NOT NULL,
    PRIMARY KEY(category_id)
);
/* ALTER TABLE SCRIPT FOR AUTO_INCREMENT ON PRIMARY KEY */
ALTER TABLE
    CATEGORY AUTO_INCREMENT = 2000;
    /* CREATING TABLE 'MEDICINE_CATEGORY' */
CREATE TABLE IF NOT EXISTS MEDICINE_CATEGORY(
    category_id INT NOT NULL,
    medicine_id INT NOT NULL REFERENCES MEDICINE(medicine_id),
    PRIMARY KEY(category_id, medicine_id),
    CONSTRAINT Category_details FOREIGN KEY(category_id) REFERENCES CATEGORY(category_id),
    CONSTRAINT Medicine_details FOREIGN KEY(medicine_id) REFERENCES MEDICINE(medicine_id)
);
/* CREATING TABLE 'SUPPLIER' */
CREATE TABLE IF NOT EXISTS SUPPLIER(
    supplier_id INT NOT NULL AUTO_INCREMENT,
    supplier_name VARCHAR(50) NOT NULL,
    address VARCHAR(255) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    email_address VARCHAR(20) NOT NULL,
    PRIMARY KEY(supplier_id),
    CONSTRAINT unique_email UNIQUE(email_address),
    CONSTRAINT unique_phone UNIQUE(phone_number)
);
/* ALTER TABLE SCRIPT FOR AUTO_INCREMENT ON PRIMARY KEY */
ALTER TABLE
    SUPPLIER AUTO_INCREMENT = 3000;
    /* CREATING TABLE 'STOCK' */
CREATE TABLE IF NOT EXISTS STOCK(
    stock_id INT NOT NULL AUTO_INCREMENT,
    supply_date DATE NOT NULL,
    overhead_pct FLOAT NOT NULL,
    total_cost NUMERIC(20, 10) NOT NULL DEFAULT 0,
    supplier_id INT NOT NULL,
    PRIMARY KEY(stock_id),
    CONSTRAINT Supplier_Stock_Details FOREIGN KEY(supplier_id) REFERENCES SUPPLIER(supplier_id)
);
/* ALTER TABLE SCRIPT FOR AUTO_INCREMENT ON PRIMARY KEY */
ALTER TABLE
    STOCK AUTO_INCREMENT = 4000;
    /* CREATING TABLE 'HAS_STOCK_SUPPLY' */
CREATE TABLE IF NOT EXISTS HAS_STOCK_SUPPLY(
    stock_id INT NOT NULL,
    supplier_id INT NOT NULL,
    unit_cost_price NUMERIC(7, 4) NOT NULL DEFAULT 0,
    medicine_id INT NOT NULL,
    manufacture_date DATE NOT NULL,
    expiry_date DATE NOT NULL,
    quantity INT(20) NOT NULL DEFAULT 0,
    total_cost NUMERIC(20, 10) NOT NULL DEFAULT 0,
    PRIMARY KEY(
        stock_id,
        supplier_id,
        medicine_id
    ),
    CONSTRAINT Stock_Details FOREIGN KEY(stock_id) REFERENCES STOCK(stock_id),
    CONSTRAINT Supplier_Details FOREIGN KEY(supplier_id) REFERENCES SUPPLIER(supplier_id),
    CONSTRAINT Med_details FOREIGN KEY(medicine_id) REFERENCES MEDICINE(medicine_id)
);
/* CREATING TABLE 'HAS_STORE_STOCK' */
CREATE TABLE IF NOT EXISTS HAS_STORE_STOCK(
    store_id INT NOT NULL,
    stock_id INT NOT NULL,
    medicine_id INT NOT NULL,
    availability_of_medicine VARCHAR(4) NOT NULL,
    unit_selling_price NUMERIC(7, 4) NOT NULL DEFAULT 0,
    PRIMARY KEY(stock_id, store_id, medicine_id),
    CONSTRAINT Store_Stock_Detail FOREIGN KEY(stock_id) REFERENCES STOCK(stock_id),
    CONSTRAINT Store_St_Detail FOREIGN KEY(store_id) REFERENCES STORE(store_id),
    CONSTRAINT Medicine_St_Detail FOREIGN KEY(medicine_id) REFERENCES MEDICINE(medicine_id)
);
/* CREATING TABLE 'ORDERS' */
CREATE TABLE IF NOT EXISTS ORDERS(
    order_id INT NOT NULL AUTO_INCREMENT,
    total_amt NUMERIC(20, 10) NOT NULL,
    order_date DATE NOT NULL,
    cust_id INT NOT NULL,
    store_id INT NOT NULL,
    PRIMARY KEY(order_id),
    CONSTRAINT Cust_Orders FOREIGN KEY(cust_id) REFERENCES CUSTOMERS(cust_id),
    CONSTRAINT Store_Cust_Orders FOREIGN KEY(store_id) REFERENCES STORE(store_id)
);
/* ALTER TABLE SCRIPT FOR AUTO_INCREMENT ON PRIMARY KEY */
ALTER TABLE
    ORDERS AUTO_INCREMENT = 5000;
    /* CREATING TABLE 'ORDER_ITEMS' */
CREATE TABLE IF NOT EXISTS ORDER_ITEMS(
    order_id INT NOT NULL,
    medicine_id INT NOT NULL,
    stock_id INT NOT NULL,
    unit_selling_price NUMERIC(7, 4) NOT NULL DEFAULT 0,
    quantity INT NOT NULL DEFAULT 0,
    total_amt NUMERIC(20, 10) NOT NULL DEFAULT 0,
    PRIMARY KEY(
        order_id,
        medicine_id,
        stock_id
    ),
    CONSTRAINT Medicine_order_items FOREIGN KEY(medicine_id) REFERENCES HAS_STORE_STOCK(medicine_id),
    CONSTRAINT Order_Items_Stock FOREIGN KEY(stock_id) REFERENCES STOCK(stock_id),
    CONSTRAINT Orders_order_items FOREIGN KEY(order_id) REFERENCES ORDERS(order_id)
);