<?php
  class HomeController {
    function __construct() {

    }
    
    function getView($data, $message, $user, $navbar) {
      ob_start();
      require 'home.view.php';
      return ob_get_clean();
    }
  }
?>
