<?php
  class UserSearchController {
    function __construct() {

    }

    function getView($data, $message, $user, $navbar) {
      ob_start();
      require 'user-search.view.php';
      return ob_get_clean();
    }
  }
?>
