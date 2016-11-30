CREATE DATABASE  IF NOT EXISTS 1612972679_toolshop;
USE 1612972679_toolshop;

DROP TABLE IF EXISTS item;
DROP TABLE IF EXISTS categories;


CREATE TABLE categories (
	categoryID int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	categoryName varchar(45) UNIQUE
);

CREATE TABLE item (
	itemID int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	itemName varchar(45) NOT NULL,
	itemDescription varchar(255),
	itemImgPath varchar(255) DEFAULT NULL,
	itemPrice double NOT NULL,
	category_ID int(11) DEFAULT NULL,
	CONSTRAINT fk_category_ID FOREIGN KEY (category_ID) 
    REFERENCES categories (categoryID)
);

DROP TABLE IF EXISTS users;

CREATE TABLE users (
	userID int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	firstName varchar(55) NOT NULL,
	lastName varchar(55) NOT NULL,
	userEmail varchar(125) NOT NULL,
	userName varchar(55) NOT NULL,
	userPassword varchar(255) NOT NULL,
	accessLevel tinyint(4) DEFAULT '1',
	activity bit(1) DEFAULT b'1'
);

DELIMITER $$

DROP FUNCTION IF EXISTS SetAccessLevel $$

CREATE FUNCTION setAccessLevel(access_level tinyint,user_id int,admin_id int) 
RETURNS int
BEGIN

	if(select accessLevel from Users where userID = admin_id) = 3 then
		update Users set accessLevel = access_level where userID = user_id and activity = 1;
        return access_level;
	else
		return(select accessLevel from Users where userID = user_id and activity = 1);
	end if;

END $$

DELIMITER ;

DELIMITER $$

DROP FUNCTION IF EXISTS ValidateUser $$

CREATE FUNCTION ValidateUser(user_name varchar(15),user_pass varchar(15)) 
RETURNS int
begin
	if exists(select userID from Users where userName = user_name and userPassword = user_pass and activity = 1) then
		return 1;
	else
		return 0;
	end if;
end $$

DELIMITER ;


DELIMITER $$

DROP PROCEDURE IF EXISTS CategoryList $$

CREATE PROCEDURE CategoryList()
begin
	select categoryID, categoryName from Categories order by categoryName;
end $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS DeleteCategory $$

CREATE PROCEDURE DeleteCategory(category_id int)
begin
	if not exists(select categoryID from Images where categoryID = category_id) then
		delete from categories where categoryID = category_id;
	end if;
end $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS DeleteUser $$

CREATE PROCEDURE DeleteUser(user_id int)
begin
	update Users set activity = 0 where userId = user_id;
end $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS GetUser $$

CREATE PROCEDURE GetUser(user_Name int)
begin
	select userID,firstName,lastName,userEmail,userName,accessLevel
    from Users
    where userName = userName and activity = 1;
end $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS NewCategory $$

CREATE PROCEDURE NewCategory(category_name varchar(45))
begin
	insert into Categories(categoryName)values(category_name); 
end ;;


DELIMITER ;

DELIMITER $$

DROP PROCEDURE NewUser $$

CREATE PROCEDURE NewUser(
	first_name varchar(55),
	last_name varchar(55),
    user_email varchar(125),
    user_name varchar(55),
    user_password varchar(255)
)
begin
	insert into Users(firstName,lastName,userEmail,userName,userPassword)
	values(first_name,last_name,user_email,user_name,user_password);
end $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS ResetUser $$

CREATE PROCEDURE ResetUser(userID int)
begin
	update Users set activity = 1 where userId = user_id;
end $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE UpdateCagegory

CREATE PROCEDURE UpdateCategory(category_name varchar(45), category_id int)
begin
	update Categories set categoryName = category_name 
	where categoryID = category_id;
end ;;

DELIMITER ;

DELIMITER $$

DROP PROCEDURE UpdateUser $$

CREATE PROCEDURE UpdateUser(
	user_id int,
	first_name varchar(55),
	last_name varchar(55),
    user_email varchar(125),
    user_name varchar(15),
    user_password varchar(15)
)
begin
	update Users 
    set firstName = first_name,lastName = last_name,userEmail = user_email,userName = user_name,userPassword = user_password
	where userId = user_id and activity = 1;
end $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE UserList $$

CREATE PROCEDURE UserList()
begin
	select userID,firstName,lastName,userName
    from Users where activity = 1;
end $$

DELIMITER ;

DELIMITER $$



DELIMITER ; 