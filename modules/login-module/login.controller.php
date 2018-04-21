<?php
  class LoginController {
    function __construct() {

    }
    
    function getView() {
      ob_start();
      require 'login.view.php';
      return ob_get_clean();
    }
  }
?>
