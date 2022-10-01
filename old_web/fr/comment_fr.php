<?php
include_once('../config/comments.php');
?>


<!DOCTYPE html>
<html>
    <body>
        <!-- For those whose javascript is not enabled -->
        <noscript>
            <hr>
            <p><img src="../rsc/icons/warning.png" alt="Warning icon" /></p>
            <p>Please note this website is using JavaScript! You see this message if your browser does not support it. In this case, please check how to enable it in your browser settings.</p>
            <p>In any case, you will find the plan of the website on our <a href="../index.html">home page</a>. This will allow you to navigate throughout the full list of pages of our website.</p>
            <hr>
        </noscript>
        
        <!-- Header of the website -->
        <header-component></header-component>
        
        <div id="commentBody">
            <div id="commentForm">    
                <h1>Laissez-nous un mot</h1>
                <form method="post" action="post_comment_fr.php">
                    <label>Commentaire :</label><br/>
                    <textarea name="content" id="comment" placeholder="Votre message pour les mariés" rows="4" cols="60" required></textarea>
                    <input type="text" name="author" placeholder="Votre nom" required />
                    <input type="submit" value="Envoyer" />
                </form>
                <p><em>Une fois envoyé, votre commentaire sera ajouté à la liste que vous pouvez trouver ci-dessous</em>></p>
            </div>
            <div>
                <h1>Ce dont vous nous avez fait part</h1>
                <?php
                foreach($comments as $comment) {
                ?>
                    <p><?php echo $comment['content']; ?></p>
                    <p><?php echo $comment['author']; ?></p>
                    <p><?php echo $comment['comment_date']; ?></p>
                    <p><?php echo $comment['likes']; ?></p>
                <?php
                }
                ?>
            </div>
        </div>


        <!-- Footer of the website -->
        <footer-component></footer-component>
    </body>
</html>
