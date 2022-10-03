<?php

require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

$dbopts = parse_url(getenv('DATABASE_URL'));
$app->register(
  new Csanquer\Silex\PdoServiceProvider\Provider\PDOServiceProvider('pdo'),
  array(
    'pdo.server' => array(
      'driver'   => 'pgsql',
      'user' => $dbopts["user"],
      'password' => $dbopts["pass"],
      'host' => $dbopts["host"],
      'port' => $dbopts["port"],
      'dbname' => ltrim($dbopts["path"], '/')
    )
  )
);

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Register view rendering
$app->register(new Silex\Provider\TwigServiceProvider(), array(
  'twig.path' => __DIR__ . '/views',
));



// WEB HANDLERS
// Home page
$app->get('/', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig');
});

// FR website
$app->get('/home', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig');
});

$app->get('/history', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('history.twig');
});

$app->get('/organisation', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('organisation.twig');
});

$app->get('/witnesses', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('witnesses.twig');
});

// BR website
$app->get('/br/home', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig');
});

$app->get('/br/history', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('history.twig');
});

$app->get('/br/organisation', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('organisation.twig');
});

$app->get('/br/witnesses', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('witnesses.twig');
});



// Access to DB
$app->get('/db/', function() use($app) {
  $st = $app['pdo']->prepare('SELECT name FROM test_table');
  $st->execute();

  $names = array();
  while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
    $app['monolog']->addDebug('Row ' . $row['name']);
    $names[] = $row;
  }

  return $app['twig']->render('database.twig', array(
    'names' => $names
  ));
});

$app->run();
