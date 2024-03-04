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

// Обработка данных из формы и добавление их в базу данных
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fio = isset($_POST["offer-user-name"]) ? $_POST["offer-user-name"] : null;
    $job = isset($_POST["offer-job"]) ? $_POST["offer-job"] : null;
    $priceOption = isset($_POST["offer-select"]) ? $_POST["offer-select"] : null;
    $dateFrom = isset($_POST["offer-before-date"]) ? $_POST["offer-before-date"] : null;
    $dateTo = isset($_POST["offer-after-date"]) ? $_POST["offer-after-date"] : null;
    $phoneNumber = isset($_POST["offer-contact"]) ? $_POST["offer-contact"] : null;

    // Проверка, что переменная FullName не пуста или NULL
    if ($fio !== null && $fio !== '') {
        $sql = "INSERT INTO Zakaz (FullName, Job, Oplata, Data1, Data2, namber) VALUES ('$fio', '$job', '$priceOption', '$dateFrom', '$dateTo', '$phoneNumber')";

        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
            exit();
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Ошибка: Поле 'FullName' не может быть пустым.";
    }
}

// Закрываем соединение с базой данных
$conn->close();
?>
