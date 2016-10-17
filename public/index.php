<?php

// web/index.php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

/*$app->get('/hello/{name}', function ($name) use ($app) {
    return 'Hello '.$app->escape($name);
});*/

$app->register(new Silex\Provider\TwigServiceProvider, [
    'twig.path' => __DIR__ . '/../views'
]);

$app->register(new Silex\Provider\DoctrineServiceProvider, [
    'db.options' => [
      'driver' => 'pdo_mysql',
      'host' => 'localhost',
      'dbname' => 'silex',
      'user' => 'root',
      'password' => 'root',
      'charset' => 'utf8'
    ]
]);

$app->register(new AI\Providers\UploadCareProvider);

$app->get('/', function() use ($app) {
  $images = $app['db']->prepare("SELECT * from images");
  $images->execute();
  $images = $images->fetchAll(\PDO::FETCH_CLASS, \AI\Models\Image::class);
  //var_dump($images);
  return $app['twig']->render('home.twig');
});

$app->run();
