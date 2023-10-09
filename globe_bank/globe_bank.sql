CREATE TABLE subjects (
    id INT(11) NOT NULL AUTO_INCREMENT,
    menu_name VARCHAR(255),
    position INT(3),
    visible TINYINT(1),
    PRIMARY KEY (id)
);

INSERT INTO subjects (menu_name, position, visible) VALUES
("About Globe Bank","1","1"),
("Consumer","2","1"),
("Small Business","3","1"),
("Commercial","4","1");

CREATE TABLE pages (
    id INT(11) NOT NULL AUTO_INCREMENT,
    subject_id INT(11),
    menu_name VARCHAR(255),
    position INT(3),
    visible TINYINT(1),
    content TEXT,
    PRIMARY KEY (id)
);

CREATE INDEX fk_subject_id ON pages (subject_id);

INSERT INTO pages (subject_id, menu_name, position, visible, content) VALUES
("1","Globe Bank","1","1",""),
("1","History","2","1",""),
("1","Leadership","3","1",""),
("1","Contact Us","4","1","");

INSERT INTO pages (subject_id, menu_name, position, visible, content) VALUES
("2","Banking","1","1",""),
("2","Credit cards","2","1",""),
("2","Mortages","3","1","");

INSERT INTO pages (subject_id, menu_name, position, visible, content) VALUES
("3","Checkings","1","1",""),
("3","Loans","2","1",""),
("3","Merchant","3","1","");


-- PART 2 

CREATE TABLE admins (
    id INT(11) NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    email VARCHAR(255),
    username VARCHAR(255),
    hashed_password  VARCHAR(255),
    PRIMARY KEY (id)
);

ALTER TABLE admins ADD INDEX index_username (username);

INSERT INTO admins (first_name, last_name, email, username, hashed_password) VALUES
("Temp","Temp","temp","temp","1");
