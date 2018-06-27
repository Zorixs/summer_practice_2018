<?php
if(isset($_POST['submit'])){
	$link = mysqli_connect('localhost', 'root', '', 'onlinestore');
	$login = mysqli_real_escape_string($link, trim($_POST['login']));
	$password1 = mysqli_real_escape_string($link, trim($_POST['password1']));
	$password2 = mysqli_real_escape_string($link, trim($_POST['password2']));
	$email= mysqli_real_escape_string($link, trim($_POST['email']));
	if(!empty($login) && !empty($password1) && !empty($password2)&& !empty($email) && ($password1 == $password2)) {
		$query = "SELECT * FROM `user` WHERE login = '$login'";
		$data = mysqli_query($link, $query);
		if(mysqli_num_rows($data) == 0) {
			$query ="INSERT INTO `user` (login, password,email) VALUES ('$login', SHA('$password2'),('$email'))";
			mysqli_query($link,$query);
			echo 'Всё готово, можете авторизоваться';
			mysqli_close($link);
			echo   '<script>
					function func() {
						location.replace("index.php");
					}
					setTimeout(func, 1000);
					</script>';
			exit();
		}
		else {
			echo 'Логин уже существует';
		}
	}
	mysqli_close($link);
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
    <title>OnlineStore_Practice</title>
    <link href="../css/reset.css" rel="stylesheet" />
    <link href="../css/default.css" rel="stylesheet" />
    <link href="../css/authorization.css" rel="stylesheet" />
</head>
<body>	
	<?php require('page_parts/header.php') ?>

    <!--Форма для регистрации-->
    <main>
        <article>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="signup">
                ФИО:<br /><input type="text" name="login" /><br />
                Email:<br /><input type="email" name="email" /><br />
                Пароль:<br /><input type="password" name="password1" /><br />
                Повторите пароль:<br /><input type="password" name="password2" /><br />
                <button type="submit" name="submit">Зарегистрироваться</button>
            </form>
        </article>
    </main>

	<?php require('page_parts/footer.php') ?>
</body>
</html>
