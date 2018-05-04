<?php
  class BookDetailsController {
    function __construct() {

    }
    
    function getView($data, $message, $user, $navbar) {
      ob_start();
      $book = isset($data['details']['book']) ? $data['details']['book'] : [];
      require 'book-details.view.php';
      return ob_get_clean();
    }
  }
?>
