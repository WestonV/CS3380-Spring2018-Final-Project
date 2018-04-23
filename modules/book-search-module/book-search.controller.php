<?php
  class BookSearchController {
    function __construct() {

    }
    
    function getView($data, $message, $user, $navbar) {
      ob_start();
      require 'book-search.view.php';
      return ob_get_clean();
    }
  }
?>
