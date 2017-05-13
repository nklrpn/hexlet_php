<?php

$opt = [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
];
$pdo = new \PDO('sqlite:db.sqlite', null, null, $opt);
$repository = new UserRepository($pdo);

$newUser = [
    'email' => '',
    'first_name' => '',
];

$app->get('/users', function () use ($repository) {
    $users = $repository->all();
    
    return response(render('users/index', ['users' => $users]));
});

$app->get('/users/new', function ($meta, $params, $attributes) use ($newUser) {
    return response(render('users/new', ['errors' => [], 'user' => $newUser]));
});

$app->post('/users', function ($meta, $params, $attributes) use ($repository) {
    $user = $params['user'];
    $errors = [];
    
    if (!$user['email']) {
        $errors['email'] = "Email can't be blank";
    } elseif (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email is not valid";
    }
    
    if (empty($errors)) {
        $repository->insert($user);
        
        return response()->redirect('/users');
    } else {
        return response(render('/users/new', ['user' => $user, 'errors' => $errors]))
                ->withStatus(422);
    }
});

$app->run();