<tr>
	<td><a href="/book-details?isbn=<?php echo $book["isbn"]?>"><img src= "<?php echo $book['image']?>" style="height:160px;width:106px;"></a></td>
	<td><?php echo $book['title']?></td>
	<td>
		<?php
			if ($authenticated == TRUE) {
				include 'status-edit.php';
			} else {
				echo $book['status'];
			}
		?>
	</td>
	<td>
		<?php
			if ($authenticated == TRUE) {
				include 'rating-edit.php';
			} else {
				echo $book['rating'] . "/5";
			}
		?>
	</td>
	<td>
		<form method="POST">
			<input type="hidden" name="action" value="remove-book">
			<input type="hidden" name="id" value="<?php echo $book['id']?>">
			<button class="btn btn-md btn-danger" type="submit">Delete</button>
		</form>
	</td>
</tr>
