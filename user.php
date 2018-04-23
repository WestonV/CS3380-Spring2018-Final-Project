<?php
  class User {
    public $id = 0;
    public $username = '';
    public $hashedPass = '';
    public $email = '';
    public $joinDate = 0;
    public $bio = '';

    public function init($username, $mysqli) {
      if (!$mysqli) {
        return false;
      }
      
      $sql = "SELECT * FROM UserAuth INNER JOIN UserDetails ON UserAuth.id = UserDetails.userID WHERE username = ?;";

      $stmt = $mysqli->prepare($sql);

      if (!($stmt->bind_param("s", $username))) {
				$this->error = "Prepare failed: " . $mysqli->error;
				return false;
			}
			
			if (!$stmt->execute()) {
				$this->error = "Execute of statement failed: " . $stmt->error;
				return false;
      }
      
			if (!($result = $stmt->get_result())) {
				$this->error = "Getting result failed: " . $stmt->error;
				return false;
			}
			
			if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        $this->id = $user['id'];
        $this->username = $user['username'];
        $this->hashedPass = $user['password'];

        $this->email = $user['email'];
        $this->joinDate = $user['joinDate'];
        $this->bio = $user['bio'];
      }
      
      $stmt->close();
      return true;
    }

    public function getDetails($username, $mysqli) {
      if (!$mysqli) {
        return false;
      }
      
      $stmt = $mysqli->prepare("SELECT * FROM UserDetails where userID = (SELECT id from UserAuth where username = ?);");

      if (!($stmt->bind_param("s", $username)) ) {
				$this->error = "Prepare failed: " . $mysqli->error;
				return false;
			}
			
			if (!$stmt->execute() ) {
				$this->error = "Execute of statement failed: " . $stmt->error;
				return false;
      }
      
			if (!($result = $stmt->get_result()) ) {
				$this->error = "Getting result failed: " . $stmt->error;
				return false;
			}
			
			if ($result->num_rows > 0) {
        $profile = $result->fetch_assoc();

        $this->username = $username;
        $this->email = $profile['email'];
        $this->joinDate = $profile['joinDate'];
        $this->bio = $profile['bio'];
      }
      
      $stmt->close();
      return true;
    }
  }
?>
