

/* What medicines are available in particular store */

SELECT s.store_name, m.medicine_name, hss.availability_of_medicine
from store s inner join HAS_STORE_STOCK hss
on s.store_id = hss.store_id
INNER join MEDICINE m
on m.medicine_id = hss.medicine_id
order by s.store_name, m.medicine_name;


/* Which medicines' availability is less (less than 7) */

SELECT s.store_name, m.medicine_name, hss.availability_of_medicine
from store s inner join HAS_STORE_STOCK hss
on s.store_id = hss.store_id
INNER join MEDICINE m
on m.medicine_id = hss.medicine_id
where availability_of_medicine < 7
order by s.store_name, m.medicine_name;


/* Which medicine is still in stock which are in stire for more than one year */


SELECT st.store_name,
m.medicine_name as 'Medicine Name', 
hss.availability_of_medicine as 'Medicine Count', s.supply_date as 'Supply Date'
FROM MEDICINE m, STOCK s, HAS_STORE_STOCK hss, store st
where m.medicine_id = hss.medicine_id
and hss.stock_id = s.stock_id
and st.store_id = hss.store_id
and DATEDIFF(SYSDATE(), supply_date) > 365
ORDER BY m.medicine_name, hss.availability_of_medicine;


/* Maximum order items purchased by customers (quantity >= 10) */

select DISTINCT s.store_name, m.medicine_name 
from ORDER_ITEMS oi, MEDICINE m, ORDERS o, STORE s
where oi.medicine_id = m.medicine_id
and oi.order_id = o.order_id
and s.store_id = o.store_id
AND oi.quantity >=10
order by m.medicine_name;


/* The list of customers created by salesperson*/

select DISTINCT st.store_name, concat(s.first_name,' ', s.last_name) as 'Salesperson', 
concat(c.first_name,' ', c.last_name) as "Customer Name",
oi.total_amt 'Amount'
from ORDERS o, staff s, STORE st, CUSTOMERS c, ORDER_ITEMS oi
where o.store_id = s.store_id
and c.cust_id = o.cust_id
and o.order_id = oi.order_id
ORDER by store_name, Salesperson, Amount desc;

/*Sales done by individual salesperson in each store*/
select DISTINCT st.store_name, concat(s.first_name,' ', s.last_name) as 'Salesperson', 
/*concat(c.first_name,' ', c.last_name) as "Customer Name",*/
sum(oi.total_amt) 'Amount'
from ORDERS o, staff s, STORE st, CUSTOMERS c, ORDER_ITEMS oi
where o.store_id = s.store_id
and c.cust_id = o.cust_id
and o.order_id = oi.order_id
group by st.store_name, Salesperson
ORDER by store_name, Salesperson, Amount desc;

