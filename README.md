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
- fool_price - рассрочка*
- statusHouse - Статус
- floors - Этажи
- type - тип ЖК
- dop - Доп.услуги - массив из названий
- info - Инфраструктуры - массив из названий
- image - изображение
- toSea - до моря
- toSchool - до школы
- toShop - до магазина
- toPark - до парка
- toBus - до остановки
- toChildrenSchool - до дет.сада
- token

Добавление саппортов для ЖК \
path addedSupport \ [post] / поля:

- house_id - айди ЖК
- avatar - Изображение
- name - Имя
- phone - Телефон
- email - Емеил
- status - Должность
- link - Ссылка на соц.сеть
- token

Получение ЖК по ид \
path get \ [post] / поля:

-id
-token

Добавление корпуса \
path createFrame \ [post] / поля:

- house_id - айди жк
- name - Название

Добавление квартиры \
path createFlat \ [post] / поля:

- frame_id - айди корпуса
- number - Номер
- square - Площадь
- count - Планировка
- floor - Этаж
- status - Статус
- stairs - Номер от лестницы
- price - Цена
- image_up - верхнее изображение (category = 0)
- image_down - нижнее изображение (category = 1)

Удаление ЖК и всех связей \ 
path delete \ [post] / поля:

- house_id - айди жк

Добавления изображений к обьекту ЖК \
path addedImages \ [post] / поля:

- image - изображение
- house_id - айди ЖК
- category - айди категории (всего 4)

### News

Добавление новости \
path add \ [post] / поля:

- house_id - Айди ЖК
- title - Заголовок
- description - Описание
- visible - true (Не передаем)

Редактирование новости \
path edit \ [post] / поля:

- new_id - Айди новости
- title - Заголовок
- description - Описание

Удаление новости \
path delete \ [post] / поля:

- new_id - Айди новости

Изменение видимости новости \
path visible \ [post] / поля:

- new_id - Айди новости
- visible - false\true

### Compilation

Создание подборки \
path create \ [post] / поля:

- user_id - Айди юзера
- title - Заголовок
- description - Комментарий
- isVisible - Показывать местоположение (true\false) - default false

Добавление обьекта в подборку \
path addHouse \ [post] / поля:

- compilation_id - Айди подборки
- house_id - Айди ЖК
- token

Удаление подборки \
path delete \ [post] / поля:

- id - Айди подборки
- token

### Favorite

Добавление в избранное \
path add \ [post] / поля:

- user_id - Айди пользователя
- house_id - Айди ЖК
- token

### Notification

Удаление оповещения \ 
path delete \ [post] / поля:

- id - Айди уведомления

Получить уведомления \ 
path get \ [get] / поля:

not param

### Chat

Отправить сообщение \
path message \ [post] / поля:

- user_id - Айди кому отправляем
- chat_id - Айди чата
- message - Сообщение любой длины
- token

Обновить чаты \
path reloadChats \ [post] / поля:

- token

Обновить чат \
path reloadChat \ [post] / поля:

- token
- id

### User 

Проверка юзера по емейлу (кроме риелтора)\
path email \ [post] / поля:

- email - емеил юзер

Статусы возврата:

401 - нет токена \
405 - нет пользователя \
200 - true 

Проверка юезра по телефону и отправка ему кода (только риелтор)\
path phone \ [post] / поля:

- phone - телефон введенный пользователем

Статусы возврата: 

401 - нет токена \
405 - нет пользователя \
200 - true 

Ввод кода и отправка на проверку /

