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
    
    if (array_key_exists('user', $_FILES)) {
        error_log(print_r($_FILES, true));
        $key = 'avatar';
        $errorCode = $_FILES['user']['error'][$key];
        if ($errorCode !== UPLOAD_ERR_NO_FILE) {
            if ($errorCode !== UPLOAD_ERR_OK) {
                $errors['avatar'] = codeToMessage($errorCode);
            } else {
                $tmpName = $_FILES['user']['tmp_name'][$key];
                $name = $_FILES['user']['name'][$key];
                $newName = 'images' . DIRECTORY_SEPARATOR . $name;
                
                if (!move_uploaded_file($tmpName, $newName)) {
                    $errors['avatar'] = 'Something was wrong';
                } else {
                    $user['avatar'] = $name;
                }
            }
        }
    }
    
    error_log(print_r($_FILES, true));
    
    if (empty($errors)) {
        $repository->insert($user);
        
        return response()->redirect('/');
    } else {
        return response(render('/users/new', ['user' => $user, 'errors' => $errors]))
                ->withStatus(422);
    }
});

$app->run();