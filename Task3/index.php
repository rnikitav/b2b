<?php

use App\entities\Post;
use App\services\Autoloader;

include dirname(__DIR__) . '/Task3/services/Autoloader.php';
spl_autoload_register([(new Autoloader()), 'loadClass']);

$postRepo = new PostRepository();
$userRepo = new UserRepository();
// Создать новый пост от юзера
$post = new Post();
$userId = 1;
$user = $userRepo->getOneById($userId);
$post->author = $user->name;
$user = $postRepo->save($post);

//Получить автора статьи
$postId = 1;
$post = $postRepo->getOneById($postId);
echo $post->author;


//Получить все статьи пользователя
$user = $userRepo->getOneById($userId);
$posts = $postRepo->getAllPostsByUserId($user->id);

//Изменить автора статьи
$post = $postRepo->getOneById($postId);
$post->author = 'Example';
$postRepo->save($post);

