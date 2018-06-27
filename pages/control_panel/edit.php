<div id="signup">
    <form action="../../scripts/work_with_db.php"  method="post" enctype="multipart/form-data">
        Выберите товар для редактирования:<br />
        <select name="title">
            <?php
            // Соединяемся, выбираем базу данных
            $link_c = mysqli_connect('localhost', 'root', '', "onlinestore") or die('Не удалось соединиться: ' . mysqli_error());
            // Выполняем SQL - запрос
            $query = 'SELECT name FROM products';
            $result= mysqli_query($link_c, $query) or die('Запрос не удался: ' . mysqli_error());

            while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)):
            ?>
            <option>
                <?php echo $line["name"]?>
            </option>
            <?php endwhile;
            mysqli_free_result($result);     // Освобождаем память от результата
            mysqli_close($link_c);            // Закрываем соединение
            ?>
        </select> <br />
        Название товара:<br /><input type="text" name="name" /><br>
        Описание:<br /><input type="text" name="description" /><br>
        Цена:<br><input type="text" name="price" /><br>
        Тип:<br>
		<select name="type" >
			<option value="Sofa">Sofa</option>
			<option value="Chair">Chair</option>
			<option value="Table">Table</option>
			<option value="Stool">Stool</option>
			<option value="Cabinet">Cabinet</option>
		</select> 
        <br>
        Цвет:<br>        
		<select name="color" >
			<option value="White">White</option>
			<option value="Orange">Orange</option>
			<option value="Yellow">Yellow</option>
			<option value="Green">Green</option>
			<option value="Red">Red</option>
			<option value="Blue">Blue</option>
			<option value="Brown">Brown</option>
			<option value="Black">Black</option>
			<option value="Violet">Violet</option>
		</select> 
        <br>
        Картинка с товаром:<br /><input type="file" name="filename" accept="image/*" /><br />
        <button type="submit" name="action" value="edit">
            Edit
        </button>
    </form>
</div>