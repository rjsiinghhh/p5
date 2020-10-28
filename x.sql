
 CREATE TABLE management (id SERIAL, entry_date DATE,  address TEXT, type TEXT, image TEXT, elect INT, diesel INT, water INT, equip INT, main INT, repairs INT, chem INT, fert INT, mort INT,insur INT, labor_contr INT, labor_in INT, misc INT, harvest INT);


 INSERT INTO management (entry_date, address, type, image, elect, diesel, water, equip, main, repairs, chem, fert, mort, insur, labor_contr, labor_in, misc, harvest) VALUES (TO_DATE('2020-12-25', 'YYYY-MM-DD'), 'sdfsdfs', 'pista', 'sdgfsdfsdgdg', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14);



 INSERT INTO management (entry_date,address, type, image, elect, diesel, water, equip, main, repairs, chem, fert, mort, insur, labor_contr, labor_in, misc, harvest) VALUES (TO_DATE('2020-11-25', 'YYYY-MM-DD'), 'Graffis Road', 'Walnut Orchard', 'https://i.imgur.com/VEZeP7d.png', 12312, 123123, 45645, 924, 28915, 3452356, 3457, 345348, 34539, 345310, 345311, 34512, 45313, 345314);


INSERT INTO management (entry_date,address, type, image, elect, diesel, water, equip, main, repairs, chem, fert, mort, insur, labor_contr, labor_in, misc, harvest) VALUES (TO_DATE('2020-10-25', 'YYYY-MM-DD'), 'Road 13', 'Pistachio Orchard', 'https://i.imgur.com/VEZeP7d.png', 12312, 123123, 45645, 924, 28915, 3452356, 3457, 345348, 34539, 345310, 345311, 34512, 45313, 345314);
