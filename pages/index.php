<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
    <title>OnlineStore_Practice</title>
    <link href="../css/reset.css" rel="stylesheet" />
    <link href="../css/default.css" rel="stylesheet" />
    <link href="../css/products.css" rel="stylesheet" />
    <link href="../css/product.css" rel="stylesheet" />
</head>
<body>
	<?php require('page_parts/header.php') ?>

    <!--Товары и Фильтр-->
    <main>
        <!--Товары-->
        <article>
            <!--Название раздела-->
            <h1 class="category_name">Садовая мебель </h1>

            <!--Товары-->
            <div class="flex-container row">
            <?php foreach($categories as $product) : ?>
                <div class="flex-item flex-item-color">
                	<div class="product_image_space">
                    	<img class="product_image" src="<?php echo '../images/products/'.$product["image"]?>" />  
                    </div>
                    <div class="product_name_space">
	                    <a class="product_name" href="<?php echo 'product.php?name='.$product['name']?>">
	                    	<?php echo $product["name"]?>
	                    </a>
	                </div>
                    <div class="product_description"><?php echo "Type: ".$product["type"]." Color: ".$product["color"]?></div>
                    <div class="product_price">                       
                        <span class="price"><?php echo $product["price"].$currency?></span>
                        <?php if(!empty($_COOKIE['username'])): ?>
                        <div class="product_buy">
	                        <form action="../scripts/processing_user_info.php" method="get" name="">
	                        	<button type="submit" class="product_buy" name="add_to_basket" value="<?php echo $product['id'].'_'.$_COOKIE['user_id']?>">
	                            	Добавить в корзину
	                            </button>
	                        </form>
	                        <form action="order.php" method="get" name="">
	                        	<button type="submit" class="product_buy" name="buy" value="<?php echo $product['id']?>">
	                            	Купить
	                            </button>
	                        </form>
                        </div>
                        <?php else: ?>
                        <form action="order.php" method="get" name="">
                            <button type="submit" class="product_buy" name="buy" value="<?php echo $product['id']?>">
                            	Купить
                            </button>
                        </form>
                        <?php endif ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </article>

        <!--Фильтр-->
        <nav>
            <form action="../scripts/filter.php">
                Цена:<br>
                <span class="checkbox_text">От </span><input type="text" name="from" style="width:3em;">
                <span class="checkbox_text">до </span><input type="text" name="to" style="width:3em;"><br>
                
                Тип:<br>                
                <input type="checkbox" name="product_type" class="checkbox" value="Chair" /> <span class="Sofa">Sofa</span><br />
                <input type="checkbox" name="product_type" class="checkbox"  value="Chair"/> <span class="Chair">Chair</span><br />
                <input type="checkbox" name="product_type" class="checkbox"  value="Table"/> <span class="Table">Table</span><br />
                <input type="checkbox" name="product_type" class="checkbox"  value="Stool"/> <span class="Stool">Stool</span><br />
                <input type="checkbox" name="product_type" class="checkbox"  value="Cabinet"/> <span class="Cabinet">Cabinet</span><br />
                Цвет:<br />                
                <input type="checkbox" name="product_color" class="checkbox"  value="White"/> <span class="White">White</span><br />
                <input type="checkbox" name="product_color" class="checkbox"  value="Orange"/> <span class="Orange">Orange</span><br />
                <input type="checkbox" name="product_color" class="checkbox"  value="Yellow"/> <span class="Yellow">Yellow</span><br />
                <input type="checkbox" name="product_color" class="checkbox"  value="Red"/> <span class="Red">Red</span><br />
                <input type="checkbox" name="product_color" class="checkbox"  value="Blue"/> <span class="Blue">Blue</span><br />
                <input type="checkbox" name="product_color" class="checkbox"  value="Brown"/> <span class="Brown">Brown</span><br />
                <input type="checkbox" name="product_color" class="checkbox"  value="Black"/> <span class="Black">Black</span><br />
                <input type="checkbox" name="product_color" class="checkbox"  value="Violet"/> <span class="Violet">Violet</span><br />
                <button type="submit" class="btn_filter">Фильтровать</button>
            </form>
        </nav>
    </main>
	<?php require('page_parts/footer.php') ?>
</body>
</html>
