<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>ACME</title>
    <link rel="stylesheet" href="css/main.scss">
</head>
<header class="header-outer">
    <div class="header-inner responsive-wrapper">
        <div class="header-logo">
            <img src="https://assets.codepen.io/285131/acme-2.svg" />
        </div>
        <nav class="header-navigation">
            <a href="index.php">Главная</a>
            <a href="add.php">Создать новость</a>
            <a href="edit.php">Редактирование новости</a>
            <a href="Login.php">Войти</a>
            <button>Menu</button>
        </nav>
    </div>
</header>

<?php

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "users");

$con = mysqli_connect(DB_SERVER,DB_USER, DB_PASS) or die(mysqli_error());
mysqli_select_db($con, 'users') or die("Cannot select DB");

if(isset($_POST["register"])){

    if(!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        $full_name= htmlspecialchars($_POST['full_name']);
        $email=htmlspecialchars($_POST['email']);
        $username=htmlspecialchars($_POST['username']);
        $password=htmlspecialchars($_POST['password']);
        $query=mysqli_query($con,"SELECT * FROM user WHERE username='$username'");
        $num=mysqli_num_rows($query);
        if($num==0)
        {
            $sql="INSERT INTO user (full_name, email, username,password) VALUES('$full_name','$email', '$username', '$password')";
            $result=mysqli_query($con,"INSERT INTO user (full_name, email, username,password) VALUES('$full_name','$email', '$username', '$password')");
            if($result){
                $message = "Account Successfully Created";
            } else {
                $message = "Failed to insert data information!";
            }
        } else {
            $message = "That username already exists! Please try another one!";
        }
    } else {
        $message = "All fields are required!";
    }
}
?>

<?php if (!empty($message)) {echo "<p class='error'>" . "MESSAGE: ". $message . "</p>";} ?>


<body>
<main class="main">
    <div class="main-content responsive-wrapper">
        <article class="widget">
    <div id="login">
        <h1>Регистрация</h1>
        <form action="register.php" id="registerform" method="post"name="registerform">
            <p><label for="user_login">Полное имя<br>
                    <input class="input" id="full_name" name="full_name"size="32"  type="text" value=""></label></p>
            <p><label for="user_pass">E-mail<br>
                    <input class="input" id="email" name="email" size="32"type="email" value=""></label></p>
            <p><label for="user_pass">Имя пользователя<br>
                    <input class="input" id="username" name="username"size="20" type="text" value=""></label></p>
            <p><label for="user_pass">Пароль<br>
                    <input class="input" id="password" name="password"size="32"   type="password" value=""></label></p>
            <p class="submit"><input class="button" id="register" name= "register" type="submit" value="Зарегистрироваться"></p>
            <p class="regtext">Уже зарегистрированы? <a href= "login.php">Введите имя пользователя</a>!</p>
        </form>
    </div>
        </article>
    </div>
</main>
</body>
</html>