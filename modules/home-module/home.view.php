<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Home</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="/app.css">
  </head>
  <body>
    <?php print $navbar ?>
    <h1 class="text-center">Welcome to MyBookList!</h1>
    <p class="text-center">
      This website is used for creating/managing your list of books that you have read, plan-to-read, are work-in-progress, or have dropped.<br><br>

      You can search for a book in the book-search page, or if you know the ISBN of the book you want you can do to this url:<br>
        http://ec2-34-230-43-187.compute-1.amazonaws.com/book-details?isbn=ISBN_HERE<br>
        Replace 'ISBN_HERE' with the ISBN you have.<br><br>

      You can also search for users and view their book list, plus if you go to your own list you can edit any ratings/statuses for your books.<br><br>

      The 'edit profile' button on your profile allows you to change your password, bio, and email.
    </p>
  </body>
</html>
