<?php

function back_to_page()
{
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

function add($name, $price, $description, $type, $color, $image)
{
	// Соединяемся, выбираем базу данных
	$link_c = mysqli_connect('localhost', 'root', '', "onlinestore") or die('Не удалось соединиться: ' . mysqli_error());    
	// Выполняем SQL - запрос
	$query = "INSERT INTO products (name, price, description, type, color, image) VALUES ('$name', '$price', '$description', '$type', '$color', '$image')";
	mysqli_query($link_c, $query) or die('Запрос не удался: ' . mysqli_error($link_c));			
    mysqli_close($link_c);            // Закрываем соединение
}


function edit($title, $name, $description, $price, $type, $color, $image)
{ 	
	// Выполняем SQL - запрос       
    if (!empty($title) && (!empty($name) || !empty($price) || !empty($description) || !empty($type)|| !empty($color) || !empty($image))) {
        $query = " UPDATE products SET ";
        $i     = 0;
        if (!empty($name)) {
            $query .= "name='$name'";
            $i++;
        }
        if (!empty($price)) {
            if ($i > 0) {
                $query .= ", ";
            }
            $query .= "price='$price'";
            $i++;
        }
        if (!empty($description)) {
            if ($i > 0) {
                $query .= ", ";
            }
            $query .= "description='$description'";
            $i++;
        }        
        if (!empty($type)) {
            if ($i > 0) {
                $query .= ", ";
            }
            $query .= "type='$type'";
            $i++;
        }        
        if (!empty($color)) {
            if ($i > 0) {
                $query .= ", ";
            }
            $query .= "color='$color'";
            $i++;
        }
        if (!empty($image)) {
            if ($i > 0) {
                $query .= ", ";
            }
            $query .= "image='$image'";
            $i++;
        }
        // Соединяемся, выбираем базу данных
		$link_c = mysqli_connect('localhost', 'root', '', "onlinestore") or die('Не удалось соединиться: ' . mysqli_error());    
		// Выполняем SQL - запрос
		$query .= " WHERE name='$title'";
		$result= mysqli_query($link_c, $query) or die('Запрос не удался: ' . mysqli_error($link_c));			
	    mysqli_close($link_c);            // Закрываем соединение        
    }
}


function delete($name)
{	
	// Соединяемся, выбираем базу данных
	$link_c = mysqli_connect('localhost', 'root', '', "onlinestore") or die('Не удалось соединиться: ' . mysqli_error());    
	// Выполняем SQL - запрос
	$query = "DELETE FROM products WHERE name='$name'";
	mysqli_query($link_c, $query) or die('Запрос не удался: ' . mysqli_error($link_c));			
    mysqli_close($link_c);            // Закрываем соединение
}

function file_load()
{
    // проверяем, что есть файл
    if ($_FILES["filename"]["size"] > 1024 * 3 * 1024) {
        echo ("Размер файла превышает три мегабайта");
        exit;
    }
    // Проверяем загружен ли файл
    if (is_uploaded_file($_FILES["filename"]["tmp_name"])) {
        // Если файл загружен успешно, перемещаем его
        // из временной директории в конечную
        chdir('../');
        move_uploaded_file($_FILES["filename"]["tmp_name"], getcwd().'\images\products\\'.$_FILES["filename"]["name"]);
    }
    else {
        echo("Ошибка загрузки файла");
    }
}

function dispatcher()
{
    switch ($_POST['action']) {
        case 'add':
        file_load();
        add($_POST['name'], $_POST['price'],  $_POST['description'], $_POST['type'], $_POST['color'], $_FILES["filename"]["name"]);
        back_to_page();
        break;
        case 'edit':
        file_load();
        edit($_POST['title'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['type'], $_POST['color'], $_FILES["filename"]["name"]);
        back_to_page();
        break;
        case 'delete':
        delete($_POST['name']);
        back_to_page();
        break;
        default:
        break;
    }
}

dispatcher();
?>