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
    <link href="../css/products.css" rel="stylesheet" />
    <link href="../css/product.css" rel="stylesheet" />
    <link href="../css/profile.css" rel="stylesheet" />
      
</head>
<body>
	<?php require('page_parts/header.php') ?>

    <!--Корзина и История покупок-->
    <main>
        <div class="container_profile">
            <h1 class="header">Профиль</h1>
            <div class="container">
                <div class="profile_info" style="margin: 0.1em 0 0 0.5em;">
            	<?php
	        		// Соединяемся, выбираем базу данных
	                $link = mysqli_connect('localhost', 'root', '', "onlinestore") or die('Не удалось соединиться: ' . mysqli_error());
	                
	                // Выполняем SQL - запрос
	                $query = 'SELECT * FROM user WHERE id="'.$user_id.'"';
	                $result= mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error());
	                $user_info = mysqli_fetch_array($result, MYSQLI_ASSOC);                    
             		
             		
                    echo '<img src="'."../images/users/".$user_info['avatar'].'" width="400" />';
					echo '<p>Name: '.$user_info["name"]."<br>Surname: ".$user_info["surname"].'</p>';
					echo '<p>Email: '.$user_info["email"].'</p>';
					echo '<p>Phone: '.$user_info["phone"].'</p>';	
					
                ?>
                </div>
                <div class="purchase_info">
                    <div style="margin: 0 0 0 1em; ">
                        <h1>Корзина</h1>
                        <form action="../scripts/processing_user_info.php" method="get">
                            <button type="submit" name="work_with_basket" value="<?php echo $user_id; ?>">Очистить корзину</button>
                        </form>

                        <div class="flex-container row">
                    	<?php
                    	    $link_c = mysqli_connect('localhost', 'root', '', "onlinestore") or die('Не удалось соединиться: ' . mysqli_error());    
						    // Выполняем SQL - запрос
			                $query= "SELECT *
									FROM `products` , `product_bascet`
									WHERE `product_bascet`.`product_id` = `products`.`id`
									AND `product_bascet`.`user_id`=".$user_id."";
			            	$result= mysqli_query($link_c, $query) or die('Запрос не удался: ' . mysqli_error());
               			?>                  				
                        <?php while($user_pb = mysqli_fetch_array($result, MYSQLI_ASSOC)) :   ?>                          
                        <div class="flex-item flex-item-color">
							<div class="product_image_space">
								<img class="product_image" src="<?php echo '../images/products/'.$user_pb["image"]?>" />  
							</div>
							<div class="product_name_space">
								<a class="product_name" href="<?php echo 'product.php?name='.$user_pb['name']?>">
							</div>
							<?php echo $user_pb["name"]?>
							</a>							
                    		<div class="product_description"><?php echo "Type: ".$user_pb["type"]." Color: ".$user_pb["color"]?></div>
								<div class="product_price">                       
								    <span class="price"><?php echo $user_pb["price"].$currency?></span>
								    <div class="product_buy">
								    <form action="order.php" method="get" name="">
								        <button type="submit" class="product_buy" name="buy" value="<?php echo $user_pb['id']?>">
								        	Купить
								        </button>
								    </form>		
							    </div>						    
							</div>
						</div>    
						<?php endwhile;	?>
						</div>

                        <h1>История покупок</h1>
                              
                       	
                        <div class="flex-container row">
                    	<?php
                    	    $link_c = mysqli_connect('localhost', 'root', '', "onlinestore") or die('Не удалось соединиться: ' . mysqli_error());    
						    // Выполняем SQL - запрос
			                $query= "SELECT *
									FROM `products` , `purchase_history`
									WHERE `purchase_history`.`product_id` = `products`.`id`
									AND `purchase_history`.`user_id`=".$user_id."";
			            	$result= mysqli_query($link_c, $query) or die('Запрос не удался: ' . mysqli_error($link_c));	
               			?>                  				
                        <?php while($user_pb = mysqli_fetch_array($result, MYSQLI_ASSOC)) :   ?>                          
                        <div class="flex-item flex-item-color">
							<div class="product_image_space">
								<img class="product_image" src="<?php echo '../images/products/'.$user_pb["image"]?>" />  
							</div>
							<div class="product_name_space">
								<a class="product_name" href="<?php echo 'product.php?name='.$user_pb['name']?>">
							</div>
							<?php echo $user_pb["name"]?>
							</a>							
                  			<div class="product_description"><?php echo "Type: ".$user_pb["type"]." Color: ".$user_pb["color"]?></div>
								<div class="product_price">                       
								    <span class="price"><?php echo $user_pb["price"].$currency?></span>
								    <div class="product_buy">
							   		</div>						    
								</div>
						</div>    
						<?php endwhile;	?>
						</div>
                        
                    </div>							
                </div>
            </div>
        </div>
    </main>

	<?php require('page_parts/footer.php') ?>
</body>
</html>
