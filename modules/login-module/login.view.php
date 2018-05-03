<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="./app.css">
    <link rel="stylesheet" href="./modules/login-module/login.css">
  </head>
  <body>
    <?php print $navbar?>
    <div class="container">
      <div class="row">
        <form class="form-group login-form col-xs-12 col-md-6 offset-md-3" action="login" method="POST">
          <h1>Login Form</h1>
          <span><a href="/register">Don't have an account? Click here to register.</a></span>
          <input class="form-control login-input" type="text" name="username" placeholder="Username" value="<?php echo $username ?>">
          <input class="form-control login-input" type="password" name="password" placeholder="Password" value="<?php echo $password ?>">
          <input type="hidden" name="action" value="login">
          <input type="hidden" name="redirect" value="<?php echo $this->redirect ?>">
          <div class="text-center">
            <input class="btn btn-md btn-success login-button" type="submit" value="Submit">
          </div>
          <p class="error text-center"><?php echo $message ?></p>
        </form>
      </div>
    </div>
  </body>
</html>
