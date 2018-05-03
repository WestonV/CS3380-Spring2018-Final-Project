<?php
  class BookListController {
    function __construct() {

    }
    
    function getView($data, $message, $user, $navbar) {
      ob_start();
      require 'book-list.view.php';
      return ob_get_clean();
    }
  }
?>
