<?php
  class ProfileController {
    function __construct() {

    }
    
    function getView($data, $message, $user, $navbar) {
      ob_start();
      require 'profile.view.php';
      return ob_get_clean();
    }
  }
?>
