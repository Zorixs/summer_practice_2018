<div id="signup">
    <form action="../../scripts/work_with_db.php"  method="post" enctype="multipart/form-data">
        Название товара:<br /><input type="text" name="name" /><br />
        Описание:<br /><input type="text" name="description" /><br />
        Цена:<br /><input type="text" name="price" /><br />
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
        <button type="submit" name="action" value="add">Добавить</button>
    </form>
</div>