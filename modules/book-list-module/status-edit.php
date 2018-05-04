<form method="POST">
  <input type="hidden" name="action" value="update-book">
  <input type="hidden" name="id" value="<?php echo $book['id']?>">
  <input type="hidden" name="rating" value="<?php echo $book['rating']?>">
  <select name="status">
    <option <?php echo ($book['status']) === 'Finished' ? 'selected' : '' ?> value="Finished">Finished</option>
    <option <?php echo ($book['status']) === 'InProgress' ? 'selected' : '' ?> value="InProgress">In Progress</option>
    <option <?php echo ($book['status']) === 'PlanToRead' ? 'selected' : '' ?> value="PlanToRead">Plan To Read</option>
    <option <?php echo ($book['status']) === 'Dropped' ? 'selected' : '' ?> value="Dropped">Dropped</option>
  </select><br>
  <button type="submit" class="btn btn-md btn-success">Submit Change</button>
</form>
