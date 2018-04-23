<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>User Search</title>
  </head>
  <body>
    <?php print $navbar ?>
    <form action="user-search" method="GET">
      <input type="text" name="search" value="<?php echo $data['search']?>">
      <input type="submit" value="Search">
    </form>
    <?php
      var_dump($message);
      var_dump($data);
    ?>
  </body>
</html>
