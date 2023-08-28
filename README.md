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

Статус квартиры :

        0 => 'Акция',
        1 => 'Перепродажа',
        2 => 'Бронь',
        3 => 'Продажи закрыты',
        4 => 'В продаже',

Застройщик: 
фото (айди категории): 

- 0 - 3D рендеры, 
- 1 - Инфраструктура,
- 2 - Дизайн,
- 3 - Ход строительсва

Статус модерации (active) :

- 0 - На модерации
- 1 - Не прошел модерацию
- 2 - Опубликован


## Api (token - 6f8be2a8db029ec86bd40833acbbd0c5) - старый single (заменен на jwt)
## jwt token после успешного логина, меняется каждый раз (token) 

Не используется изменение версий, статичный /api (Заголовок апи используется для указания директории после /api/)

Методы: 

### House 

Получить все ЖК \ 
path getHousesJk (новостройки) \ [get] / :

- limit (true\false) - для получения 30 обьектов
- token

Получить все Виллы \
path getHousesVillages (виллы) \ [get] / :

- limit (true\false) - для получения 30 обьектов
- token

Поиск по обьектам \
path search \ [post] / поля:

- title - введенное в поле

Получить жк по Слагу \ 
path getHouseApi \ [post] / поля:

- slug - слаг жк 

Получить ЖК пользователя \
path getHouseForUserApi \ [post] / поля:

- token - токен
- user_id - айди юзера

Создание ЖК и его характеристики \
path create \ [post] / поля: 

- user_id - айди пользователя
- title - Название ЖК
- description - Описание ЖК (RU)
- description_en - Описание ЖК (EN)
- description_tr - Описание ЖК (TR)
- city - Город
- area - Район
- longitude - Долгота
- latitude - Широта
- percent - Процент
- comment - Комментарий
- active - * не передаем
- created - срок сдачи
- fool_price - рассрочка*
- statusHouse - Статус
- floors - Этажи
- type - тип ЖК
- dop - Доп.услуги - массив из названий
- info - Инфраструктуры - массив из названий
- toSea - до моря
- toSchool - до школы
- toShop - до магазина
- toPark - до парка
- toBus - до остановки
- count_flat - кол-во стояков
- exclusive - эксклюзив для агенств
- toChildrenSchool - до дет.сада
- token

Редактирование ЖК и его характеристики \
path editHouse \ [post] / поля: 

- house_id - айди ЖК
- title - Название ЖК
- description - Описание ЖК (RU)
- description_en - Описание ЖК (EN)
- description_tr - Описание ЖК (TR)
- city - Город
- area - Район
- longitude - Долгота
- latitude - Широта
- percent - Процент
- comment - Комментарий
- active - * не передаем
- created - срок сдачи
- fool_price - рассрочка*
- statusHouse - Статус
- floors - Этажи
- type - тип ЖК
- dop - Доп.услуги - массив из названий
- info - Инфраструктуры - массив из названий
- toSea - до моря
- toSchool - до школы
- toShop - до магазина
- toPark - до парка
- toBus - до остановки
- count_flat - кол-во стояков
- exclusive - эксклюзив для агенств
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

Редактирование саппортов для ЖК \
path editSupport \ [post] / поля:

- id - айди
- avatar - Изображение
- name - Имя
- phone - Телефон
- email - Емеил
- status - Должность
- link - Ссылка на соц.сеть
- token

Удаление саппорт для ЖК \
path deleteSupport \ [post] / поля:

- id - айди саппорта
- token

Получение ЖК по ид \
path get \ [post] / поля:

-id
-token

Добавление корпуса \
path createFrame \ [post] / поля:

- house_id - айди жк
- name - Название
- token

Редактирование корпуса \
path editFrame \ [post] / поля:

- frame_id - айди корпуса
- house_id - айди хауса
- name - Название
- token

Удаление корпуса (+ квартиры и изображения) \
path deleteFrame \ [post] / поля:

- frame_id - айди корпуса
- token

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
- token

Редактировани квартиры \
path editFlat \ [post] / поля:

- flat_id - айди квартиры
- house_id - айди жк
- number - Номер
- square - Площадь
- count - Планировка
- floor - Этаж
- status - Статус
- stairs - Номер от лестницы
- price - Цена
- image_up - верхнее изображение (category = 0)
- image_down - нижнее изображение (category = 1)
- token

Редактирование статуса квартиры \ 
path editStatusFlat \ [post] / поля:

- flat_id - айди кв
- house_id - айди дома
- status - статус
- token 

Удаление квартиры (+ изображения) \
path deletedFlat \ [post] / поля:

- flat_id - айди квартиры
- token

Изменение статуса видимости (скрыть) \
path setVisible \ [post] / поля:

- house_id - айди ЖК
- visible - true\false - отображение\скрытие
- token

Удаление ЖК и всех связей \ 
path delete \ [post] / поля:

- house_id - айди жк
- token 

Добавления изображений к обьекту ЖК \
path addedImages \ [post] / поля:

- image - изображение
- house_id - айди ЖК
- category - айди категории (всего 4)
- token

Удаление изображение у ЖК \
path deletedImage \ [post] / поля:

- image_name - название изображения
- house_id - айди жк
- token

Добавление файлов к обьекту ЖК) \
path addedFiles \ [post] / поля:

- file - файл
- house_id - айди ЖК
- token

Удаление файла у обьекта ЖК \
path deletedFile \ [post] / поля:

- fileName - Название
- house_id - Айди ЖК
- token

### News

Получить все новости \
path getAllNews \ [get] / нет полей: 

- 

Получить все новости Админа \
path getAllNewsAdmin \ [get] / нет полей:

-

Получить все новости юзера \
path getAllNewsForUser \ [post] / поля:

- user_id - айди Юзера

Получить носоть \
path getNew \ [post] / поля:

- new_id - айди Новости

Добавление новости \
path add \ [post] / поля:

- house_id - Айди ЖК
- title - Заголовок
- description - Описание
- visible - true (Не передаем)

Редактирование новости \
path edit \ [post] / поля:

- house_id - Айди ЖК
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

Получить подборки юзера \
path getAll \ [post] / поля:

- user_id - Айди юзера

Получить одну подборку \
path get \ [post] / поля:

- id - Айди подборки

Создание подборки \
path create \ [post] / поля:

- user_id - Айди юзера
- title - Заголовок
- description - Комментарий
- isVisible - Показывать местоположение (true\false) - default false

Редактирование подборки \
path edit \ [post] / поля:

- id - айди подборки
- user_id - Юзер Айди
- title - Заголовок
- description - Комментарий
- isVisible - Показывать местоположение (true\false) - default false

Добавление обьекта в подборку \
path addHouse \ [post] / поля:

- compilation_id - Айди подборки
- house_id - Айди ЖК
- description - коммент
- token

Удаление жк из подборки \
path deleteHouse \ [post] / поля:

- token - токен
- compilation_id - айди подборки
- house_id - айди жк

Удаление подборки \
path delete \ [post] / поля:

- id - Айди подборки
- token

### Favorite

Получить избранные \
path getAll \ [get] / нет полей:

-

Добавление в избранное \
path add \ [post] / поля:

- user_id - Айди пользователя
- house_id - Айди ЖК
- token

Удаление из избранного \
path deleted \ [post] / поля:

- house_id - Айди жк
- user_id - Айди пользователя

### Notification

Удаление оповещения \ 
path delete \ [post] / поля:

- id - Айди уведомления

Получить уведомления \ 
path get \ [get] / поля:

not param

### Chat

Проверить наличие чата (создать при отсутсвии) \
path getOrCreateChat \ [post] / поля:

- from - для кого (айди)
- to - от кого (айди)

Вернется обьект чата

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

Получить все чаты (Обект сообщений уже сгруппирован и отсортирован)\
path getChatsApi \ [post] / поля: 

- user_id - айди юзера
- token - токен

Получить чат (Обьект сообщений уже сгруппирован) \
path getChatApi \ [post] / поля:

- chat_id - айди выбраного чата
- token - токен

### User 

Получения пользователя \
path get \ [post] / поля:

- token

Удаление аккаунта \
path deleteAccount \ [post] / поля:

- token
- user_id

Ошибка 205 при входе, означает что удален

Изменения статуса ссылки \
path setLink \ [post] / поля:

- token
- id - айди подписки

Регистрация пользователя \
path sendRegister \ [post] / поля:

- first_name - первое имя
- last_name - фамилия
- phone - телефон
- email - емеил
- language_id - (
    0 - русский
    1 - английский
    2 - турецкий
)
- type - место работы

Авторизация пользователя \
path login \ [post] / поля:

- email - если есть (застройщик)
- phone - если есть (риелтор)
- password - пароль (застройщик)

Для риелтора смс-код после token
Возврат token - 200 or 401 with status error

Обновление бесплатной ссылки \
path setLink \ [post] / поля:

- id - айди подписки
- token

Проверка юзера по емейлу (кроме риелтора)\
path email \ [post] / поля:

- email - емеил юзер

Статусы возврата:

401 - нет токена \
405 - нет пользователя \
200 - true 

Проверка юезра по телефону и отправка ему кода (только риелтор)\
path sendCode \ [post] / поля:

- email - email введенный пользователем

Статусы возврата: 

401 - нет токена \
405 - нет пользователя \
200 - true 

Ввод кода и отправка на проверку /
path loginSms \ [post] / поля:

- email - Email
- code - код

401 - не авторизован
200 - токен

Редактирование пользователя / 
path edit \ [post] / поля:

- user_id - Айди юзера
- first_name - Имя
- last_name - Фамилия
- status (Риелтор) - должность
- link (Риелтор) - соц.сеть
- description (Риелтор) - описание
- image (Риелтор) - Изображение
- email - емаил

Добавить компанию /
path addedCompany \ [post] / поля:

- user_id - айди юзера
- title - Название
- image - Иконка
- banner - баннер

Редактирование компании /
path editCompany \ [post] / поля:

- id - айди компании
- user_id - айди юзера 
- title - название
- image - иконка
- banner - баннер 

Подписка по тарифу / 
path payment \ [post] / поля: 

- type - айди подписки
- price - цена
- email

## Info 

Получить инфраструктуры /
path getInfo \ [get] 

Получить все допы /
path getDop \ [get]

Получить все городы и районы /
path getCity \ [get]

## Client

Получить всех клиентов /
path get \ [get]

- user_id - айди юзера

Добавить клиента /
path send \ [post]

- user_id - айди юзера
- name - имя клиента
- phone - телефон
- soc - соц.сеть
- client_text - текст клиента
- isJk - определился\нет (0-1)
- target_buy - Цель покупки
- date_travel - Дата приезжда
- buy_form_id - Айди формы оплаты (0 - наличные, 1 - безналичные, 2 - рассрочка)
- status_client - статус клиента:

              0 => 'Новая заявка',
              1 => 'В работе с партнером',
              2 => 'Бронь',
              3 => 'Оформление',
              4 => 'Сделка завершена',

- comment - коммен
- token - токен

Редактировать клиента /
path edit \ [post]

- client_id - айди клиента
- user_id - айди юзера
- name - имя клиента
- phone - телефон
- soc - соц.сеть
- client_text - текст клиента
- isJk - определился\нет (0-1)
- target_buy - Цель покупки
- date_travel - Дата приезжда
- buy_form_id - Айди формы оплаты (0 - наличные, 1 - безналичные, 2 - рассрочка)
- status_client - статус клиента:

              0 => 'Новая заявка',
              1 => 'В работе с партнером',
              2 => 'Бронь',
              3 => 'Оформление',
              4 => 'Сделка завершена',

- comment - коммен
- token - токен

Удалить клиента /
path delete \ [post] 

- client_id - айди клиента
- user_id - айди пользователя
- token - токен
