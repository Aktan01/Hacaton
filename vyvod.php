<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BazaFrilans";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получение текущей даты
$currentDate = date("Y-m-d");

// SQL-запрос для удаления записей, у которых $data2 равно или прошло текущую дату
$sql = "DELETE FROM Zakaz WHERE Data2 <= '$currentDate'";

if ($conn->query($sql) === TRUE) {
    
} else {
    echo "Ошибка при удалении записей: " . $conn->error;
}

// Закрываем соединение с базой данных
$conn->close();
?>

