<?php

namespace App;

use function App\response;
use function App\Renderer\render;

require_once '/composer/vendor/autoload.php';

$opt = array(
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
);

$newCar = [
    'pictures' => [],
    'model' => ''
];

$pdo = new \PDO('sqlite:/var/tmp/db.sqlite', null, null, $opt);
$repository = new CarRepository($pdo);

$app = new Application();

$app->get('/', function () use ($repository) {
    $cars = $repository->all();
    return response(render('index', ['cars' => $cars]));
});

$app->get('/cars/new', function ($meta, $params, $attributes) use ($newCar) {
    return response(render('cars/new', ['car' => $newCar, 'errors' => []]));
});

$app->post('/cars', function ($meta, $params, $attributes) use ($repository) {
    $car = $params['car'];
    $pictures = [];
    $errors = [];

    if (!$car['model']) {
        $errors['model'] = "Model can't be blank";
    }

    // BEGIN (write your solution here)
    if (array_key_exists('car', $_FILES)) {
        $key = 'pictures';
        $files = $_FILES['car'];
        foreach ($files['error'][$key] as $errorCode) {
            if ($errorCode !== UPLOAD_ERR_OK && $errorCode !== UPLOAD_ERR_NO_FILE) {
                $errors[$key] = 'Something was wrong';
            }
        }

        if (!array_key_exists($key, $errors)) {
            foreach ($files['tmp_name'][$key] as $index => $tmpName) {
                if ($files['error'][$key][$index] === UPLOAD_ERR_NO_FILE) {
                    continue;
                }
                $newName = __DIR__ . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . basename($tmpName);
                if (move_uploaded_file($tmpName, $newName)) {
                    $pictures[] = ['name' => basename($tmpName)];
                } else {
                    $errors[$key] = 'Something was wrong';
                }
            }
        }
    }
    // END

    if (empty($errors)) {
        $repository->insert($car, $pictures);
        return response()->redirect('/');
    } else {
        return response(render('cars/new', ['car' => $car, 'errors' => $errors]))
            ->withStatus(422);
    }
});

$app->run();
