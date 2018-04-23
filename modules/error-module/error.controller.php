<?php
  class ErrorController {
    function __construct() {

    }

    function getView($data, $message, $user, $navbar) {
      ob_start();
      require 'error.view.php';
      return ob_get_clean();
    }
  }
?>
