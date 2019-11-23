
CREATE DATABASE `ONLINE_DATABASE_PHARMACY`;

CREATE TABLE IF NOT EXISTS STORE(
  store_id INT NOT NULL AUTO_INCREMENT,
  store_name VARCHAR(50) NOT NULL,
  store_address VARCHAR(50) NOT NULL,
  PRIMARY KEY (store_id)
 );

 CREATE TABLE IF NOT EXISTS CUSTOMERS(
  cust_id int NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(255) NOT NULL,
  last_name VARCHAR(255) NOT NULL,
  email_address VARCHAR(255) NOT NULL,
  passwd VARCHAR(255) NOT NULL,
  phone_number VARCHAR(255) NOT NULL,
   address VARCHAR(255) NOT NULL,
   gender VARCHAR(1) NOT NULL,
   dob DATE NOT NULL,
   PRIMARY KEY(cust_id),

  );
  ALTER TABLE CUSTOMERS AUTO_INCREMENT = 100;


CREATE TABLE IF NOT EXISTS STAFF(
    staff_id INT NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email_address VARCHAR(255) NOT NULL,
    passwd VARCHAR(255) NOT NULL,
    phone_number VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL,
    date_of_joining DATE NOT NULL,
    salary INT NOT NULL,
    ssn INT NOT NULL,
    store_id INT NOT NULL,
    PRIMARY KEY (staff_id),
    CONSTRAINT Store_details FOREIGN KEY
                (store_id) REFERENCES STORE(store_id)
 );

 ALTER TABLE STAFF AUTO_INCREMENT = 200;

 CREATE TABLE MEDICINE (
   medicine_id int NOT NULL AUTO_INCREMENT,
   medicine_name varchar (255) NOT NULL,
   medicine_desc varchar (255) NOT NULL,
   unit_selling_price float NOT NULL,
   PRIMARY KEY (medicine_id)
 );

 ALTER TABLE MEDICINE AUTO_INCREMENT = 1000;


 CREATE TABLE CATEGORY (
   category_id int NOT NULL AUTO_INCREMENT,
   category_name varchar (20) NOT NULL,
   lower_age varchar (10) NOT NULL,
   upper_age varchar (10) NOT NULL,
   gender varchar (2) NOT NULL,
   PRIMARY KEY (category_id)
  );

 CREATE TABLE MEDICINE_CATEGORY (
     category_id int NOT NULL REFERENCES CATEGORY(category_id) ,
     medicine_id int NOT NULL REFERENCES MEDICINE(medicine_id),
     PRIMARY KEY (category_id, medicine_id)
  );

CREATE TABLE SUPPLIER (
  supplier_id int NOT NULL AUTO_INCREMENT,
  supplier_name varchar (50) NOT NULL,
  address varchar (255) NOT NULL,
  phone_number varchar (20) NOT NULL,
  email_address varchar (20) NOT NULL,
  PRIMARY KEY (supplier_id)
);

CREATE TABLE STOCK (
  stock_id int NOT NULL AUTO_INCREMENT,
  supply_date date NOT NULL,
  tax_pct float NOT NULL,
  total_cost float (20) NOT NULL,
  supplier_id varchar (20) NOT NULL REFERENCES SUPPLIER (supplier_id),
  PRIMARY KEY (stock_id)
);

CREATE TABLE HAS_STOCK_SUPPLY(
    stock_id INT NOT NULL,
    supplier_id INT NOT NULL,
    unit_cost_price VARCHAR(20) NOT NULL,
    medicine_id VARCHAR(20) NOT NULL,
    manufacture_date DATE NOT NULL,
    expiry_date DATE NOT NULL,
    quantity INT(20) NOT NULL,
    PRIMARY KEY(
        stock_id,
        supplier_id,
        medicine_id
    )
);

CREATE TABLE HAS_STORE_STOCK (
  store_id int NOT NULL,
  stock_id int NOT NULL,
  medicine_id int NOT NULL,
  availability_of_medicine varchar (4) NOT NULL,
  PRIMARY KEY (stock_id,store_id,medicine_id)
);

CREATE TABLE ORDERS(
  order_id int NOT NULL AUTO_INCREMENT,
  total_amt int(20) NOT NULL,
  order_date date NOT NULL,
  tax_pct float NOT NULL,
  cust_id int NOT NULL REFERENCES CUSTOMER(cust_id),
  store_id int NOT NULL REFERENCES STORE(store_id),
  PRIMARY KEY (order_id)
 );

CREATE TABLE ORDER_ITEMS (
  order_id int NOT NULL REFERENCES ORDERS(order_id),
  medicine_id int NOT NULL REFERENCES HAS_STORE_STOCK(medicine_id),
  unit_selling_price float NOT NULL,
  quantity int NOT NULL,
  total_amt float NOT NULL,
  PRIMARY KEY (order_id,medicine_id)
);
