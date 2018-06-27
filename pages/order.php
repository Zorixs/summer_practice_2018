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
    <link href="../css/order.css" rel="stylesheet" />
</head>
<body>
	<?php require('page_parts/header.php') ?>

    <!--Форма для оформления покупки-->
    <main>
        <article >
            <form method="get" action="../scripts/processing_user_info.php">
                <div class="input">
                    <h1>Информация</h1>
                    <h3>Им'я, Отчество</h3>
                    <input type="text" name="name" />
                    <h3>Email</h3>
                    <input type="email" name="email" />
                    <h3>Телефон</h3>
                    <input type="tel" name="phone" />
                </div>

                <div class="input">
                    <h1>Адрес</h1>
                    <h3>Регион/Область</h3>
                    <input type="text" name="region" />
                    <h3>Город</h3>
                    <input type="text" name="city" />
                    <h3>Адрес</h3>
                    <input type="text" name="address" />
                    <h1>Доставка и оплата</h1>
                    <h3>Выберите удобный способ доставки для данного заказа</h3>
                    <input type="radio" name="delivery_type" value="fix_price" /><span>Доставка с фиксированой стоимостю заказа</span>
                    <h3>Выберите способ оплаты для данного заказа</h3>
                    <input type="radio" name="payment_type" value="upon_get" /><span>Оплата при доставке</span>
               		<button type="submit" id="issue" name="p_id"  value="<?php echo $_GET['buy'].'_'.$_COOKIE['user_id'] ?>">Оформить</button>
                </div>
            </form>
        </article>
    </main>

    <?php require('page_parts/footer.php') ?>    
</body>
</html>
