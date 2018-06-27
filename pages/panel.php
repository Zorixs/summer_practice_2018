<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
    <title>OnlineStore_Practice</title>
    <link href="../css/reset.css" rel="stylesheet" />
    <link href="../css/default.css" rel="stylesheet" />
    <link href="../css/authorization.css" rel="stylesheet" />
    <link href="../css/admin_panel_page.css" rel="stylesheet" />
    <link href="../css/profile.css" rel="stylesheet" />
</head>
<body>
	<?php require('page_parts/header.php') ?>

    <!--Форма для регистрации-->
    <main>
        <article class="flex-container row">
           <?php
			if(isset($_GET['page'])){
				switch($_GET['page']){
					case "add": include('control_panel/add.php');
						break;
					case "edit": include('control_panel/edit.php');
						break;
					case "delete": include('control_panel/delete.php');
						break;			   	
					case "show": include('control_panel/show.php');
						break;
					default:
						break;
				}
			}           	
           ?>
        </article>
        
        <nav>
			<a href="?page=add">Добавить товар</a><br>
			<a href="?page=edit">Редактировать товар</a><br>
			<a href="?page=delete">Удалить товар</a><br>
			<a href="?page=show"> Список заказов</a><br>
        </nav>
    </main>

    <?php require('page_parts/footer.php') ?>
</body>
</html>
