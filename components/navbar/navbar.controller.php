<?php
  class NavBarController {
    function __construct() {

    }
    
    function getView() {
      ob_start();
      require 'navbar.view.php';
      return ob_get_clean();
    }
  }
?>
