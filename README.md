# Пошаговая инструкция для разворачивания проекта

Для начала клонируем сам проект в любое место, в примере создается папка task-todo.

```
git clone https://github.com/safo4eg/bothub-native-php.git bothub
```


## Первый раз поднимаем контейнеры

Поднимаем контейнеры из корня с файлом docker-compose.yml

```
docker compose up -d --build
```

## Создаем .env из .env.example (все настройки там уже написаны)

Выполняем копирование

```
cp .env.example .env
```

## Подключение к контейнеру с php

Для того чтобы выполнить необходимые команды для работы приложения, нужно подключиться
к контейнеру bothub-app через bash-оболочку

```
docker exec -it bothub_app bash
```

## Ставим необходимые зависимости, выполняем миграции, устанавливаем вебхук

Все эти команды выполняются последовательно внутри контейнера bothub-app

```
composer install
```

```
php console.php migrate
```

```
php console.php webhook:set https://bothub-bot.ru.tuna.am/api/webhook
```

## Проверяем работу бота

Копируем username бота и ищем его в поиске телеграм клиента.

```
@bothub11_bot
```
