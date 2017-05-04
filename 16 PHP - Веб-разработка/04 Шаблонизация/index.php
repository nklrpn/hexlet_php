<?php
/**
 * В нашем фреймворке шаблоны лежат в папке resources/views.
 * 
 * src/App/Template.php
 * Реализуйте функцию render, которая принимает абсолютный путь до шаблона и массив параметров, 
 * а возвращает готовый html.
 * 
 * src/App/Renderer.php
 * Реализуйте функцию render в нейсмпейсе App\Renderer. 
 * Она принимает на вход относительный путь до шаблона и параметры. 
 * Эта функция должна вычислять абсолютный путь к шаблону и 
 * вызывать функцию render шаблонизатора App\Template.
 * 
 * Пример использования:
 * 
 * <?php
 * use function App\Renderer\render;
 * $app = new Application();
 * $app->get('/', function () {
 *     return render('index');
 * });
 * $app->get('/about', function () {
 *     return render('about', [
 *         'site' => 'hexlet.io',
 *         'subprojects' => ['battle.hexlet.io', 'map.hexlet.io']
 *     ]);
 * });
 * $app->run();
 */

namespace App;

require '/composer/vendor/autoload.php';

use function App\Renderer\render;

$app = new Application();

$app->get('/', function () {
    return render('index');
});

$app->get('/about', function () {
    return render('about', ['site' => 'hexlet.io']);
});

$app->run();
