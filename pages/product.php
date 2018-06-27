<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
    <title>OnlineStore_Practice</title>
    <link href="../css/reset.css" rel="stylesheet" />
    <link href="../css/default.css" rel="stylesheet" />
    <link href="../css/authorization.css" rel="stylesheet" />
    <link href="../css/profile.css" rel="stylesheet" />
    <link href="../css/tabs.css" rel="stylesheet" />
    <style>
        .container {
            width: 100%;
            height: 100%;
            background-color: #546e7a;
        }

        .info  {
            width: 40%;
            height: 100%;
            float: left;
        } 
        
        .product_info {
            width: 60%;
            height: 100%;
            float: left;
        }
        
        .product_image{
			align-items: center;
		}
		
		.product_image img{			
			max-width: 30em;
		}

    </style>
	
</head>
<body>
	<?php require('page_parts/header.php') ?>

    <!--Информация о товаре-->
    <main>
        <div class="container">
        	<?php 
        		// Соединяемся, выбираем базу данных
        		$link_c = mysqli_connect('localhost', 'root', '', "onlinestore") or die('Не удалось соединиться: ' . mysqli_error());    
			    // Выполняем SQL - запрос
			    $query = 'SELECT * FROM products WHERE name="'.$_GET['name'].'"';
			    $result= mysqli_query($link_c, $query) or die('Запрос не удался: ' . mysqli_error());			    
				$product_info = mysqli_fetch_array($result, MYSQLI_ASSOC);        	
        	?>
            <div class="info">
				<form action="order.php" method="get">
					<div class="product_image">
						<img src="<?php echo '../images/products/'.$product_info['image'] ?>" />
					</div>
					<h1><?php echo $product_info['name'] ?></h1>
					<p>Цена: <?php echo $product_info['price'] ?>$</p>
					<button type="submit" class="buy" name="buy" value="<?php echo $product_info["id"] ?>">Купить</button>					
				</form>
				<form action="../scripts/processing_user_info.php" method="get" name="">
					<button type="submit" class="product_buy" name="add_to_basket" value="<?php echo $product_info['id'].'_'.$_COOKIE['user_id']?>">
						Добавить в корзину
					</button>
				</form>
            </div>        
			<div class="product_info">
				<input type="radio" name="odin" checked="checked" id="description"/>
				<label for="description">Описание</label>
				<input type="radio" name="odin" id="characteristics"/>
				<label for="characteristics">Характеристики</label>
				<div>
				<?php 
					echo $product_info["description"];
				?>					
				</div>
				<div>
				<?php 
					echo "Название: ".$product_info["name"]."<br>";
					echo "Тип: ".$product_info["type"]."<br>";
					echo "Цвет: ".$product_info["color"]."<br>";
				?>						
				</div>
			</div>
			<?php 
			    mysqli_free_result($result); 	// Освобождаем память от результата
				mysqli_close($link_c);          // Закрываем соединение
			?>
        </div>
    </main>

    <?php require('page_parts/footer.php') ?>
</body>
</html>
