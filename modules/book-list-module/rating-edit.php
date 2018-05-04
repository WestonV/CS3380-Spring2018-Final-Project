<form method="POST">
  <input type="hidden" name="action" value="update-book">
  <input type="hidden" name="id" value="<?php echo $book['id']?>">
  <input type="hidden" name="status" value="<?php echo $book['status']?>">
  <select name="rating">
    <option <?php echo ($book['rating']) === 0 ? 'selected' : '' ?> value="0">0</option>
    <option <?php echo ($book['rating']) === 1 ? 'selected' : '' ?> value="1">1</option>
    <option <?php echo ($book['rating']) === 2 ? 'selected' : '' ?> value="2">2</option>
    <option <?php echo ($book['rating']) === 3 ? 'selected' : '' ?> value="3">3</option>
    <option <?php echo ($book['rating']) === 4 ? 'selected' : '' ?> value="4">4</option>
    <option <?php echo ($book['rating']) === 5 ? 'selected' : '' ?> value="5">5</option>
  </select><span>/5</span><br>
  <button type="submit" class="btn btn-md btn-success">Submit Change</button>
</form>
