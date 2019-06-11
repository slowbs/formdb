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


// insert from select all without check
INSERT INTO formdb.kpi_input_client(`id`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`,
`a7`, `a8`, `a9`, `a10`, `a11`, `a12`, `b1`, `b2`, `b3`, `b4`, `b5`, `b6`, `b7`,
`b8`, `b9`, `b10`, `b11`, `b12`, `apcode`, `hospcode`, `kpi_id`, `date_created`) 
select *, NOW() from kpiprovince.input_client;


CREATE TEMPORARY TABLE `temp`
SELECT *
FROM kpiprovince.input_amphur;

INSERT INTO formdb.kpi_input_client(`id`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`,
`a7`, `a8`, `a9`, `a10`, `a11`, `a12`, `b1`, `b2`, `b3`, `b4`, `b5`, `b6`, `b7`,
`b8`, `b9`, `b10`, `b11`, `b12`, `apcode`, `kpi_id`, `date_created`) 
select *, NOW() from `temp`;


SELECT * INTO OUTFILE 'file/test.csv'
  FIELDS TERMINATED BY ',' 
  OPTIONALLY ENCLOSED BY '\"' 
  ESCAPED BY '\"' 
  LINES TERMINATED BY '\n'
  FROM command;


  `id`, `name`, `command`, `tbname`


  LOAD DATA INFILE 'file/test.csv' INTO TABLE rr (col1,col2,col3,col4);


  LOAD DATA INFILE 'file/test.csv' INTO TABLE rr 
  FIELDS TERMINATED BY ',' 
  OPTIONALLY ENCLOSED BY '\"' 
  ESCAPED BY '\"' 
  LINES TERMINATED BY '\n'
  (id,name,command,tbname);


  update md5 SET md5 = md5(pass) where 1;