<?php
  class ProfileController {
    function __construct() {

    }
    
    function getView($data, $message, $user, $navbar) {
      $profile = isset($data['profile']) ? $data['profile'] : [];
      $editable = ($user != null && $profile->username == $user->username);
      ob_start();
      require 'profile.view.php';
      return ob_get_clean();
    }
  }
?>
