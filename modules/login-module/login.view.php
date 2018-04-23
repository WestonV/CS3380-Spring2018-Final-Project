<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login</title>
  </head>
  <body>
  <?php var_dump($this->redirect) ?>
    <form action="login" method="POST">
      <input type="text" name="username" placeholder="username" value="<?php echo $username ?>">
      <input type="text" name="password" placeholder="password" value="<?php echo $password ?>">
      <input type="hidden" name="action" value="login">
      <input type="hidden" name="redirect" value="<?php echo $this->redirect ?>">
      <input type="submit" value="Login">
    </form>
    <?php
      var_dump($message);
    ?>
  </body>
</html>
