<?php
  class EditProfileController {
    function __construct() {

    }
    
    function getView() {
      ob_start();
      require 'edit-profile.view.php';
      return ob_get_clean();
    }
  }
?>
