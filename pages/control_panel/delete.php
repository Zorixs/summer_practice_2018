<div id="signup">
	<form action="../../scripts/work_with_db.php"  method="post" enctype="multipart/form-data">
		Выберите товар который вы хотите удалить:<br />
		<select name="name">
			<?php
			// Соединяемся, выбираем базу данных            
		    $link_c = mysqli_connect('localhost', 'root', '', "onlinestore") or die('Не удалось соединиться: ' . mysqli_error());    
		    // Выполняем SQL - запрос
		    $query = 'SELECT name FROM products';
		    $result= mysqli_query($link_c, $query) or die('Запрос не удался: ' . mysqli_error());      
		    
			while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)):
			?>
			<option>
				<?php echo $line["name"]?>
			</option>
			<?php endwhile;         
			mysqli_free_result($result); 	// Освобождаем память от результата
			mysqli_close($link_c);            // Закрываем соединение
			?>
		</select> <br>
		<button type="submit" name="action" value="delete">
			Удалить
		</button>
	</form>
</div>