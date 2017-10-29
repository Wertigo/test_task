Тестовое задание
========================

Установка (все консольные команды подразумеваеют запуск из директории проекта):
1) Выполнить
```bash
composer install
```
2) Создать файл "parameters.yml" в директории "app/config/parameters.yml", скопировав в него содержимое файла "app/config/parameters.yml.dist" и задать параметры соответствующие вашей среде.
3) Применить миграции:
```bash
php bin\console doctrine:migrations:migrate
```
4) Настроить сервер RabbitMQ
5) Если использование RabbitMQ не предпологается - установить переменную use_rabbit_mq в значение "false", в файле "src/AppBundle/Resources/config/config.yml"
6) Запустить cлушателя очереди RabbitMQ: 
```bash
php bin/console rabbitmq:consumer send_notification
```