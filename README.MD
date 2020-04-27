# Проект укорачивания ссылок

Проект укорачивания ссылок

### Цель

Создание простого сервиса коротких ссылок

### Реализация

На связке symfony4 + mariadb (дамп: db/dump.sql) реализован проект укорачивания ссылок. 
Создано два метода контроллера, 

один - ApiShortController

POST /api/short - принимает JSON напр. {url: "http://ya.ru"}, отдаёт JSON напр. {short: "YHF9»}

Второй - ApiRedirectController

GET, принимает запрос вида /api/redirect/{TOKEN}, обеспечивает редирект на изначальную ссылку.
````

