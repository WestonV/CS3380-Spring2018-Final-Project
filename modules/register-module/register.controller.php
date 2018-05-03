<?php
  class RegisterController {
    function __construct() {

    }
    
    function getView($data, $message, $user, $navbar) {
      $username = isset($data['username']) ? $data['username'] : '';
      $password = isset($data['password']) ? $data['password'] : '';
      $confirmed = isset($data['confirmed']) ? $data['confirmed'] : '';
      $email = isset($data['email']) ? $data['email'] : '';

      ob_start();
      require 'register.view.php';
      return ob_get_clean();
    }
  }
?>
