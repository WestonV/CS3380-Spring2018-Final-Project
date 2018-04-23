<?php
  class LoginController {
    private $redirect;

    function __construct($redirect) {
      $this->redirect = $redirect;
    }
    
    function getView($data, $message, $user, $navbar) {
      $username = isset($data['username']) ? $data['username'] : '';
      $password = isset($data['password']) ? $data['password'] : '';

      ob_start();
      require 'login.view.php';
      return ob_get_clean();
    }
  }
?>
