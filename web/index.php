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



// FR WEBSITE
$app->get('/home', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig');
});

$app->get('/history', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('history.twig');
});

$app->get('/witnesses', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('witnesses.twig');
});

$app->get('/presents', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('presents.twig');
});

$app->get('/presence', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('presence.twig');
});

//org
$app->get('/organisation', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('organisation.twig');
});

$app->get('/org/info', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('info.twig');
});

$app->get('/org/program', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('program.twig');
});

$app->get('/org/trips', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('trips.twig');
});

//comment
$app->post('/likeComment', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  $commentId = $_POST['id'];
  $commentLikes = $_POST['like'];
  $updateLikes = $app['pdo']->prepare('UPDATE comments SET likes = :likes WHERE id = :id');
  $updateLikes->execute([
    'likes' => ++$commentLikes,
    'id' => $commentId,
  ]);
  // header('Location: /comment');
  // redirect to the anchor of the liked comment;
  $commentsStatement = $app['pdo']->prepare('SELECT *, TO_CHAR(comments.date, \'DD Mon\') AS comment_date FROM comments LIMIT 50');
  $commentsStatement->execute();

  $comments = array();
  while ($row = $commentsStatement->fetch(PDO::FETCH_ASSOC)) {
    $app['monolog']->addDebug('Row ' . $row['id']);
    $comments[] = $row;
  }

  return $app['twig']->render('comments.twig', array(
    'comments' => $comments
  ));
  return $app['twig']->render('comments.twig');
});


// BR website
$app->get('/br/home', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('br/index.twig');
});

$app->get('/br/history', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('br/history.twig');
});

$app->get('/br/witnesses', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('br/witnesses.twig');
});

$app->get('/br/organisation', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('br/organisation.twig');
});

$app->get('/br/org/info', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('br/info.twig');
});

$app->get('/br/org/program', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('br/program.twig');
});

$app->get('/br/org/trips', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('br/trips.twig');
});

$app->get('/br/presents', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('br/presents.twig');
});

$app->get('/br/presence', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('br/presence.twig');
});

$app->get('/br/comment', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('br/comment.twig');
});



// ACCESS TO DB
// $app->get('/db/', function() use($app) {
//   $st = $app['pdo']->prepare('SELECT name FROM test_table');
//   $st->execute();

//   $names = array();
//   while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
//     $app['monolog']->addDebug('Row ' . $row['name']);
//     $names[] = $row;
//   }

//   return $app['twig']->render('database.twig', array(
//     'names' => $names
//   ));
// });



// ACCESS TO COMMENT
$app->get('/comment', function() use($app) {
  $commentsStatement = $app['pdo']->prepare('SELECT *, TO_CHAR(comments.date, \'DD Mon\') AS comment_date FROM comments LIMIT 50');
  $commentsStatement->execute();

  $comments = array();
  while ($row = $commentsStatement->fetch(PDO::FETCH_ASSOC)) {
    $app['monolog']->addDebug('Row ' . $row['id']);
    $comments[] = $row;
  }

  return $app['twig']->render('comments.twig', array(
    'comments' => $comments
  ));
});



// RUN THE WEBSITE
$app->run();
