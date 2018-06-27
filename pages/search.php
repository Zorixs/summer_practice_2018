<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta charset="utf-8" />
        <title>
            OnlineStore_Practice
        </title>
        <link href="../css/reset.css" rel="stylesheet" />
        <link href="../css/default.css" rel="stylesheet" />
        <link href="../css/authorization.css" rel="stylesheet" />
        <link href="../css/profile.css" rel="stylesheet" />
        <link href="../css/products.css" rel="stylesheet" />
        <link href="../css/product.css" rel="stylesheet" />
        <style>
            .container {
                height: 100%;
                width: 100%;
                background-color: #393a38;
                text-align: center;
                padding-top: 1em;
            }
        </style>
    </head>
    <body>
        <?php require('page_parts/header.php') ?>

        <!--Поиск-->
        <main>
            <article>
                <div class="flex-container row">
                    <?php
                    // Соединяемся, выбираем базу данных
                    $link_c = mysqli_connect('localhost', 'root', '', "onlinestore") or die('Не удалось соединиться: ' . mysqli_error());
                    // Выполняем SQL - запрос
                    $query = 'SELECT * FROM products WHERE name="'.$_GET['name'].'"';
                    $result= mysqli_query($link_c, $query) or die('Запрос не удался: ' . mysqli_error());
                    $product_info = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    if ($_GET['action'] == "search" && count($product_info) > 1) {
                        ?>
                        <div class="flex-item flex-item-color">
                            <div class="product_image_space">
                                <img class="product_image" src="<?php echo '../images/products/'.$product_info["image"]?>" />
                            </div>
                            <div class="product_name_space">
                                <a class="product_name" href="<?php echo 'product.php?name='.$product_info['name']?>">
                                    <?php echo $product_info["name"]?>
                                </a>
                            </div>
                            <div class="product_description">
                                <?php echo "Type: ".$product_info["type"]." Color: ".$product_info["color"]?>
                            </div>
                            <div class="product_price">
                                <span class="price">
                                    <?php echo $product_info["price"].$currency?>
                                </span>
                                <?php
                                if (!empty($_COOKIE['username'])): ?>
                                <div class="product_buy">
                                    <form action="../scripts/processing_user_info.php" method="get" name="">
                                        <button type="submit" class="product_buy" name="add_to_basket" value="<?php echo $product_info['id'].'_'.$_COOKIE['user_id']?>">
                                            Добавить в корзину
                                        </button>
                                    </form>
                                    <form action="order.php" method="get" name="">
                                        <button type="submit" class="product_buy" name="buy" value="<?php echo $product_info['id']?>">
                                            Купить
                                        </button>
                                    </form>
                                </div>
                                <?php else: ?>
                                <form action="order.php" method="get" name="">
                                    <button type="submit" class="product_buy" name="buy" value="<?php echo $product_info['id']?>">
                                        Купить
                                    </button>
                                </form>
                                <?php endif ?>
                            </div>
                        </div>
                        <?php
                        mysqli_free_result($result);     // Освобождаем память от результата
                    }else {
                        echo '<div class="container">По запросу « '.$_GET['name'].' » ничего не найдено, попробуйте изменить запрос</div>';
                    }
                    mysqli_close($link_c);          // Закрываем соединение
                    ?>
                </div>
            </article>
        </main>
        <?php require('page_parts/footer.php') ?>

    </body>
</html>

