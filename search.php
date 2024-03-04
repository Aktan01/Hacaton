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

// Функция для генерации блока кода
function generateWorkBlock($job, $fullName, $oplata, $data1, $data2, $namber) {
    $output = '<div class="work-border">';
    $output .= '<div class="work-job">';
    $output .= '<h4 class="work-title">' . $job . '</h4>';
    $output .= '<span class="work-name">' . $fullName . '</span>';
    $output .= '<span class="work-price">Цена: ' . $oplata . '</span>';
    $output .= '<span class="work-date">Дата: ' . $data1 . ' - ' . $data2 . '</span>';
    $output .= '<span class="work-contact">Контакты: ' . $namber . '</span>';
    $output .= '</div>';
    $output .= '</div>';
    return $output;
}

// Получение значения из параметра запроса
$searchQuery = isset($_GET['search_query']) ? $_GET['search_query'] : '';

// SQL-запрос для поиска
$sql = "SELECT FullName, Job, Oplata, Data1, Data2, namber FROM Zakaz WHERE Job LIKE '%$searchQuery%'";

$result = $conn->query($sql);

// Вывод данных в HTML
$htmlOutput = '';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Ваш код для вывода данных
        $htmlOutput .= generateWorkBlock($row["Job"], $row["FullName"], $row["Oplata"], $row["Data1"], $row["Data2"], $row["namber"]);
    }
} else {
    $htmlOutput = "Нет данных, соответствующих запросу.";
}

// Закрываем соединение с базой данных
$conn->close();
?>