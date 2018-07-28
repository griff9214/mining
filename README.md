# Лендинг для майнинг-отеля

Лендинг для майнинг-отеля. Использованные технологии:

  - SASS
  - JS
  - PHP
  - NPM
  - [Gulp]
  - [Composer]

# Описание

Простой лендинг, адаптированный под разные разрешения экрана. Имеется функция оформления заявки он-лайн и отправки на почту администратора с использованием библиотеки [phpMailer]

### Установка на сервер

Потребуется [Node.js](https://nodejs.org/), [NPM](https://www.npmjs.com/), [Composer].

Для начала необходимо установить все NPM пакеты.

```sh
$ npm install
```

Composer подгрузит класс [phpMailer]

```sh
$ composer install
```

Для сборки лендинга необходимо запустить Gulp-task

```sh
$ gulp build
```
Собранный лендинг откажется в папке /dist. Для корректной работы необходимо перенести содержимое папки /dist и папку /vendor в корень Вашего сайта.

### Настройки

Для того, чтобы работала отправка писем необходимо произвести настройки в файле mailer.php под свой почтовый сервер. [Подробнее в WIKI phpMailer](https://github.com/PHPMailer/PHPMailer/wiki/Tutorial#first-time).



   [phpMailer]: <https://github.com/PHPMailer/PHPMailer>
   [Gulp]: <http://gulpjs.com>
   [Composer]: <https://getcomposer.org/>
