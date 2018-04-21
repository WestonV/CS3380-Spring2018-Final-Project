<?php
  class HomeController {
    function __construct() {

    }
    
    function getView() {
      ob_start();
      require 'home.view.php';
      return ob_get_clean();
    }
  }
?>
