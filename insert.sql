insert into categories (categoryName)
values ('Screwdrivers'),
('Drills'),
('Supplies'),
('Hammers'),
('Power Tools');

insert into item (itemName, itemDescription, itemImgPath, itemPrice, category_ID)
values('Screwdriver 1','Turns the screws','images/1.jpg',500,1),
('Screwdriver 2', 'Turns the screws, more efficiently','images/2.jpg',550,1),
('Drill 1','Turns the screws for you','images/3.jpg',1000,2),
('Drill 2','Turns the screws for you and makes you coffee','images/4.png',1500,2)