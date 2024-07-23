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
	date_added date DEFAULT (date('now'))	
 );