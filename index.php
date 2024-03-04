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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/core.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <title>Document</title>
</head>

<body>
    <div class="wrapper">
        <header class="header">
            <div class="container">
                <div class="header-inner">
                    <div class="header-logo__link">
                        <div class="header-logo">
                            <img class="header-logo__images" src="images/logo-work.png" alt="logo-work">
                        </div>
                        <button class="header-btn">Работадателям</button>
                    </div>
                    <div class="talsu-logo">
                        <img src="images/logo-talsu.jpg" alt="talsu-images" class="talsu-images">
                    </div>
                </div>
            </div>
        </header>
        <section class="create-portfolio">
            <div class="container">
                <div class="create-portfolio">
                    <button class="create-portfolio__btn">Подать заявку</button>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="offer" id="offer-modal">
                <div class="offer__box">
                    <button class="offer-close-btn" id="close-offer-btn">
                        <svg width="23" height="25" viewBox="0 0 23 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2.09082 0.03125L22.9999 22.0294L20.909 24.2292L-8.73579e-05 2.23106L2.09082 0.03125Z"
                                fill="#333333" />
                            <path d="M0 22.0295L20.9091 0.0314368L23 2.23125L2.09091 24.2294L0 22.0295Z"
                                fill="#333333" />
                        </svg>
                    </button>
                    <form action="process_form.php" method="post">
                        <div class="offer-form-title">
                            <h2 class="offer-title">Работадателям</h2>
                            <input type="text" name="offer-user-name" class="offer-user-name offer-border"
                                placeholder="ФИО">
                            <input type="text" name="offer-job" class="offer-job offer-border" placeholder="Работа">
                            <input type="text" name="offer-select" class="offer-select offer-border" placeholder="Цена">

                            <div class="offer-date">
                                <input type="text" name="offer-before-date" id="offer-date-before"
                                    class="offer-before offer-border" placeholder="От">
                                <input type="text" name="offer-after-date" id="offer-date-after"
                                    class="offer-after offer-border" placeholder="До">
                            </div>
                            <input type="text" name="offer-contact" class="offer-contact offer-border"
                                placeholder=" Номер телефона">
                            <div class="offer-send-wrap">
                                <button type="submit" class="offer-send">Подать</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <section class="instruction" id="instruction-my__modal">
                <div class="instruction__box">
                    <button class="instruction-close-btn" id="close-instruction-btn">
                        <svg width="23" height="25" viewBox="0 0 23 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2.09082 0.03125L22.9999 22.0294L20.909 24.2292L-8.73579e-05 2.23106L2.09082 0.03125Z"
                                fill="#333333" />
                            <path d="M0 22.0295L20.9091 0.0314368L23 2.23125L2.09091 24.2294L0 22.0295Z"
                                fill="#333333" />
                        </svg>
                    </button>
                    <h2>Работадателям</h2>
                    <ol class="instruction-article">
                        <li>Создание Заявки:
                            - Нажмите кнопку "Создать Заявку".
                            - Укажите ФИО, описание работы, номер и цену.
                            - Нажмите "Создать". </li>
                        <li>Срок и Удаление:
                            - Если есть срок, укажите. Иначе заявка удалится через 24 часа.</li>
                        <li>Запрещенный контент
                            - Запрещены незаконные или аморальные заявки. </li>
                        <li>Отзывы и Рейтинг:
                            - Оцените исполнителя и оставьте отзыв после работы.
                        </li>
                        <li>Реклама и Спонсорство:
                            - Поддерживайте проект, рассматривая предложения о размещении рекламы. </li>
                        <li>Соблюдение правила:
                            - Соблюдайте правила сообщество при создании заявок.</li>
                    </ol>

                </div>
            </section>
        </div>
        <section class="search-work">
            <div class="container">
                <div class="search-work-portfolio">
                    <form class="form" id="searchForm">
                        <input type="text" class="form-input" name="search_query" placeholder=" Кого ищем?">
                        <button type="submit" class="form-search">
                            <ion-icon name="search"></ion-icon>
                        </button>
                    </form>
                    <div class="work-wrapper">
                        
                            <?php echo $htmlOutput; ?>
                            
                       
                    </div>
                </div>

            </div>
        </section>
        <button class="btn-open-to__speech">
            <ion-icon name="chatbox-outline"></ion-icon>
        </button>
        <section class="text-to-speech-modal" id="text-speech-my__modal">
            <div class="text-to-speech-modal__box">
                <button class="text-to-speech-modal-close-btn" id="close-text-to-speech-btn">
                    <svg width="23" height="25" viewBox="0 0 23 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.09082 0.03125L22.9999 22.0294L20.909 24.2292L-8.73579e-05 2.23106L2.09082 0.03125Z"
                            fill="#333333" />
                        <path d="M0 22.0295L20.9091 0.0314368L23 2.23125L2.09091 24.2294L0 22.0295Z" fill="#333333" />
                    </svg>
                </button>
                <div class="section-text-to-speech__inner">
                    <textarea id="text"></textarea>
                    <label for="speed">Speed</label>
                    <input type="number" name="spee" id="speed" min=".5" max="3" step=".5" value="1">
                    <div class="btn-speech-control">
                        <button id="play-button">Play</button>
                        <button id="pause-button">Pause</button>
                        <button id="stop-button">Stop</button>
                    </div>
                </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ru.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ru.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/app.js"></script>
</body>

</html>