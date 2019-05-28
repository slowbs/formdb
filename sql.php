//describe
CREATE TEMPORARY TABLE `temp`
SELECT ...
FROM ...
LIMIT 0;

DESCRIBE `temp`;

CREATE TEMPORARY TABLE `temp`
SELECT *
FROM province
LIMIT 0;

DESCRIBE `temp`


// select table_name
SELECT table_name as d FROM information_schema.tables where table_schema='formdb';
SELECT table_name as d FROM information_schema.tables where table_schema='formdb' and table_name = 'province';

//insert if duplicate update
INSERT INTO table (column_list)
VALUES (value_list)
ON DUPLICATE KEY UPDATE
   c1 = v1, 
   c2 = v2,