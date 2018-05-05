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
	<?php
		if ($authenticated == TRUE) {
			include 'delete-book.php';
		}
	?>
</tr>
