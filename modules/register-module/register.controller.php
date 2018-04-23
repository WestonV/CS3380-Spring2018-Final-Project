<?php
  class RegisterController {
    function __construct() {

    }
    
    function getView($data, $message, $user, $navbar) {
      ob_start();
      require 'register.view.php';
      return ob_get_clean();
    }
  }
?>
