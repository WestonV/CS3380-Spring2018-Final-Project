/* Use below to create the tables in the database */

CREATE TABLE UserAuthentication (
  id INT NOT NULL auto_increment PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE UserDetails (
  userID INT NOT NULL FOREIGN KEY,
  displayName VARCHAR(50) NOT NULL,
  email VARCHAR(255) NOT NULL,
  joinDate Date NOT NULL,
  bio LONGTEXT
);

CREATE TABLE BookList (
  userID INT NOT NULL FOREIGN KEY,
  isbn: VARCHAR(13) NOT NULL,
  status ENUM('Finished', 'InProgress', 'PlanToRead', 'Dropped') NOT NULL,
  rating INT
);

/* Use below to avoid registering an account */

INSERT INTO UserAuthentication (username, password) VALUES ('admin', '!@#demo$%^');
INSERT INTO UserDetails (userID, displayName, email, joinDate) VALUES (0, 'Admin', 'admin@mybooklist.io', Date.NOW());
