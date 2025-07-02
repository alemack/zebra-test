

````markdown
# Zebra Test (Тестовое задание)

## Описание

Сервис управления тендерами: создание, хранение и получение тендеров через REST API.  
Реализовано на Laravel 10+, PHP 8.2, база данных — MySQL/PostgreSQL.  
Поддерживается авторизация по токену (Laravel Sanctum), импорт данных из CSV, запуск в Docker.

---

## Запуск проекта

### 1. Клонируй репозиторий

```bash
git clone https://github.com/alemack/zebra-test.git
cd zebra-test
````

### 2. Подготовь .env

```bash
cp .env.example .env
```

Измени параметры подключения к БД при необходимости.

### 3. Собери и запусти контейнеры

```bash
docker-compose up --build -d
```

*API будет доступен на [http://localhost:8000/api/](http://localhost:8000/api/)*

### 4. Применить миграции и импортировать тендеры

```bash
docker-compose exec app php artisan migrate
docker-compose exec app php artisan import:tenders
```

CSV-файл для импорта — **storage/app/test\_task\_data.csv**

---

## Используемые технологии

* PHP 8.2
* Laravel 10+
* MySQL 8 (или PostgreSQL)
* Docker, docker-compose
* Laravel Sanctum (токен-авторизация)

---

## Основные возможности

* **POST /api/register** — регистрация пользователя
* **POST /api/login** — вход (получение токена)
* **POST /api/logout** — выход (требует токен)
* **GET /api/user** — инфо о пользователе (требует токен)
* **POST /api/tenders** — создать тендер (требует токен)
* **GET /api/tenders** — список тендеров (поддерживает фильтры name/date)
* **GET /api/tenders/{id}** — тендер по ID

---

## Авторизация

Для защищённых методов (маршруты с пометкой *требует токен*) нужно передавать заголовок:

```
Authorization: Bearer {token}
```

---

## Импорт данных

CSV-файл — положи в `storage/app/test_task_data.csv`
Запусти:

```bash
docker-compose exec app php artisan import:tenders
```

---

## Тестирование API

* В проекте есть коллекция Postman (`postman_collection.json`) — её можно импортировать для ручной проверки всех маршрутов.
* Для автоматических тестов запусти:

  ```bash
  docker-compose exec app php artisan test
  ```

---

## Документация API

Подробная OpenAPI/Swagger документация — см. файл [`docs/openapi.yaml`](docs/openapi.yaml).
Можно просмотреть, например, на [https://editor.swagger.io/](https://editor.swagger.io/)

---

## Примечания

* Код полностью написан самостоятельно, без использования чужих репозиториев/форков.
* Весь функционал, аутентификация и фильтрация покрыты тестами.
* При возникновении вопросов — все параметры и настройки подробно комментированы в коде.

---

## Контакты

*Макеенко Александр*
[aleks.mackeencko@yandex.ru](mailto:aleks.mackeencko@yandex.ru)

