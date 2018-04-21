<?php
  require_once 'model.php';

  class App {
    private $model;
    private $user;

    function __construct() {
      $model = new Model();
      if ($model->error != '') {
        // load error controller
      }

      // need to attempt loading user authentication
    }

    function run() {
      // deal with routing, url params, and controller loading here

      // may need to pass model/user to certain pages in their constructor
      $controller = null;
      $route = isset($_GET['route']) ? $_GET['route'] : 'home';
      switch($route) {
        case 'error':
          require_once 'modules/error-module/error.controller.php';
          $controller = new ErrorController();
          break;
        case 'book-search':
          require_once 'modules/book-search-module/book-search.controller.php';
          $controller = new BookSearchController();
          break;
        case 'book-details':
          require_once 'modules/book-details-module/book-details.controller.php';
          $controller = new BookDetailsController();
          break;
        case 'book-list':
          require_once 'modules/book-list-module/book-list.controller.php';
          $controller = new BookListController();
          break;
        case 'profile':
          require_once 'modules/profile-module/profile.controller.php';
          $controller = new ProfileController();
          break;
        case 'edit-profile':
          require_once 'modules/edit-profile-module/edit-profile.controller.php';
          $controller = new EditProfileController();
          break;
        case 'user-search':
          require_once 'modules/user-search-module/user-search.controller.php';
          $controller = new UserSearchController();
          break;
        case 'login':
          require_once 'modules/login-module/login.controller.php';
          $controller = new LoginController();
          break;
        case 'register':
          require_once 'modules/register-module/register.controller.php';
          $controller = new RegisterController();
          break;
        default:
          require_once 'modules/home-module/home.controller.php';
          $controller = new HomeController();
          break;
      }
      if ($controller != null) {
        print $controller->getView();
      }
    }
  }
?>
