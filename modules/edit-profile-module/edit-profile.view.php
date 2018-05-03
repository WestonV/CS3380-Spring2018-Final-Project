<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="/app.css">
  </head>
  <body>
    <?php print $navbar ?>

  <form action="edit-profile" method="POST">
    <div class="form-group">
      <label for="exampleInputEmail1">Change your email address</label>
      <input name="email" type="email" class="form-control" id="editEmail" aria-describedby="emailHelp" value="<?php echo $user->email ?>">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Change your password</label>
      <input name="password" type="password" class="form-control" id="editPassword" value="">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Confirm your new password</label>
      <input name="confirmed" type="password" class="form-control" id="editConfirmed">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Change your bio</label>
      <textarea name="bio" class="form-control" id="editBioTextField"><?php echo $user->bio ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Save Changes</button>
    <input type="hidden" name="action" value="update-profile">
</form>

<p class="error"><?php echo $message ?></p>
  </body>
</html>
