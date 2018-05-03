<?php
  class BookSearchController {
    function __construct() {

    }
    
    function getView($data, $message, $user, $navbar) {
      $books = isset($data['books']) ? $data['books'] : [];
      ob_start();
      require 'book-search.view.php';
      return ob_get_clean();
    }
  }
?>
