<?php
$link = mysqli_connect('localhost', 'root', '', 'onlinestore');

function get_categories($link){
	$sql = "SELECT * FROM products";
	$result = mysqli_query($link, $sql);
	$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $categories;
}
$categories = get_categories($link);

if(!isset($_COOKIE['user_id'])) {
	if(isset($_GET['submit'])) {
		$user_username = mysqli_real_escape_string($link, trim($_GET['username']));
		$user_password = mysqli_real_escape_string($link, trim($_GET['password']));
		if(!empty($user_username) && !empty($user_password)) {
			$query = "SELECT * FROM user WHERE login ='$user_username' AND password = SHA('$user_password')";
			$data = mysqli_query($link,$query);
			if(mysqli_num_rows($data) == 1) {
				$row = mysqli_fetch_assoc($data);
				setcookie('user_id', $row['id'], time() + (60*60*24*30));
				setcookie('username', $row['login'], time() + (60*60*24*30));
				$page = $_SERVER['PHP_SELF'];
				$sec = "0";
				header("Refresh: $sec; url=$page");
			}
			else {
				echo 'Извините, вы должны ввести правильные имя пользователя и пароль';
			}
		}
		else {
			echo 'Извините вы должны заполнить поля правильно';
		}
	}
} else if(isset($_GET['page'])){
	if($_GET['page']=="exit"){
		setcookie("user_id", "", time() - 100);
		setcookie("username", "", time() - 100);
		$home_url = 'http://' . $_SERVER['HTTP_HOST'];
		header('Location: '. $home_url);
	} else if($_GET['page']=="profile"){
		header('Location: '. 'http://' . $_SERVER['HTTP_HOST'].'/pages/profile.php');
	} else if($_GET['page']=='admin_panel'){
		header('Location: '. 'http://' . $_SERVER['HTTP_HOST'].'/pages/panel.php');		
	}
} else{		
	
}
$user_id;
if(isset($_COOKIE["user_id"])){
	$user_id = $_COOKIE['user_id'];
}else{
	$user_id=-1;
}
$currency = "$";
// echo var_dump($_COOKIE);
?>

<!--Заголовок-->
<header>
    <h1 class="site_name">Garden Furniture in Ukraine</h1>
    <div id="authentefication">
        <?php  if(empty($_COOKIE['username'])) {  ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
            <input type="text" name="username" class="login" placeholder="Login">
            <input type="text" name="password" class="login" placeholder="Password">
            <button type="submit" class="btn_filter" name="submit" value="submit">Войти</button>
            <span> <a href="signup.php">Регистрация</a></span>
        </form>
        <?php  } else { ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
        	<button type="submit" name="page" value="profile">Мой профиль</button>
        	<?php 
		    // Соединяемся, выбираем базу данных
			$link_c = mysqli_connect('localhost', 'root', '', "onlinestore") or die('Не удалось соединиться: ' . mysqli_error());    
			// Выполняем SQL - запрос
			$query = 'SELECT is_admin FROM `user` WHERE `id`='.$_COOKIE["user_id"];
			$result = mysqli_query($link_c, $query) or die('Запрос не удался: ' . mysqli_error());			
		    mysqli_close($link_c);            // Закрываем соединение        
		    $ud = mysqli_fetch_array($result, MYSQLI_ASSOC);		
        	if($ud["is_admin"]==1){
		?>        	
        	<button type="submit" name="page" value="admin_panel">Панель управления</button>        	
		<?php
			}
		?>
        	<button type="submit" name="page" value="exit">Выйти(<?php echo $_COOKIE['username']; ?>)</button>
        <?php } ?>
        </form>
</header>

<!--Меню-->
<div id="menu">
    <ul>
        <li><a href="index.php">Товары</a></li>
        <li><a href="guarantee.php">Гарантия</a></li>
        <li><a href="about.php">О нас</a></li>
    </ul>
    <form id="search" action="search.php">
        <input type="text" name="name" placeholder="Поиск товаров" />
        <button type="submit" name="action" value="search">Искать</button>
    </form>
</div>