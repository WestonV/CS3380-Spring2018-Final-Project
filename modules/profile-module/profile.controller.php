<?php
  class ProfileController {
    function __construct() {

    }
    
    function getView() {
      ob_start();
      require './profile.view.php';
      return ob_get_clean();
    }
  }
?>
