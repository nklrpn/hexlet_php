 * Кроме get и post в http определено множество других глаголов. 
 * Например, для удаления — DELETE, а для частичного обновления — PATCH. 
 * Их поддерживают все распространенные веб-сервера, но, к сожалению, 
 * формы в html умеют делать отправку только get или post.
 * 
 * Фреймворки нашли выход из этой ситуации: при генерации форм (а их обычно не руками выводят) 
 * добавляют специальное hidden поле с именем _method и со значением, 
 * которое определяет глагол, например, delete. 
 * Дальше фреймворк внутри себя проверяет, 
 * если текущий метод POST и существует значение для _method то используем его как имя глагола. 
 * Таким образом у нас начинают работать такие конструкции:
 * 
 * <?php
 * 
 * $app->delete('/users/:id', function ($meta, $params, $attributes) {
 *     // тут удаляем пользователя
 *     return response()->redirect('/');
 * });
 * 
 * src/App/Application.php
 * Реализуйте логику определения $method на основе значения ключа _method из $_POST
 * 
 * public/index.php
 * Реализуйте следующие обработчики:
 * 
 * Форма создания машины: get -> /cars/new
 * Создание машины: post -> /cars
 * Удаление машины: delete -> /cars/:id
 * resources/views/cars/new.phtml
 * Реализуйте форму для создания машины