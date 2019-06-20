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


  SELECT * FROM `1216225318` 
 WHERE NOT EXISTS 
  ( SELECT * FROM rr where rr.id= `1216225318`.id and rr.name =rr.name 
  and `1216225318`.command=rr.command and `1216225318`.tbname=rr.tbname)


SELECT * FROM `1216225318`
 WHERE NOT EXISTS 
  ( SELECT * FROM rr 
   where rr.myid = `1216225318`.myid and rr.id = `1216225318`.id)


   SELECT * FROM `552009646` WHERE NOT EXISTS 
   ( SELECT * FROM `rr` where `552009646`.`id`=rr.`id` and `552009646`.`name`=rr.`name` 
   and `552009646`.`command`=rr.`command` and `552009646`.`tbname`=rr.`tbname` )

   INSERT into rr (id, name, command, tbname, date_created)
SELECT * FROM `1787681753` WHERE NOT EXISTS ( SELECT * FROM `rr` where `1787681753`.`id`=rr.`id` 
and `1787681753`.`name`=rr.`name` and `1787681753`.`command`=rr.`command` and `1787681753`.`tbname`=rr.`tbname` )



120915746



SELECT * INTO OUTFILE 'file/test.csv'
  FIELDS TERMINATED BY ',' 
  OPTIONALLY ENCLOSED BY '\"' 
  ESCAPED BY '\"' 
  LINES TERMINATED BY '\n'
FROM `120915746` WHERE NOT EXISTS ( SELECT * FROM `kpi_input_client` 
where `120915746`.`id`=kpi_input_client.`id` and `120915746`.`a1`=kpi_input_client.`a1` 
and `120915746`.`a2`=kpi_input_client.`a2` and `120915746`.`a3`=kpi_input_client.`a3` 
and `120915746`.`a4`=kpi_input_client.`a4` and `120915746`.`a5`=kpi_input_client.`a5` 
and `120915746`.`a6`=kpi_input_client.`a6` and `120915746`.`a7`=kpi_input_client.`a7` 
and `120915746`.`a8`=kpi_input_client.`a8` and `120915746`.`a9`=kpi_input_client.`a9` 
and `120915746`.`a10`=kpi_input_client.`a10` and `120915746`.`a11`=kpi_input_client.`a11` 
and `120915746`.`a12`=kpi_input_client.`a12` and `120915746`.`b1`=kpi_input_client.`b1` 
and `120915746`.`b2`=kpi_input_client.`b2` and `120915746`.`b3`=kpi_input_client.`b3` 
and `120915746`.`b4`=kpi_input_client.`b4` and `120915746`.`b5`=kpi_input_client.`b5` 
and `120915746`.`b6`=kpi_input_client.`b6` and `120915746`.`b7`=kpi_input_client.`b7` 
and `120915746`.`b8`=kpi_input_client.`b8` and `120915746`.`b9`=kpi_input_client.`b9` 
and `120915746`.`b10`=kpi_input_client.`b10` and `120915746`.`b11`=kpi_input_client.`b11` 
and `120915746`.`b12`=kpi_input_client.`b12` and `120915746`.`apcode`=kpi_input_client.`apcode` 
and `120915746`.`hospcode`=kpi_input_client.`hospcode` and `120915746`.`kpi_id`=kpi_input_client.`kpi_id` )



//select into outfile txt
SELECT * INTO OUTFILE 'file/atable.txt' FROM `120915746` WHERE NOT EXISTS ( SELECT * FROM `kpi_input_client` where `120915746`.`id`=kpi_input_client.`id` and `120915746`.`a1`=kpi_input_client.`a1` and `120915746`.`a2`=kpi_input_client.`a2` and `120915746`.`a3`=kpi_input_client.`a3` and `120915746`.`a4`=kpi_input_client.`a4` and `120915746`.`a5`=kpi_input_client.`a5` and `120915746`.`a6`=kpi_input_client.`a6` and `120915746`.`a7`=kpi_input_client.`a7` and `120915746`.`a8`=kpi_input_client.`a8` and `120915746`.`a9`=kpi_input_client.`a9` and `120915746`.`a10`=kpi_input_client.`a10` and `120915746`.`a11`=kpi_input_client.`a11` and `120915746`.`a12`=kpi_input_client.`a12` and `120915746`.`b1`=kpi_input_client.`b1` and `120915746`.`b2`=kpi_input_client.`b2` and `120915746`.`b3`=kpi_input_client.`b3` and `120915746`.`b4`=kpi_input_client.`b4` and `120915746`.`b5`=kpi_input_client.`b5` and `120915746`.`b6`=kpi_input_client.`b6` and `120915746`.`b7`=kpi_input_client.`b7` and `120915746`.`b8`=kpi_input_client.`b8` and `120915746`.`b9`=kpi_input_client.`b9` and `120915746`.`b10`=kpi_input_client.`b10` and `120915746`.`b11`=kpi_input_client.`b11` and `120915746`.`b12`=kpi_input_client.`b12` and `120915746`.`apcode`=kpi_input_client.`apcode` and `120915746`.`hospcode`=kpi_input_client.`hospcode` and `120915746`.`kpi_id`=kpi_input_client.`kpi_id` )

//load data infile


//load data infile with column_list
LOAD DATA INFILE 'file/atable.txt' INTO TABLE kpi_input_client (`id`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`, `a7`, `a8`, `a9`, `a10`, `a11`, `a12`, `b1`, `b2`, `b3`, `b4`, `b5`, `b6`, `b7`, `b8`, `b9`, `b10`, `b11`, `b12`, `apcode`, `hospcode`, `kpi_id`, `date_created`)




//select into outfile txt with option
SELECT * INTO OUTFILE 'file/atable.txt' 
FIELDS TERMINATED BY ',' 
  OPTIONALLY ENCLOSED BY '\"' 
  ESCAPED BY '\"' 
  LINES TERMINATED BY '\n'
FROM `120915746` WHERE NOT EXISTS ( SELECT * FROM `kpi_input_client` where `120915746`.`id`=kpi_input_client.`id` and `120915746`.`a1`=kpi_input_client.`a1` and `120915746`.`a2`=kpi_input_client.`a2` and `120915746`.`a3`=kpi_input_client.`a3` and `120915746`.`a4`=kpi_input_client.`a4` and `120915746`.`a5`=kpi_input_client.`a5` and `120915746`.`a6`=kpi_input_client.`a6` and `120915746`.`a7`=kpi_input_client.`a7` and `120915746`.`a8`=kpi_input_client.`a8` and `120915746`.`a9`=kpi_input_client.`a9` and `120915746`.`a10`=kpi_input_client.`a10` and `120915746`.`a11`=kpi_input_client.`a11` and `120915746`.`a12`=kpi_input_client.`a12` and `120915746`.`b1`=kpi_input_client.`b1` and `120915746`.`b2`=kpi_input_client.`b2` and `120915746`.`b3`=kpi_input_client.`b3` and `120915746`.`b4`=kpi_input_client.`b4` and `120915746`.`b5`=kpi_input_client.`b5` and `120915746`.`b6`=kpi_input_client.`b6` and `120915746`.`b7`=kpi_input_client.`b7` and `120915746`.`b8`=kpi_input_client.`b8` and `120915746`.`b9`=kpi_input_client.`b9` and `120915746`.`b10`=kpi_input_client.`b10` and `120915746`.`b11`=kpi_input_client.`b11` and `120915746`.`b12`=kpi_input_client.`b12` and `120915746`.`apcode`=kpi_input_client.`apcode` and `120915746`.`hospcode`=kpi_input_client.`hospcode` and `120915746`.`kpi_id`=kpi_input_client.`kpi_id` )

//load data infile with option
LOAD DATA INFILE 'file/atable.txt' INTO TABLE kpi_input_client 
FIELDS TERMINATED BY ',' 
  OPTIONALLY ENCLOSED BY '\"' 
  ESCAPED BY '\"' 
  LINES TERMINATED BY '\n'
(`id`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`, `a7`, `a8`, `a9`, `a10`, `a11`, `a12`, `b1`, `b2`, `b3`, `b4`, `b5`, `b6`, `b7`, `b8`, `b9`, `b10`, `b11`, `b12`, `apcode`, `hospcode`, `kpi_id`, `date_created`)



SELECT * INTO OUTFILE 'file/atable.txt' FROM `1276035828` WHERE NOT EXISTS ( SELECT * FROM `rr` where `1276035828`.`id`=rr.`id` and `1276035828`.`name`=rr.`name` and `1276035828`.`command`=rr.`command` and `1276035828`.`tbname`=rr.`tbname` )

LOAD DATA INFILE 'file/atable.txt' INTO TABLE rr (`id`, `name`, `command`, `tbname`, `date_created`)

select * into OUTFILE 'C:/xampp/htdocs/github/formdb/file/test.txt' from command
