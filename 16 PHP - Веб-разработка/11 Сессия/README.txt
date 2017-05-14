Реализуйте аутентификацию на сайте на основе nickname.

src/App/Session.php
Реализуйте класс Session в соответствии с интерфейсом SessionInterface;

public/index.php
Реализуйте следующие обработчики:

Форма для входа: get -> /session/new
Обработка формы: post -> /session.
Выход: delete -> /session.
Если обработка успешна, то делаем перенаправление на /.