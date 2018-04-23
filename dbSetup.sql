/* Use below to create the tables in the database */

CREATE TABLE UserAuth (
  id INT NOT NULL auto_increment PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE UserDetails (
  userID INT NOT NULL,
  email VARCHAR(255) NOT NULL,
  joinDate Date NOT NULL,
  bio LONGTEXT,
  FOREIGN KEY (userID) REFERENCES UserAuth(id)
);

CREATE TABLE BookList (
  id INT NOT NULL auto_increment PRIMARY KEY, 
  userID INT NOT NULL,
  isbn VARCHAR(13) NOT NULL UNIQUE,
  status ENUM('Finished', 'InProgress', 'PlanToRead', 'Dropped') NOT NULL,
  rating INT,
  FOREIGN KEY (userID) REFERENCES UserAuth(id)
);

/* Use below to create test data */

/* password unhashed is !@#demo$%^ */
BEGIN; INSERT INTO UserAuth (username, password) VALUES ('admin', '$2y$10$26Np8pLC8oaVTtyNYb318eujpt/JTsVjVqMtbhg8wplf6ULOc7A/i'); INSERT INTO UserDetails (userID, email, joinDate) VALUES (LAST_INSERT_ID(), 'admin@mybooklist.io', NOW()); COMMIT;

INSERT INTO BookList (userID, isbn, status) VALUES (1, '076532637X', 'PlanToRead');
INSERT INTO BookList (userID, isbn, status) VALUES (1, '0812577566', 'InProgress');
INSERT INTO BookList (userID, isbn, status) VALUES (1, '0812511816', 'Finished');
