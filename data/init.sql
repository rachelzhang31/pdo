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
	PROGRAMID		INT(4) PRIMARY KEY, 
	PROGRAMNAME		VARCHAR(40) NOT NULL, 
);  

CREATE TABLE VOLUNTEER ( 
  	VOLUNTEERID	INT(4) PRIMARY KEY, 
	VOLUTEERFNAME	VARCHAR(15) NOT NULL, 
	VOLUNTEERLNAME	VARCHAR(15) NOT NULL, 
	VOLUNTEERYEAR 	INT(1) NOT NULL,
	VOLUNTEERPHONE	VARCHAR(15), 
	VOLUNTEEREMAIL	VARCHAR(254) NOT NULL, 
  	PROGRAMID		INT(4) NOT NULL, 
  	SITEID			INT(4) NOT NULL,
	FOREIGN KEY (PROGRAMID) REFERENCES PROGRAM(PROGRAMID), 
	FOREIGN KEY (SITEID) REFERENCES SITE(SITEID) 
);  

CREATE TABLE DIRECTOR ( 
  	DIRECTORID		INT(4) PRIMARY KEY, 
	DIRECTORFNAME	VARCHAR(15) NOT NULL, 
	DIRECTORLNAME	VARCHAR(15) NOT NULL, 
	DIRECTORPHONE	VARCHAR(15), 
	DIRECTORYEAR	INT(1) NOT NULL, 
	DIRECTOREMAIL	VARCHAR(254) NOT NULL,
  	PROGRAMID		INT(4) NOT NULL, 
	FOREIGN KEY (PROGRAMID) REFERENCES PROGRAM(PROGRAMID), 
	FOREIGN KEY (SITEID) REFERENCES SITE(SITEID) 
); 

CREATE TABLE INSTRUCTOR ( 
  	INSTRUCTORID		INT(4) PRIMARY KEY, 
	INSTRUCTORNAME		VARCHAR(30) NOT NULL, 
	INSTRUCTORPHONE		VARCHAR(15), 
	INSTRUCTOREMAIL		VARCHAR(254) NOT NULL, 
  	SITEID				INT(4) NOT NULL,
	FOREIGN KEY (SITEID) REFERENCES SITE (SITEID) 
); 

CREATE TABLE ADMINISTRATOR ( 
  	ADMINISTRATORID		INT(4) PRIMARY KEY, 
	ADMINISTRATORFNAME	VARCHAR(15) NOT NULL, 
	ADMINISTRATORLNAME	VARCHAR(15) NOT NULL, 
	ADMINISTRATOREMAIL	VARCHAR(254) NOT NULL, 
	ADMINISTRATORPHONE	VARCHAR(15), 
); 

CREATE TABLE MANAGER (
  	MANAGERID		INT(4) PRIMARY KEY, 
	MANAGERFNAME	VARCHAR(15) NOT NULL, 
	MANAGERLNAME	VARCHAR(15) NOT NULL, 
	MANAGERPHONE	VARCHAR(15), 
	MANAGEREMAIL	VARCHAR(254) NOT NULL,
  	PROGRAMID		INT(4) NOT NULL, 
	FOREIGN KEY (PROGRAMID) REFERENCES PROGRAM (PROGRAMID) 
); 





