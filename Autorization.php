<?php
session_start();
# Соединямся с БД
$connection = new PDO('mysql:host=localhost;dbname=testbd;charset=utf8', 'root', ''); // подключение к БД
# Получаем параметры из запроса
$login = isset($_REQUEST['login'])?$_REQUEST['login']:"";
$password = isset($_REQUEST['password'])?$_REQUEST['password']:"";
#Ввод логина и пароля и проверка параметров
if ($login !== "" && $password !== "") {
	// Вытаскиваем из БД запись, у которой логин равняется введенному
    $getUserData = $connection->prepare('SELECT * FROM `userinfo` WHERE `login` = ? LIMIT 1');
    $getUserData->execute(array($login));
    $userData = $getUserData->fetch(PDO::FETCH_ASSOC);
    #Проверяем пароль
    if ($password === $userData["password"]) {
    	$_SESSION["hash"] = $login;
    	header("Location: Тест1.php"); exit();
    } else {
    	echo "false";
    }
    
	#Проверка ввода данных
	// echo "<pre>";
	// echo print_r($userData);
	// echo "</pre>";
} else {
	echo "false";
}