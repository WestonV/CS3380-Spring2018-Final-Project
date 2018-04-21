<?php
  class RegisterController {
    function __construct() {

    }
    
    function getView() {
      ob_start();
      require 'register.view.php';
      return ob_get_clean();
    }
  }
?>
