<?php
  require 'user.php';

  class Model {
    public $error = '';
    private $mysqli;
    private $user;

    function __construct() {
      session_start();

      require 'config.php';
			$this->mysqli = new mysqli($HOST, $USER, $PASS, $NAME);
			if ($this->mysqli->connect_error) {
				$this->error = $mysqli->connect_error;
      }
      
      $this->retrieveUser();
    }

    function __destruct() {
      if ($this->mysqli) {
				$this->mysqli->close();
			}
    }

    // **  Database Functionality **

    public function getUser() {
      return $this->user;
    }

    private function retrieveUser() {
      $username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
      if ($username != null) {
        $this->user = new User();
        if (!$this->user->init($username, $this->mysqli)) {
          $this->user = null;
        }
      }
    }

    public function login($username, $password) {
      $user = new User();
			if ($user->init($username, $this->mysqli) && password_verify($password, $user->hashedPass)) {
				$this->user = $user;
				$_SESSION['username'] = $username;
				return array(true, "");
			} else {
				$this->user = null;
				$_SESSION['username'] = '';
				return array(false, "Username/Password is incorrect. Please try again.");
			}
    }

    public function registerUser($username, $password, $email) {
      $sqlAuth = "INSERT INTO UserAuth (username, password) VALUES (?, ?);";
      $sqlDetails = "INSERT INTO UserDetails (userID, email, joinDate) VALUES (LAST_INSERT_ID(), ?, NOW());";

      $worked = true;
      $error = "";

      $this->mysqli->autocommit(FALSE); 
      // query for Auth creation
      if (!($stmtAuth = $this->mysqli->prepare($sqlAuth))) {
        $worked = false;
        $error = "Prepare failed: (" . $this->mysqli->errno . ") " . $this->mysqli->error;
      }

      if (!($stmtAuth->bind_param("ss", $username, $password))) {
        $worked = false;
        $error = "Binding query failed.";
			}
			
			if (!$stmtAuth->execute()) {
        $worked = false;
        $error = "Execute of statement failed: " . $stmtAuth->error;
      }

      // query for Details creation
      if (!($stmtDetails = $this->mysqli->prepare($sqlDetails))) {
        $worked = false;
        $error = "Prepare failed: (" . $this->mysqli->errno . ") " . $this->mysqli->error;
      }

      if (!($stmtDetails->bind_param("s", $email))) {
        $worked = false;
        $error = "Binding query failed.";
			}
			
			if (!$stmtDetails->execute()) {
        $worked = false;
        $error = "Execute of statement failed: " . $stmtDetails->error;
      }

      $stmtAuth->close();
      $stmtDetails->close();

      if ($worked) {
        $this->mysqli->commit();
        return array(true, "");
      } else {
        $this->mysqli->rollback();
        return array(false, "Username already exists");
      }
    }

    public function logout() {
      $this->user = null;
			$_SESSION['username'] = '';
    }

    public function searchUsers($search) {
      $edited_search = $search . "%";

      $users = array();

      $sql = "SELECT username, joinDate, bio from UserDetails INNER JOIN UserAuth ON UserDetails.userID = UserAuth.id where username LIKE ?;";

      $stmt = $this->mysqli->prepare($sql);

      if (!($stmt->bind_param("s", $edited_search))) {
        return array(null, $search, "Binding query failed.");
			}
			
			if (!$stmt->execute()) {
        return array(null, $search, "Execute of statement failed: " . $stmt->error);
      }
      
			if (!($result = $stmt->get_result())) {
        return array(null, $search, "Getting result failed: " . $stmt->error);
      }

      if ($result->num_rows > 0) {
				while($user = $result->fetch_assoc()) {
					array_push($users, $user);
				}
      }

      $stmt->close();
      return array($users, $search, '');
    }

    public function getProfile($username) {
      if ($this->user && $username == $this->user->username) {
        return array($this->user, '');
      } else {
        $profile = new User();
        if ($profile->getDetails($username, $this->mysqli)) {
          return array($profile, '');
        } else {
          return array(null, 'No user with that name exists');
        }
      }
    }

    public function updateProfile($password, $email, $bio) {
      $password = isset($password) ? password_hash($password, PASSWORD_DEFAULT) : $this->user->hashedPass;
      $email = isset($email) ? $email : $this->user->email;
      $bio = isset($bio) ? $bio : $this->user->bio;

      $sqlAuth = "UPDATE UserAuth SET password = ? WHERE id = ?;";
      $sqlDetails = "UPDATE UserDetails SET email = ?, bio = ? WHERE userID = ?;"

      $this->mysqli->autocommit(FALSE); 

      // query for Auth creation
      if (!($stmtAuth = $this->mysqli->prepare($sqlAuth))) {
        $worked = false;
        $error = "Prepare failed: (" . $this->mysqli->errno . ") " . $this->mysqli->error;
      }

      if (!($stmtAuth->bind_param("si", $password, $id))) {
        $worked = false;
        $error = "Binding query failed.";
			}
			
			if (!$stmtAuth->execute()) {
        $worked = false;
        $error = "Execute of statement failed: " . $stmtAuth->error;
      }

      // query for Details creation
      if (!($stmtDetails = $this->mysqli->prepare($sqlDetails))) {
        $worked = false;
        $error = "Prepare failed: (" . $this->mysqli->errno . ") " . $this->mysqli->error;
      }

      if (!($stmtDetails->bind_param("ssi", $email, $bio, $id))) {
        $worked = false;
        $error = "Binding query failed.";
			}
			
			if (!$stmtDetails->execute()) {
        $worked = false;
        $error = "Execute of statement failed: " . $stmtDetails->error;
      }

      $stmtAuth->close();
      $stmtDetails->close();

      if ($worked) {
        $this->mysqli->commit();
        $this->user->password = $password;
        $this->user->email = $email;
        $this->user->bio = $bio;
        return array(true, $this->user->username, '');
      } else {
        $this->mysqli->rollback();
        return array(false, '', "Getting result failed: " . $error);
      }
    }

    public function getBookList($username) {
      $list = array();

      $sql = "SELECT id, isbn, status, rating from BookList where userID = (SELECT id from UserAuth where username = ?);";

      $stmt = $this->mysqli->prepare($sql);

      if (!($stmt->bind_param("s", $username))) {
        return array(null, "Binding query failed.");
			}
			
			if (!$stmt->execute()) {
        return array(null, "Execute of statement failed: " . $stmt->error);
      }
      
			if (!($result = $stmt->get_result())) {
        return array(null, "Getting result failed: " . $stmt->error);
      }

      $stmt->close();

      if ($result->num_rows > 0) {
				while($book = $result->fetch_assoc()) {
					array_push($list, $book);
        }
        return array($list, '');
			} else {
        return array(null, 'There is no user with that name');
      }
    }

    public function addBookToList($isbn, $status) {
      $sql = "INSERT INTO BookList (userID, isbn, status) VALUES (?, ?, ?);";

      $stmt = $this->mysqli->prepare($sql);

      if (!($stmt->bind_param("iss", $this->user->id, $isbn, $status))) {
        return array(false, "Binding query failed.");
			}
			
			if (!$stmt->execute()) {
        return array(false, "Execute of statement failed: " . $stmt->error);
      }
      
			if (!($result = $stmt->get_result())) {
        return array(false, "Getting result failed: " . $stmt->error);
      }

      $stmt->close();

      return array(true, '');
    }

    public function updateBookInList($id, $status, $rating) {
      $sql = "UPDATE BookList set status = ?, rating = ? where id = ?;";

      $stmt = $this->mysqli->prepare($sql);

      if (!($stmt->bind_param("sii", $status, $rating, $id))) {
        return array(false, "Binding query failed.");
			}
			
			if (!$stmt->execute()) {
        return array(false, "Execute of statement failed: " . $stmt->error);
      }
      
			if (!($result = $stmt->get_result())) {
        return array(false, "Getting result failed: " . $stmt->error);
      }

      $stmt->close();

      return array(true, '');
    }

    public function removeBookFromList($id) {
      $sql = "DELETE FROM BookList where id = ?;";

      $stmt = $this->mysqli->prepare($sql);

      if (!($stmt->bind_param("i", $id))) {
        return array(false, "Binding query failed.");
			}
			
			if (!$stmt->execute()) {
        return array(false, "Execute of statement failed: " . $stmt->error);
      }
      
			if (!($result = $stmt->get_result())) {
        return array(false, "Getting result failed: " . $stmt->error);
      }

      $stmt->close();

      return array(true, '');
    }

    // ** API Functionality **
    
    public function searchBooks($search){
      require 'config.php';
      $url = "https://api.isbndb.com/books/" . $search;  
      
      $headers = array(  
        "Content-Type: application/json",  
        "X-API-Key: " . $API_KEY
      );
      
      $rest = curl_init();  
      curl_setopt($rest,CURLOPT_URL,$url);  
      curl_setopt($rest,CURLOPT_HTTPHEADER,$headers);  
      curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
      
      $response = curl_exec($rest);

      if($errno = curl_errno($rest)) {
        $error_message = curl_strerror($errno);
        return array(null, $search, $error_message);
      }

      return array(json_decode($response, true), $search, '') ;
      curl_close($rest); 
    }

    public function getBook($isbn) {
      require 'config.php';
      $url = "https://api.isbndb.com/book/" . $isbn;  
      
      $headers = array(  
        "Content-Type: application/json",  
        "X-API-Key: " . $API_KEY
      );
      
      $rest = curl_init();  
      curl_setopt($rest,CURLOPT_URL,$url);  
      curl_setopt($rest,CURLOPT_HTTPHEADER,$headers);  
      curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
      
      $response = curl_exec($rest);

      if($errno = curl_errno($rest)) {
        $error_message = curl_strerror($errno);
        return array(null, $error_message);
      }

      return array(json_decode($response, true), '') ;
      curl_close($rest); 
    }
  }
?>
