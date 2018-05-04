<?php
  class BookListController {
    function __construct() {

    }
    
    function getView($data, $message, $user, $navbar) {
      $list = isset($data['list']) ? $data['list'] : [];
      $username = isset($_GET['user']) ? $_GET['user'] : '';
      $authenticated = ($user != null && $username == $user->username);
      ob_start();
      require 'book-list.view.php';
      return ob_get_clean();
    }
  }
?>
