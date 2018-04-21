<?php
  class ErrorController {
    private $message;

    function __construct($message) {
      $this->message = $message
    }

    function getView() {
      ob_start();
      require 'error.view.php';
      return ob_get_clean();
    }
  }
?>
