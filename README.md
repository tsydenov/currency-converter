# Конвертер валют на основе курсов ЦБ РФ  
- Данные берутся по ссылке http://www.cbr.ru/scripts/XML_daily.asp
- Курсы валют хранятся в БД
- Для доступа к конвертеру требуется аутентификация
- Команда `console app:update-rates` обновляет курсы

## Запуск  
Для запуска потребуются: Composer, Symfony CLI, Docker-compose  
Выполните:  
1. `composer install`
2. `docker-compose up -d`
3. `symfony console doctrine:migrations:migrate`
4. `symfony console doctrine:fixtures:load`
5. `symfony server:start`
