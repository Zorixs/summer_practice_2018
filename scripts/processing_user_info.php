<?php


function purchase_product($p_id, $user_id)
{	
    $conn     = mysqli_connect('localhost', 'root', '', 'onlinestore');
    $name     = mysqli_real_escape_string($conn, trim($_GET['name']));
    $email    = mysqli_real_escape_string($conn, trim($_GET['email']));
    $phone    = mysqli_real_escape_string($conn, trim($_GET['phone']));
    $region   = mysqli_real_escape_string($conn, trim($_GET['region']));
    $city     = mysqli_real_escape_string($conn, trim($_GET['city']));
    $address  = mysqli_real_escape_string($conn, trim($_GET['address']));
    
    $delivery_type;
    switch(mysqli_real_escape_string($conn, trim($_GET['delivery_type']))){
		case "fix_price": $delivery_type = 1;
			break;		
		default: $delivery_type = -1;
			break;
	}
    $payment_type;
    switch( mysqli_real_escape_string($conn, trim($_GET['payment_type']))){
		case "upon_get": $payment_type = 1;
			break;		
		default: $payment_type = -1;
			break;
	}    
    
    if (!empty($name) && !empty($email) && !empty($phone) && !empty($region) 
    	&& !empty($city) && !empty($address) && !empty($delivery_type) && !empty($payment_type)) {  
    	
    	$query = "INSERT INTO `purchase_history` 
    	(`id`, `user_id`, `product_id`, `username`, `email`, `phone`, `region`, `city`, `address`, `delivery_type`, 
    	`payment_type`, `purchase_date`, `order_status`) 
    	VALUES (NULL, '".$user_id."', '".$p_id."', '".$name."', '".$email."', '".$phone."', '".$region."', '".$city."', 
    	'".$address."', '".$delivery_type."', '".$payment_type."', CURRENT_TIMESTAMP, '0');";
    	         	                    
        mysqli_query($conn,$query);
        echo 'Всё готово, заказ оформлен';
        mysqli_close($conn);
        
        echo   '<script>
	            function func() {
	            	location.replace("../pages/index.php");
	            }
	            setTimeout(func, 1000);
	            </script>';
        exit();
    }
    mysqli_close($conn);
}

function add_to_basket($product_id, $user_id)
{
	// Соединяемся, выбираем базу данных
	$link_c = mysqli_connect('localhost', 'root', '', "onlinestore") or die('Не удалось соединиться: ' . mysqli_error());    
	// Выполняем SQL - запрос
	$query = "INSERT INTO product_bascet (user_id, product_id) VALUES ('.$user_id.', '$product_id')";
	mysqli_query($link_c, $query) or die('Запрос не удался: ' . mysqli_error());			
    mysqli_close($link_c);            // Закрываем соединение
        
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

function clear_basket($user_id){
	
	// Соединяемся, выбираем базу данных
	$link_c = mysqli_connect('localhost', 'root', '', "onlinestore") or die('Не удалось соединиться: ' . mysqli_error());    
	// Выполняем SQL - запрос
	$query = "DELETE FROM `product_bascet` WHERE `user_id`=".$user_id;
	mysqli_query($link_c, $query) or die('Запрос не удался: ' . mysqli_error());			
    mysqli_close($link_c);            // Закрываем соединение
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

function p_dispatcher(){
	if(!empty($_GET['add_to_basket'])){	
		$user_id=-1;
		$data = $_GET['add_to_basket'];
		$d= explode('_', $data);      
        
        if (!empty($d[1])) {
            $user_id = $d[1];
        }
        echo($d[0]." ".$user_id);	
		add_to_basket($d[0], $user_id);
	}else  if(!empty($_GET['p_id'])) {	
		$user_id=-1;
		$data = $_GET['p_id'];
		$d= explode('_', $data);      
        
        if (!empty($d[1])) {
            $user_id = $d[1];
        }
		
		purchase_product($data[0], $user_id);
	} else if(!empty($_GET["work_with_basket"])){
		clear_basket($_GET["work_with_basket"]);
	}
}
p_dispatcher();
?>