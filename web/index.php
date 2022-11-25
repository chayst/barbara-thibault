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
  $ipUser = $_SERVER['REMOTE_ADDR'];
  // $countryUser = geoip_country_code_by_name($ipUser);
  if (!isset($_COOKIE['CONNECTED_ONCE'])) {
    $cookie = false;
    setcookie(
      'CONNECTED_ONCE',
      $ipUser,
      [
          'expires' => time() + 365*24*3600,
          'secure' => true,
          'httponly' => true,
      ]
    );
  } else {
    $cookie = $_COOKIE['CONNECTED_ONCE'];
  }
  // if $ipUser include BR then render br/index
  return $app['twig']->render('index.twig', array(
    'cookie' => $cookie,
    'currentNav' => 'home_fr',
    'currentNavTitle' => 'Accueil'
  ));
});



// --- FR WEBSITE ----
$app->get('/home', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  $ipUser = $_SERVER['REMOTE_ADDR'];
  // $countryUser = geoip_country_code_by_name($ipUser);
  if (!isset($_COOKIE['CONNECTED_ONCE'])) {
    $cookie = false;
    setcookie(
      'CONNECTED_ONCE',
      $ipUser,
      [
          'expires' => time() + 365*24*3600,
          'secure' => true,
          'httponly' => true,
      ]
    );
  } else {
    $cookie = $_COOKIE['CONNECTED_ONCE'];
  }
  return $app['twig']->render('index.twig', array(
    'cookie' => $cookie,
    'currentNav' => 'home_fr',
    'currentNavTitle' => 'Accueil'
  ));
});

$app->get('/history', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('history.twig', array(
    'currentNav' => 'history_fr',
    'currentNavTitle' => 'Les Mariés'
  ));
});

$app->get('/presents', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('presents.twig', array(
    'currentNav' => 'present_fr',
    'currentNavTitle' => 'Liste de Cadeaux'
  ));
});

$app->get('/presence', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('presence.twig', array(
    'currentNav' => 'presence_fr',
    'currentNavTitle' => 'Confirmez votre Présence'
  ));
});

//REL HANDLERS
$app->get('/relatives', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('relatives.twig', array(
    'currentNav' => 'relatives_fr',
    'currentNavTitle' => 'Nos Proches'
  ));
});

$app->get('/rel/witnesses', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('witnesses.twig', array(
    'currentNav' => 'rel/witnesses_fr',
    'currentNavTitle' => 'Nos Témoins'
  ));
});

$app->get('/rel/parents', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('parents.twig', array(
    'currentNav' => 'rel/parents_fr',
    'currentNavTitle' => 'Nos Parents'
  ));
});

$app->get('/rel/children', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('children.twig', array(
    'currentNav' => 'rel/children_fr',
    'currentNavTitle' => 'Nos Enfants de Choeur'
  ));
});

//ORG HANDLERS
$app->get('/organisation', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('organisation.twig', array(
    'currentNav' => 'organisation_fr',
    'currentNavTitle' => 'Organisation'
  ));
});

$app->get('/org/info', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('info.twig', array(
    'currentNav' => 'org/info_fr',
    'currentNavTitle' => 'Informations Pratiques'
  ));
});

$app->get('/org/program', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('program.twig', array(
    'currentNav' => 'org/program_fr',
    'currentNavTitle' => 'Programme'
  ));
});

$app->get('/org/trips', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('trips.twig', array(
    'currentNav' => 'org/trips_fr',
    'currentNavTitle' => 'Propositions de Voyages'
  ));
});

// COMMENT HANDLERS
$app->get('/comment', function() use($app) {
  $likeCommentError = false;
  $commentsStatement = $app['pdo']->prepare('SELECT *, TO_CHAR(comments.date, \'DD Mon YYYY\') AS comment_date FROM comments ORDER BY date DESC LIMIT 50');
  $commentsStatement->execute();

  $comments = array();
  while ($row = $commentsStatement->fetch(PDO::FETCH_ASSOC)) {
    $app['monolog']->addDebug('Row ' . $row['id']);
    $comments[] = $row;
  }

  return $app['twig']->render('comments.twig', array(
    'comments' => $comments,
    'likeCommentError' => $likeCommentError,
    'currentNav' => 'comment_fr',
    'currentNavTitle' => 'Livre d\'Or'
  ));
});

//likeComment
$app->post('/likeComment', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  $commentId = strip_tags($_POST['id']);
  $commentLikes = strip_tags($_POST['like']);
  $likeCommentError = false;

  if (!isset($commentId) || !isset($commentLikes)) {
    $likeCommentError = 'There has been an error. Please retry later.';
  } else {
    $updateLikes = $app['pdo']->prepare('UPDATE comments SET likes = :likes WHERE id = :id');
    $updateLikes->execute([
      'likes' => ++$commentLikes,
      'id' => $commentId,
  ]);
  }
  // header('Location: /comment');
  // redirect to the anchor of the liked comment;
  $commentsStatement = $app['pdo']->prepare('SELECT *, TO_CHAR(comments.date, \'DD Mon YYYY\') AS comment_date FROM comments ORDER BY date DESC LIMIT 50');
  $commentsStatement->execute();

  $comments = array();
  while ($row = $commentsStatement->fetch(PDO::FETCH_ASSOC)) {
    $app['monolog']->addDebug('Row ' . $row['id']);
    $comments[] = $row;
  }

  return $app['twig']->render('comments.twig', array(
    'comments' => $comments,
    'likeCommentError' => $likeCommentError,
    'currentNav' => 'comment_fr',
    'currentNavTitle' => 'Livre d\'Or'
  ));
});

//addComment
$app->post('/addComment', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  $commentsAnalisisStatement = $app['pdo']->prepare('SELECT * FROM comments');
  $commentsAnalisisStatement->execute();
  $commentsAnalisis = $commentsAnalisisStatement->fetchAll();

  $commentContent = strip_tags($_POST['content']);
  $commentAuthor = strip_tags($_POST['author']);
  $commentError = true;
  if (!isset($_POST['content']) && !isset($_POST['author'])) {
    $commentPayload = 'Il faut un contenu et un auteur pour soumettre le formulaire.';
    $defaultContent='';
    $defaultAuthor='';
  } elseif (!isset($_POST['content']) && isset($_POST['author'])) {
    $commentPayload = 'Il faut un contenu et un auteur pour soumettre le formulaire.';
    $defaultContent='';
    $defaultAuthor=$commentAuthor;
  } elseif (isset($_POST['content']) && !isset($_POST['author'])) {
    $commentPayload = 'Il faut un contenu et un auteur pour soumettre le formulaire.';
    $defaultContent=$commentContent;
    $defaultAuthor='';
  } elseif (strlen($commentContent)>500 || strlen($commentAuthor)>128) {
    $commentPayload = 'L\'une de vos réponse contient trop de caractères : les maxima sont de 500 pour votre commentaire et 128 pour votre nom.';
    $defaultContent=$commentContent;
    $defaultAuthor=$commentAuthor;
  } else {
    $alreadyRegistered = false;
    foreach($commentsAnalisis as $comment) {
        if ($comment['content'] == $commentContent) {
          $alreadyRegistered = true;
        }
    }
    if ($alreadyRegistered) {
      $commentPayload = 'Erreur : ce message a déjà été enregistré.';
      $defaultContent=$commentContent;
      $defaultAuthor=$commentAuthor;
    } else {
      $commentError = false;
      $addComment = $app['pdo']->prepare('INSERT INTO comments(content, author, likes) VALUES (:content, :author, :likes)');
      $addComment->execute([
        'content' => $commentContent,
        'author' => $commentAuthor,
        'likes' => 0,
      ]);
    }
  }
  
  // header('Location: /comment');
  $commentsStatement = $app['pdo']->prepare('SELECT *, TO_CHAR(comments.date, \'DD Mon YYYY\') AS comment_date FROM comments ORDER BY date DESC LIMIT 50');
  $commentsStatement->execute();

  $comments = array();
  while ($row = $commentsStatement->fetch(PDO::FETCH_ASSOC)) {
    $app['monolog']->addDebug('Row ' . $row['id']);
    $comments[] = $row;
  }

  return $app['twig']->render('addComment.twig', array(
    'comments' => $comments,
    'commentError' => $commentError,
    'commentPayload' => $commentPayload,
    'defaultContent' => $defaultContent,
    'defaultAuthor' => $defaultAuthor,
    'currentNav' => 'comment_fr',
    'currentNavTitle' => 'Livre d\'Or'
  ));
});






// --- BRAZILIAN - BR - WEBSITE ----
$app->get('/br/home', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  $ipUser = $_SERVER['REMOTE_ADDR'];
  // $countryUser = geoip_country_code_by_name($ipUser);
  if (!isset($_COOKIE['CONNECTED_ONCE'])) {
    $cookie = false;
    setcookie(
      'CONNECTED_ONCE',
      $ipUser,
      [
          'expires' => time() + 365*24*3600,
          'secure' => true,
          'httponly' => true,
      ]
    );
  } else {
    $cookie = $_COOKIE['CONNECTED_ONCE'];
  }
  return $app['twig']->render('br/index.twig', array(
    'cookie' => $cookie,
    'currentNav' => 'home_br',
    'currentNavTitle' => 'Home'
  ));
});

$app->get('/br/history', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('br/history.twig', array(
    'currentNav' => 'history_br',
    'currentNavTitle' => 'Os Noivos'
  ));
});

$app->get('/br/presents', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('br/presents.twig', array(
    'currentNav' => 'present_br',
    'currentNavTitle' => 'Lista de presentes'
  ));
});

// PRESENCE
//navigation
$app->get('/br/presence', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('br/presence.twig', array(
    'currentNav' => 'presence_br',
    'currentNavTitle' => 'Confirme sua presença'
  ));
});



//REL HANDLERS
$app->get('/br/relatives', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('br/relatives.twig', array(
    'currentNav' => 'relatives_br',
    'currentNavTitle' => 'Nossos Proximos'
  ));
});

$app->get('/br/rel/witnesses', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('br/witnesses.twig', array(
    'currentNav' => 'rel/witnesses_br',
    'currentNavTitle' => 'Nossos Padrinhos'
  ));
});

$app->get('/br/rel/parents', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('br/parents.twig', array(
    'currentNav' => 'rel/parents_br',
    'currentNavTitle' => 'Nossos Pais'
  ));
});

$app->get('/br/rel/children', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('br/children.twig', array(
    'currentNav' => 'rel/children_br',
    'currentNavTitle' => 'Nossos Pajens'
  ));
});

//ORG HANDLERS
$app->get('/br/organisation', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('br/organisation.twig', array(
    'currentNav' => 'organisation_br',
    'currentNavTitle' => 'Programação'
  ));
});

$app->get('/br/org/info', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('br/info.twig', array(
    'currentNav' => 'org/info_br',
    'currentNavTitle' => 'Informações Gerais'
  ));
});

$app->get('/br/org/program', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('br/program.twig', array(
    'currentNav' => 'org/program_br',
    'currentNavTitle' => 'Cerimônia'
  ));
});

$app->get('/br/org/trips', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('br/trips.twig', array(
    'currentNav' => 'org/trips_br',
    'currentNavTitle' => 'Proposições de Roteiros'
  ));
});

// COMMENT HANDLERS
$app->get('/br/comment', function() use($app) {
  $likeCommentError = false;
  $commentsStatement = $app['pdo']->prepare('SELECT *, TO_CHAR(comments.date, \'DD Mon YYYY\') AS comment_date FROM comments ORDER BY date DESC LIMIT 50');
  $commentsStatement->execute();

  $comments = array();
  while ($row = $commentsStatement->fetch(PDO::FETCH_ASSOC)) {
    $app['monolog']->addDebug('Row ' . $row['id']);
    $comments[] = $row;
  }

  return $app['twig']->render('br/comments.twig', array(
    'comments' => $comments,
    'likeCommentError' => $likeCommentError,
    'currentNav' => 'comment_br',
    'currentNavTitle' => 'Mensagem aos noivos'
  ));
});

//likeComment
$app->post('/br/likeComment', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  $commentId = strip_tags($_POST['id']);
  $commentLikes = strip_tags($_POST['like']);
  $likeCommentError = false;

  if (!isset($commentId) || !isset($commentLikes)) {
    $likeCommentError = 'There has been an error. Please retry later.';
  } else {
    $updateLikes = $app['pdo']->prepare('UPDATE comments SET likes = :likes WHERE id = :id');
    $updateLikes->execute([
      'likes' => ++$commentLikes,
      'id' => $commentId,
  ]);
  }
  // header('Location: /comment');
  // redirect to the anchor of the liked comment;
  $commentsStatement = $app['pdo']->prepare('SELECT *, TO_CHAR(comments.date, \'DD Mon YYYY\') AS comment_date FROM comments ORDER BY date DESC LIMIT 50');
  $commentsStatement->execute();

  $comments = array();
  while ($row = $commentsStatement->fetch(PDO::FETCH_ASSOC)) {
    $app['monolog']->addDebug('Row ' . $row['id']);
    $comments[] = $row;
  }

  return $app['twig']->render('br/comments.twig', array(
    'comments' => $comments,
    'likeCommentError' => $likeCommentError,
    'currentNav' => 'comment_br',
    'currentNavTitle' => 'Mensagem aos noivos'
  ));
});

//addComment
$app->post('/br/addComment', function () use ($app) {
  $app['monolog']->addDebug('logging output.');
  $commentsAnalisisStatement = $app['pdo']->prepare('SELECT * FROM comments');
  $commentsAnalisisStatement->execute();
  $commentsAnalisis = $commentsAnalisisStatement->fetchAll();

  $commentContent = strip_tags($_POST['content']);
  $commentAuthor = strip_tags($_POST['author']);
  $commentError = true;
  if (!isset($_POST['content']) && !isset($_POST['author'])) {
    $commentPayload = 'Precisa ter um conteúdo e um autor para mandar o formulario.';
    $defaultContent='';
    $defaultAuthor='';
  } elseif (!isset($_POST['content']) && isset($_POST['author'])) {
    $commentPayload = 'Precisa ter um conteúdo e um autor para mandar o formulario.';
    $defaultContent='';
    $defaultAuthor=$commentAuthor;
  } elseif (isset($_POST['content']) && !isset($_POST['author'])) {
    $commentPayload = 'Precisa ter um conteúdo e um autor para mandar o formulario.';
    $defaultContent=$commentContent;
    $defaultAuthor='';
  } elseif (strlen($commentContent)>500 || strlen($commentAuthor)>128) {
    $commentPayload = 'Uma das suas entradas ta larga demais : o max è de 500 caracterios pro commentario e 128 pelo nome.';
    $defaultContent=$commentContent;
    $defaultAuthor=$commentAuthor;
  } else {
    $alreadyRegistered = false;
    foreach($commentsAnalisis as $comment) {
        if ($comment['content'] == $commentContent) {
          $alreadyRegistered = true;
        }
    }
    if ($alreadyRegistered) {
      $commentPayload = 'Error: esta mensagem ja foi registrada.';
      $defaultContent=$commentContent;
      $defaultAuthor=$commentAuthor;
    } else {
      $commentError = false;
      $addComment = $app['pdo']->prepare('INSERT INTO comments(content, author, likes) VALUES (:content, :author, :likes)');
      $addComment->execute([
        'content' => $commentContent,
        'author' => $commentAuthor,
        'likes' => 0,
      ]);
    }
  }
  
  // header('Location: /comment');
  $commentsStatement = $app['pdo']->prepare('SELECT *, TO_CHAR(comments.date, \'DD Mon YYYY\') AS comment_date FROM comments ORDER BY date DESC LIMIT 50');
  $commentsStatement->execute();

  $comments = array();
  while ($row = $commentsStatement->fetch(PDO::FETCH_ASSOC)) {
    $app['monolog']->addDebug('Row ' . $row['id']);
    $comments[] = $row;
  }

  return $app['twig']->render('br/addComment.twig', array(
    'comments' => $comments,
    'commentError' => $commentError,
    'commentPayload' => $commentPayload,
    'defaultContent' => $defaultContent,
    'defaultAuthor' => $defaultAuthor,
    'currentNav' => 'comment_br',
    'currentNavTitle' => 'Mensagem aos noivos'
  ));
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








// RUN THE WEBSITE
$app->run();
