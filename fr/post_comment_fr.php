<?php
include_once('../config/comments.php');

if (isset($_POST['content'])) {
    $content = strip_tags($_POST['content']);
}
if (isset($_POST['author'])) {
    $author = strip_tags($_POST['author']);
}
                    

?>

<!DOCTYPE html>
<html>
    <head>
        <!-- En-tête de la page -->
        <meta charset="utf-8" name="comment_fr" />
        <link rel="stylesheet" href="../css/style.css" />
        <title>Barbara et Thibault | Livre d'Or</title>
        <script src="../rsc/htmlComponents/header.js" type="text/javascript" defer></script>
        <script src="../rsc/htmlComponents/footer.js" type="text/javascript" defer></script>
        <script src="../js/index.js" type="text/javascript" defer></script>
    </head>

    <body>
        <!-- For those whose javascript is not enabled -->
        <noscript>
            <hr>
            <p><img src="../rsc/icons/warning.png" alt="Warning icon" /></p>
            <p>Please note this website is using JavaScript! You see this message if your browser does not support it. In this case, please check how to enable it in your browser settings.</p>
            <p>In any case, you will find the plan of the website on our <a href="../index.html">home page</a>. This will allow you to navigate throughout the full list of pages of our website.</p>
            <hr>
        </noscript>
        
        
        <div id="commentBody">
            <div id="commentForm">    
                <h1>Laissez-nous un mot</h1>
                <?php
                if (!isset($_POST['content']) && !isset($_POST['author']))
                {
                ?>
                    <p style="color:red;">Il faut un contenu et un auteur pour soumettre le formulaire.</p>
                    <form method="post" action="post_comment_fr.php">
                        <label>Commentaire :</label><br/>
                        <textarea name="content" id="comment" placeholder="Votre message pour les mariés" rows="4" cols="60" required></textarea>
                        <input type="text" name="author" placeholder="Votre nom" required/>
                        <input type="submit" value="Envoyer" />
                    </form>
                    <p><em>Une fois envoyé, votre commentaire sera ajouté à la liste que vous pouvez trouver ci-dessous</em>></p>
                <?php                } elseif (!isset($_POST['content']) && isset($_POST['author']))
                {
                ?>
                    <p style="color:red;">Il faut un contenu et un auteur pour soumettre le formulaire.</p>
                    <form method="post" action="post_comment_fr.php">
                        <label>Commentaire :</label><br/>
                        <textarea name="content" id="comment" placeholder="Votre message pour les mariés" rows="4" cols="60" required></textarea>
                        <input type="text" name="author" placeholder="Votre nom" value="<?php echo $author; ?>" required/>
                        <input type="submit" value="Envoyer" />
                    </form>
                    <p><em>Une fois envoyé, votre commentaire sera ajouté à la liste que vous pouvez trouver ci-dessous</em>></p>
                <?php
                } elseif (isset($_POST['content']) && !isset($_POST['author']))
                {
                ?>
                    <p style="color:red;">Il faut un contenu et un auteur pour soumettre le formulaire.</p>
                    <form method="post" action="post_comment_fr.php">
                        <label>Commentaire :</label><br/>
                        <textarea name="content" id="comment" placeholder="Votre message pour les mariés" rows="4" cols="60" required><?php echo $author; ?></textarea>
                        <input type="text" name="author" placeholder="Votre nom" required/>
                        <input type="submit" value="Envoyer" />
                    </form>
                    <p><em>Une fois envoyé, votre commentaire sera ajouté à la liste que vous pouvez trouver ci-dessous</em>></p>
                <?php
                } elseif (strlen($content)>500 || strlen($author)>128)
                {
                ?>
                    <p style="color:red;">L'une de vos réponse contient trop de caractères : les maxima sont de 500 pour votre commentaire et 128 pour votre nom.</p>
                    <form method="post" action="post_comment_fr.php">
                        <label>Commentaire :</label><br/>
                        <textarea name="content" id="comment" placeholder="Votre message pour les mariés" rows="4" cols="60" required><?php echo $content; ?></textarea>
                        <input type="text" name="author" placeholder="Votre nom" value="<?php echo $author; ?>" required/>
                        <input type="submit" value="Envoyer" />
                    </form>
                    <p><em>Une fois envoyé, votre commentaire sera ajouté à la liste que vous pouvez trouver ci-dessous</em>></p>
                <?php
                } else {
                    $alreadyRegistered = false;
                    foreach($comments as $comment) {
                        if ($comment['content'] == $content)
                        {
                        $alreadyRegistered = true;
                        }
                    }
                    if ($alreadyRegistered)
                    {
                    ?>
                        <p style="color:red;">Erreur: ce message a déjà été enregistré.</p>
                        <form method="post" action="post_comment_fr.php">
                            <label>Commentaire :</label><br/>
                            <textarea name="content" id="comment" placeholder="Votre message pour les mariés" rows="4" cols="60" required><?php echo $content; ?></textarea>
                            <input type="text" name="author" placeholder="Votre nom" value="<?php echo $author; ?>" required/>
                            <input type="submit" value="Envoyer" />
                        </form>
                        <p><em>Une fois envoyé, votre commentaire sera ajouté à la liste que vous pouvez trouver ci-dessous</em>></p>
                    <?php
                    }
                    else
                    {
                    
                        $insertComment = $db->prepare('INSERT INTO comments(content, author, likes) VALUES (:content, :author, :likes)');
                        $insertComment->execute([
                            'content' => $content,
                            'author' => $author,
                            'likes' => 0,
                        ]);
                    ?>
                        <p style="color:green;">Merci de votre participation. <a href="comment_fr.php"> Rafraîchir la page.</a></p>
                        <?php
                    }
                }
                ?>
            </div>
            <div>
                <h1>Ce dont vous nous avez fait part</h1>
                <?php
                foreach($comments as $comment) {
                ?>
                    <p><?php echo $comment['content']; ?></p>
                    <p><?php echo $comment['author']; ?></p>
                    <p><?php echo $comment['date']; ?></p>
                    <p><?php echo $comment['likes']; ?></p>
                <?php
                }
                ?>
            </div>
        </div>

    </body>
</html>