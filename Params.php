<?php  
	$connection = new PDO('mysql:host=localhost;dbname=testbd;charset=utf8', 'root', ''); // подключение к БД
	//Получаем параметры запроса
 //    echo "<pre>";
	// echo print_r($_REQUEST, true);
	// echo "</pre>";
    $object_id = isset($_REQUEST['object_id'])?$_REQUEST['object_id']:"";
    if ($object_id !== "") {
    	// Вытаскиваем из БД запись параметров
    	$getUserData = $connection->prepare('SELECT * FROM `params` WHERE `object_id` = ? ORDER BY `id` DESC LIMIT 5');
    	$getUserData->execute(array($object_id));
    	$userData = $getUserData->fetchAll(PDO::FETCH_ASSOC);
    	echo json_encode($userData);
  //   	echo "<pre>";
		// echo print_r($userData, true);
		// echo "</pre>";
    }
?>