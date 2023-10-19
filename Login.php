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
session_start();
?>

<?php

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "users");

$con = mysqli_connect(DB_SERVER,DB_USER, DB_PASS) or die(mysqli_error());
mysqli_select_db($con, 'users') or die("Cannot select DB");

if(isset($_SESSION["session_username"])){
    // вывод "Session is set"; // в целях проверки
    header("Location: index.php");
}

if(isset($_POST["login"])){

    if(!empty($_POST['username']) && !empty($_POST['password'])) {
        $username=htmlspecialchars($_POST['username']);
        $password=htmlspecialchars($_POST['password']);
        $query =mysqli_query($con,"SELECT * FROM user WHERE username='".$username."' AND password='".$password."'");
        $num=mysqli_num_rows($query);
        if($num!=0)
        {
            while($row=mysqli_fetch_assoc($query))
            {
                $dbusername=$row['username'];
                $dbpassword=$row['password'];
            }
            if($username == $dbusername && $password == $dbpassword)
            {
                // старое место расположения
                //  session_start();
                $_SESSION['session_username']=$username;
                /* Перенаправление браузера */
                header("Location: index.php");
            }
        } else {
            //  $message = "Invalid username or password!";

            echo  "Invalid username or password!";
        }
    } else {
        $message = "All fields are required!";
    }
}
?>

<body>
<main class="main">
    <div class="main-content responsive-wrapper">
        <article class="widget">
    <div id="login">
        <h1>Вход</h1>
        <form action="" id="loginform" method="post"name="loginform">
            <p><label for="user_login">Имя опльзователя<br>
                    <input class="input" id="username" name="username"size="20"
                           type="text" value=""></label></p>
            <p><label for="user_pass">Пароль<br>
                    <input class="input" id="password" name="password"size="20"
                           type="password" value=""></label></p>
            <p class="submit"><input class="button" name="login"type= "submit" value="Войти"></p>
            <p class="regtext">Еще не зарегистрированы? <a href= "register.php">Регистрация</a>!</p>
        </form>
    </div>
        </article>
    </div>
</main>
</body>
</html>