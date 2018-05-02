# CS3380 Spring2018 Final Project
Created by Zach Kipping (zkp64), Tristan Day (tmdhmd), and Weston Verhulst (wav369)

## Application Description
  The application is called MyBookList. It is a website made using php. The application is designed to house a list of books for each user, where the user can have a status of 'Finished', 'InProgress', 'PlanToRead', or 'Dropped' for each book in their list. The user can also give each book a rating out of 5.

  Along with having a book list for each user on the website, plus allowing public viewing of these lists, the website has other general functionality. A part of this functionality is allowing for users to search a database of books to find a certain book to add to their list. Users can also search for different users and view their profile/book list. Finally the application allows for users to edit any of their profile information and edit any books (status, rating, deletion) in their list.

## Database Schema
```sql
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
```

![Database ERD Image](/ERD.png?raw=true "Database ERD Image")

## Book Database API
  We are also making use of a database API along with having our own database. We use it for searching books by title and getting the info for a singular book based on it's isbn.

  The api is at [isbndb.com](https://isbndb.com/ "ISBN Database") and the docs are [here](https://isbndb.com/apidocs "ISBN Database Docs")

## Video Walkthrough
  <a href="http://www.youtube.com/watch?feature=player_embedded&v=VpDVtJyyrN4
  " target="_blank"><img src="http://img.youtube.com/vi/VpDVtJyyrN4/0.jpg" 
  alt="Application Demonstration Video" width="240" height="180" border="5" /></a>
