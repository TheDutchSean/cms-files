DB SHELL COMMANDS

mysql -u root -p                                                                    =   Logins in to mysql with the user root and asks for a password
SHOW DATABASES;			                                                            =	Shows all DB configured on the serve
CREATE DATABASE db_name;	                                                        =	Creates a new DB with the db_name
USE db_name;			                                                            = 	Switches to db_name
DROP DATABASE db_name;	                                                            =	Deletes db_name
GRANT ALL PRIVILEGES ON db_name.* TO “username@location”;                           =	Sets all privileges of db_name to username from the location ( this can be localhost or an IP)
GRANT ALL PRIVILEGES ON db_name.* TO “username@location” IDENTIFIED BY “password”;  =	Sets all privileges of db_name to username from the location ( this can be localhost or an IP), with the password * does not work on latest MariaDB

DCL:
CREATE TABLE table_name (                                                           =   Creates a table with the name table_name and has 2 columns id and column_name. id has the datatype int with a maximum of 11 numbers and cant be null and will auto increment if 
    id INT(11) NOT NULL AUTO_INCREMENT,                                                 a row is added. Column_name_1 has the datatype charachter with a maximum of 255. PRIMARY KEY (column_name) defines which column will be used as the primary key in this table.
    column_name_1 VARCHAR(255),
    PRIMARY KEY (column_name)                                                        
);
SHOW TABLES;                                                                        =   Shows all tables the database contains
SHOW COLUMNS FROM table_name;                                                       =   Shows a columns in a table
DROP TABLE table_name;                                                              =   Deletes table_name
ALTER TABLE table_name DO STUFF;                                                    =   Changes a table
ADD INDEX index_name (column);                                                      =   adds a index to an table usealy this is the forign key ( use in combination with ALTER TABLE)    