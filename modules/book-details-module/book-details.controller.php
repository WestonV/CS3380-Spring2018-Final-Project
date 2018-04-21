<?php
  class BookDetailsController {
    function __construct() {

    }
    
    function getView() {
      ob_start();
      require 'book-details.view.php';
      return ob_get_clean();
    }
  }
?>
