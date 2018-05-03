<?php
  require_once 'model.php';

  class App {
    private $model;
    private $route;
    private $data;
    private $message;
    private $redirect;

    function __construct() {
      $this->model = new Model();
      $this->route = isset($_GET['route']) ? $_GET['route'] : 'home';
      $this->action = isset($_POST['action']) ? $_POST['action'] : '';
    }

    function run() {
      if ($this->model->error != '') {
        $this->route = 'error';
        return;
      }

      $this->data = array();
      $this->message = '';

      switch($this->action) {
        case 'login':
          $this->handleLogin();
          break;
        case 'register':
          $this->handleRegister();
          break;
        case 'logout':
          $this->handleLogout();
          break;
        case 'update-profile':
          $this->handleUpdateProfile();
          break;
        case 'add-book':
          $this->handleAddBook();
          break;
        case 'update-book':
          $this->handleUpdateBook();
          break;
        case 'remove-book':
          $this->handleRemoveBook();
          break;
      }

      $controller = null;
      switch($this->route) {
        case 'error':
          require 'modules/error-module/error.controller.php';
          $controller = new ErrorController();
          break;
        case 'book-search':
          require 'modules/book-search-module/book-search.controller.php';
          $this->handleBookSearch();
          $controller = new BookSearchController();
          break;
        case 'book-details':
          require 'modules/book-details-module/book-details.controller.php';
          $this->handleGetBook();
          $controller = new BookDetailsController();
          break;
        case 'book-list':
          $success = $this->handleGetBookList();
          if ($success) {
            require 'modules/book-list-module/book-list.controller.php';
            $controller = new BookListController();
          } else {
            require 'modules/error-module/error.controller.php';
            $controller = new ErrorController();
          }
          break;
        case 'profile':
          $success = $this->handleGetProfile();
          if ($success) {
            require 'modules/profile-module/profile.controller.php';
            $controller = new ProfileController();
          } else {
            require 'modules/error-module/error.controller.php';
            $controller = new ErrorController();
          }
          break;
        case 'edit-profile':
          require 'modules/edit-profile-module/edit-profile.controller.php';
          $controller = new EditProfileController();
          break;
        case 'user-search':
          require 'modules/user-search-module/user-search.controller.php';
          $this->handleUserSearch();
          $controller = new UserSearchController();
          break;
        case 'login':
          if ($this->verifyAuth()) {
            header("Location: /home");
            die();
          } else {
            require 'modules/login-module/login.controller.php';
            $controller = new LoginController($this->redirect);            
          }
          break;
        case 'register':
          if ($this->verifyAuth()) {
            header("Location: /home");
            die();
          } else {
            require 'modules/register-module/register.controller.php';
            $controller = new RegisterController();         
          }
          break;
        default:
          require 'modules/home-module/home.controller.php';
          $controller = new HomeController();
          break;
      }

      if ($controller != null) {
        require 'components/navbar/navbar.controller.php';
        $navbar = new NavBarController();
        $user = $this->model->getUser();        
        print $controller->getView($this->data, $this->message, $user, $navbar->getView($user, $this->route));
      }
    }

    private function verifyAuth() {
      if (!$this->model->getUser()) {
        $this->route = 'login';
        return false;
      } else {
        return true;
      }
    }

    private function handleLogin() {
      $username = isset($_POST['username']) ? $_POST['username'] : null;
      $password = isset($_POST['password']) ? $_POST['password'] : null;

      $this->redirect = isset($_POST['redirect']) ? $_POST['redirect'] : 'home';
      if ($username == null && $password == null) {
        $this->route = 'login';
        return;
      }

      list($success, $error) = $this->model->login($username, $password);

      if ($success) {
        header("Location: /" . $this->redirect);
        die();
      } else {
        $this->message = $error;
        $this->route = 'login';
        $this->data = array("username" => $username);
      }
    }

    private function handleRegister() {
      $username = isset($_POST['username']) ? $_POST['username'] : null;
      $email = isset($_POST['email']) ? $_POST['email'] : null;
      $password = isset($_POST['password']) ? $_POST['password'] : null;
      $confirmed = isset($_POST['confirmed']) ? $_POST['confirmed'] : null;

      $this->redirect = isset($_POST['redirect']) ? $_POST['redirect'] : 'home';

      if ($username == null || $email == null || $password == null || $confirmed == null) {
        $this->message = 'One or more fields not provided';
        $this->route = 'register';
        $this->data = $_POST;
        return;
      }

      if (strcmp($password, $confirmed) == 0) {
        list($success, $error) = $this->model->registerUser($username, password_hash($password, PASSWORD_DEFAULT), $email);
        if ($success) {
          header("Location: /login");
          die();
        } else {
          $this->message = $error;
          $this->route = 'register';
          $this->data = $_POST;
        }
      } else {
        $this->message = 'Passwords do not match.';
        $this->route = 'register';
        $this->data = $_POST;
      }
    }

    private function handleLogout() {
      $this->model->logout();
      $redirect = isset($_POST['redirect']) ? $_POST['redirect'] : 'home';
      header("Location: /" . $redirect);
      die();
    }

    private function handleUserSearch() {
      $search = isset($_GET['search']) ? $_GET['search'] : null;

      if ($search == null) {
        $this->data = array("users" => array(), "search" => '');
        return;
      }

      list($users, $search, $error) = $this->model->searchUsers($search);

      if ($users != null) {
        $this->data = array("users" => $users, "search" => $search);
      } else {
        $this->message = $error;
        $this->data = array("search" => $search);
      }
    }

    private function handleGetProfile() {
      $username = isset($_GET['user']) ? $_GET['user'] : null;
      
      if ($username == null) {
        $this->message = 'No user specified';
        return false;
      }

      list($profile, $error) = $this->model->getProfile($username);

      if ($profile != null) {
        $this->data = array("profile" => $profile);
        return true;
      } else {
        $this->message = $error;
        return false;
      }
    }

    private function handleUpdateProfile() {
      if ($this->verifyAuth()) {
        $password = isset($_POST['password']) ? $_POST['password'] : null;
        $confirmed = isset($_POST['confirmed']) ? $_POST['confirmed'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $bio = isset($_POST['bio']) ? $_POST['bio'] : null;

        if (strcmp($confirmed, $password) == 0) {
          list($success, $username, $error) = $this->model->updateProfile($password, $email, $bio);
          if ($success) {
            header("Location: /profile?user=" . $username);
            die();
          } else {
            $this->message = $error;
            $this->route = 'edit-profile';
          }
        } else {
          print "password don't match";
          $this->message = 'Passwords do not match.';
          $this->route = 'edit-profile';
          $this->data = $_POST;
        }
      }
    }

    private function handleGetBookList() {
      $username = isset($_GET['user']) ? $_GET['user'] : null;

      if ($username == null) {
        $this->message = 'No user specified';
        return false;
      }

      list($list, $error) = $this->model->getBookList($username);
      
      if ($list != null) {
        $this->data = array("list" => $list);
        return true;
      } else {
        $this->message = $error;
        return false;
      }
    }

    private function handleAddBook() {
      if ($this->verifyAuth()) {
        $isbn = isset($_GET['isbn']) ? $_GET['isbn'] : null;
        $status = isset($_GET['status']) ? $_GET['status'] : null;

        list($success, $error) = $this->model->addBookToList($isbn, $status);

        if ($success) {
          $this->route = 'book-details';
        } else {
          $this->route = 'book-details';
          $this->message = $error;
        }
      }
    }

    private function handleUpdateBook() {
      if ($this->verifyAuth()) {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $status = isset($_GET['status']) ? $_GET['status'] : null;
        $rating = isset($_GET['rating']) ? $_GET['rating'] : null;

        list($success, $error) = $this->model->updateBookInList($id, $status, $rating);

        if ($success) {
          $this->route = 'book-details';
        } else {
          $this->route = 'book-details';
          $this->message = $error;
        }
      }
    }

    private function handleRemoveBook() {
      if ($this->verifyAuth()) {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        list($success, $error) = $this->model->removeBookFromList($id);

        if ($success) {
          $this->route = 'book-details';
        } else {
          $this->route = 'book-details';
          $this->message = $error;
        }
      }
    }

    private function handleBookSearch() {
      $search = isset($_GET['search']) ? $_GET['search'] : null;

      if ($search == null) {
        $this->data = array("books" => array(), "search" => '');
        return;
      }

      list($books, $search, $error) = $this->model->searchBooks($search);

      if ($books != null) {
        $this->data = array("books" => $books, "search" => $search);
      } else {
        $this->message = $error;
        $this->data = array("search" => $search);
      }
    }

    private function handleGetBook() {
      $isbn = isset($_GET['isbn']) ? $_GET['isbn'] : null;

      if ($isbn == null) {
        return;
      }

      list($details, $error) = $this->model->getBook($isbn);

      if ($details != null) {
        $this->data = array("details" => $details);
      } else {
        $this->message = $error;
        $this->data = array("details" => $details);
      }
    }
  }
?>
