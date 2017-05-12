<?php

/**
 * Для формирования ответа очень часто использую специальный Response Builder, 
 * который накапливает в себе данные, которые должны быть отправлены клиенту. 
 * Это такие данные, как статус, различные заголовки и тело ответа.
 * 
 * В данном упражнении необходимо реализовать интерфейс ResponseInterface в классе Response, 
 * описав логику накопления данных ответа, 
 * а так же реализовать логику разбора и отправки этих данных клиенту в классе Application.
 * 
 * Пример использования Response Builder:
 * 
 * <?php
 * 
 * $app->get('/', function () {
 *     return response(render('index'));
 * });
 * 
 * $app->post('/users', function ($meta, $params, $attributes) use ($users) {
 *     if (!isset($params['email'])) {
 *         return response('Expected email')->withStatus(400);
 *     }
 *     return response()->redirect('/');
 * });
 * 
 * src/App/Response.php
 * Реализуйте интерфейс ResponseInterface в классе Response.
 * 
 * src/App/Application.php
 * Реализуйте логику отправки ответа клиенту. 
 * Сначала необходимо извлечь и отправить статус, 
 * затем отправить все заголовки и в конце тело ответа, если оно есть.
 */

