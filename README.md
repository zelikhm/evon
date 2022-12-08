<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Карта запуска проекта 

    - git pull
    - composer update
    - npm i && npm update
    - php artisan migrate

Периодический запуск команды: php artisan migrate

# О проекте, используетя полу-рест \ полу-сср - realtime-chat (help with pusher technology)

Пользователи разделяются на 4 роли:

- 0 - realtor, (риелтор) 
- 1 - builder, (застройщик)
- 2 - moderator, (модератор)
- 3 - admin (админ)

Застройщик: 
фото (айди категории): 

- 0 - 3D рендеры, 
- 1 - Инфраструктура,
- 2 - Дизайн,
- 3 - Ход строительсва


## Api (token - 6f8be2a8db029ec86bd40833acbbd0c5)

Не используется изменение версий, статичный /api (Заголовок апи используется для указания директории после /api/)

Методы: 

### House 

Создание ЖК и его характеристики \
path create \ [post] / поля: 

- user_id - айди пользователя
- title - Название ЖК
- description - Описание ЖК
- city - Город
- area - Район
- longitude - Долгота
- latitude - Широта
- percent - Процент
- comment - Комментарий
- active - * не передаем
- status - * не передаем
- statusHouse - Статус
- floors - Этажи
- type - тип ЖК
- dop - Доп.услуги
- info - Инфраструктуры
- toSea - до моря
- toSchool - до школы
- toShop - до магазина
- toPark - до парка
- toChildrenSchool - до дет.сада

Добавление саппортов для ЖК \
path addedSupport \ [post] / поля:

- house_id - айди ЖК
- avatar - Изображение
- name - Имя
- phone - Телефон
- email - Емеил
- status - Должность
- link - Ссылка на соц.сеть


