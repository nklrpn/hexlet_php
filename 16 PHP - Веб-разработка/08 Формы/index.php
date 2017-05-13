<?php

namespace App;

use function App\response;
use function App\Renderer\render;

require_once '/composer/vendor/autoload.php';

$opt = array(
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
);

$pdo = new \PDO('sqlite:/var/tmp/db.sqlite', null, null, $opt);
$repository = new CarRepository($pdo);

$app = new Application();

$app->get('/', function () use ($repository) {
    $cars = $repository->all();
    return response(render('index', ['cars' => $cars]));
});

// BEGIN (write your solution here)
$app->get('/cars/new', function ($meta, $params, $attributes) {
    return response(render('cars/new', ['errors' => []]));
});

$app->delete('/cars/:id', function ($meta, $params, $attributes) use ($repository) {
    $repository->delete($attributes['id']);
    return response()->redirect('/');
});

$app->post('/cars', function ($meta, $params, $attributes) use ($repository) {
    $car = $params['car'];
    $errors = [];

    if (!$car['model']) {
        $errors['model'] = "Model can't be blank";
    }

    if (empty($errors)) {
        $repository->insert($car);
        return response()->redirect('/');
    } else {
        return response(render('cars/new', ['car' => $car, 'errors' => $errors]))
            ->withStatus(422);
    }
});
// END

$app->run();
