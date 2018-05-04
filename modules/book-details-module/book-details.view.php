<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Book Details</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="/app.css">
    <link rel="stylesheet" href="button-css.css">
  </head>
  <body>
    <?php print $navbar ?>
    <?php
      //var_dump($message);
      //var_dump($book);
    ?>
    <img src="<?php echo $book["image"]?>">
    <p><?php echo $book["synopsys"]?></p>
    <h3>Sound good? Click the button below to add it to your reading list!</h3>
    <form method="POST">
      <input type="hidden" name="isbn" value="<?php echo $book['isbn']?>">
      <input type="hidden" name="action" value="add-book">
      <select name="status">
        <option value="Finished">Finished</option>
        <option value="InProgress">In Progress</option>
        <option value="PlanToRead">Plan To Read</option>
        <option value="Dropped">Dropped</option>
      </select>
      <input type="hidden" name="title" value="<?php echo $book['title']?>">
      <input type="hidden" name="image" value="<?php echo $book['image']?>">
      <input type="submit" name="Add to Reading List" class="btn btn-primary">
    </form>
  </body>
</html>
