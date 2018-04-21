<?php
  class BookSearchController {
    function __construct() {

    }
    
    function getView() {
      ob_start();
      require 'book-search.view.php';
      return ob_get_clean();
    }
  }
?>
