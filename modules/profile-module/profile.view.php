<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="/app.css">
    <style>
      #wrapper{
        width: 60%;
        margin-left: 5%;
        margin-right: auto;
      }
      #name-join-email{
        float: left;
        width: 20%;
      } 
      #wrapper::after{
        content: "";
        clear: both;
        display: table;
      }
      #bioDiv{
        float: right;
        width: 60%;
      }
      #book-link{
        color: white;
      }
    </style>
  </head>
  <body>
    <?php print $navbar ?>
    <div id="wrapper">
      <div id="name-join-email">
        <h4><?php echo $profile->username ?></h1>
        <h5><?php echo $profile->joinDate ?></h4>
        <h5><?php echo $profile->email ?></h4>
        <a id="book-link" href="/book-list?user=<?php echo $profile->username?>">View this users book list</a>
        <?php
          if($editable == true){
            echo'<a href="/edit-profile">
            <button type="button" class="btn btn-success" >Edit your profile</button>
            </a>';
          }
        ?>
      </div>
      <div id="bioDiv">
        <p><?php echo $profile->bio ?></p>
      </div>
    </div>

  </body>
</html>
