CREATE DATABASE IF NOT EXISTS dbproj;

use dbproj;

CREATE TABLE SITE ( 
	SITEID			INT(4) PRIMARY KEY, 
	SITENAME		VARCHAR(50) NOT NULL, 
	SITESTREET		VARCHAR(20) NOT NULL, 
	SITECITY		VARCHAR(15) NOT NULL, 
	SITESTATE		VARCHAR(2) NOT NULL, 
	SITEZIP			VARCHAR(5) NOT NULL, 
	SITEPHONE		VARCHAR(15),
	date TIMESTAMP
); 

CREATE TABLE PROGRAM ( 
	PROGRAM_ID		INT(4) PRIMARY KEY, 
	PROGRAM_NAME	VARCHAR(40) NOT NULL, 
);  



