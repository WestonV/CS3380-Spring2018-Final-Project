<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>User Search</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="/app.css">
  </head>
  <body>
    <?php print $navbar ?>
    <form action="user-search" method="GET">
      <input class="form-control" style="width: 15%" placeholder="Username" type="text" name="search" value="<?php echo $data['search'] ?>">
      <input class="btn btn-md btn-success" type="submit" value="Search">
    </form>
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Username</th>
          <th scope="col">Join Date</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($users as $value) {
            include 'user-row.php';
          }
        ?>
      </tbody>
    </table>
  </body>
</html>
