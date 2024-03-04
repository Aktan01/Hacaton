document.addEventListener('DOMContentLoaded', function () {
    // Обработка отправки формы с помощью AJAX
    document.getElementById('searchForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Предотвратить отправку формы по умолчанию

        // Создание и настройка объекта XMLHttpRequest
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'search.php?' + new URLSearchParams(new FormData(this)).toString(), true);

        // Настройка обработчика события загрузки
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Получение элемента-контейнера
                var container = document.getElementById('searchResults');

                // Очистка текущих результатов
                container.innerHTML = '';

                // Парсинг полученного HTML
                var parser = new DOMParser();
                var responseDoc = parser.parseFromString(xhr.responseText, 'text/html');

                // Получение новых результатов
                var newResults = responseDoc.getElementById('searchResults').children;

                // Добавление новых результатов в контейнер
                for (var i = 0; i < newResults.length; i++) {
                    container.appendChild(newResults[i].cloneNode(true));
                }
            } else {
                console.error('Error:', xhr.statusText);
            }
        };

        // Настройка обработчика события ошибки
        xhr.onerror = function () {
            console.error('Request failed');
        };

        // Отправка запроса на сервер
        xhr.send();
    });
});
