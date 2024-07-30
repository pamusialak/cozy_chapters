 CREATE DATABASE cozyChapters;
 
USE cozyChapters;
 
 CREATE TABLE books(
	isbn varchar(13) primary key,
	book_name varchar(50),
	authors_name varchar(50),
	number_of_pages int,
	edition int,
	publisher varchar(30),
    original_language varchar(10),
	date_added date DEFAULT (date('now')),
	image VARCHAR (255)	
 );

CREATE table phpadmins(
	user_id int not null auto_increment,
	first_name varchar (255),
	last_name varchar (255),
	username varchar (255),
	password varchar (255),
    primary key (user_id)
);

CREATE table phppeople(
	ID int not null auto_increment,
	fname varchar (255),
	lname varchar (255),
	email varchar (255),
	telNumber varchar (255),
    primary key (ID)
);