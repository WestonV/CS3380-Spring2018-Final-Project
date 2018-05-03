<tr>
	<?php //var_dump($book) ?>
	<td><a href="/book-details?isbn=<?php echo $book["isbn"]?>"><img src= "<?php echo $book['image']?>" style="height:160px;width:106px;"></a></td>
	<td><?php echo $book['title']?></td>
	<td><?php echo $book['authors'][0]?></td>
	<td><?php echo $book['date_published']?></td>
</tr>