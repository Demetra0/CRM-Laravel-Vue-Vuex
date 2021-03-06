## О проекте

Требовалось разработать админ-панель для подтверждения анкеты пользователя.

## Используемый стек

Backend: Laravel 8</br>
DB: MySQL</br>
Frontend: Vue.js + Vuex, SCSS</br>
UI: BootstrapVue</br>

## Было реализовано

Админ панель - SPA</br>
Авторизация по JWT + Google 2FA</br>
Создание модели и миграции для нескольких таблиц БД, используя связи (relationships)</br>
Сиды (seeding) используя [randomuser.me] API для генерации 10-ти новых анкет пользователей.</br>
Задача (task scheduling) для генерации 1-ой новой анкеты, каждую минуту.</br>
Пагинация на странице Logs</br>
Тестирование регистрации (позже добавлю больше тестов)</br>

Также в ближайшее время планируется добавить веб-сокеты

### Деплой

1) composer install
2) переименуйте .env.example в .env
3) добавьте данные вашей DB
4) php artisan key:generate
5) php artisan migrate
6) php artisan jwt:secret
7) php artisan db:seed
8) php artisan serve</br></br>
9) На странице register необходимо зарегистрировать аккаунт
10) Далее отсканировать QR на экране приложением Google Authenticator
11) Войти в аккаунт
### Database
1) Таблица Users - менеджеры (связь один к одному с Manager Stories)
2) Таблица Manager Stories - история каждого менеджера
3) Таблица Profiles - анкеты пользователей 
 
### Страница Logs

По клику на имя анкеты менеджер переходит на страницу профиля, где может менять статус текущей анкеты
