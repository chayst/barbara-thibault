<?php

$ipUser = $_SERVER['REMOTE_ADDR'];
// $countryUser = geoip_country_code_by_name($ipUser);

setcookie(
    'CONNECTED_ONCE',
    $ipUser,
    [
        'expires' => time() + 365*24*3600,
        'secure' => true,
        'httponly' => true,
    ]
);
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- En-tête de la page -->
        <meta charset="utf-8" name="index"/>
        <link rel="stylesheet" href="css/style.css" />
        <title>Barbara et Thibault | Home</title>
        <script src="rsc/htmlComponents/header.js" type="text/javascript" defer></script>
        <script src="rsc/htmlComponents/footer.js" type="text/javascript" defer></script>
        <script src="js/index.js" type="text/javascript" defer></script>
    </head>

    <body>
        <!-- For those whose javascript is not enabled -->
        <noscript>
            <hr>
            <p><img src="rsc/icons/warning.png" alt="Warning icon" /></p>
            <p>Please note this website is using JavaScript! You see this message if your browser does not support it. In this case, please check how to enable it in your browser settings.</p>
            <p>
                You can find here after the plan of our website for you to navigate throughout its full list of pages:
                <div id="noscriptNav">
                    <ul>
                        <li class="ulTitle">Navigation to access French pages:</li>
                        <li><a href="index.html">Accueil</a></li>
                        <li><a href="fr/history_fr.html">Notre Histoire</a></li>
                        <li><a href="fr/witnesses_fr.html"></a>Nos Témoins</li>
                        <li><a href="fr/organisation_fr.html">Organisation</a>
                            <ul>
                                <li><a href="fr/org/info_fr.html">Informations Pratiques</a></li>
                                <li><a href="fr/org/program_fr.html">Programme</a></li>
                                <li><a href="fr/org/trips_fr.html">Voyages</a></li>
                            </ul>
                        </li>
                        <li><a href="fr/presents_fr.html">Liste de Cadeaux</a></li>
                        <li><a href="fr/presence_fr.html">Confirmez votre Présence</a></li>
                    </ul>
                    <ul>
                        <li class="ulTitle">Navigation to access Portuguese pages:</li>
                        <li><a href="index.html">Entrada</a></li>
                        <li><a href="fr/history_fr.html">Nossa Historia</a></li>
                        <li><a href="fr/witnesses_fr.html">Nossas Testemunhas</a></li>
                        <li><a href="fr/organisation_fr.html">Organização</a>
                            <ul>
                                <li><a href="fr/org/info_fr.html">Informações práticas</a></li>
                                <li><a href="fr/org/program_fr.html">Programma</a></li>
                                <li><a href="fr/org/trips_fr.html">Viagems</a></li>
                            </ul>
                        </li>
                        <li><a href="fr/presents_fr.html">Lista de Presentes</a></li>
                        <li><a href="fr/presence_fr.html">Confirme sua Presencia</a></li>
                    </ul>
                </div>
            </p>
            <p>
                You can find as well here after the difference ways to contact us:
                <ul id="noscriptContact">
                    <li>Monsieur et Madame André Chays // Les Alizés - Bat. A // 51, traverse Pourrière // 13008 - Marseille, France</li>
                    <li>Francisco José Nunes Ferreira e Ana Niedja Mendes Nunes // Ed Espaço Veredas II // Avenida das Araucarias, Rua 12 Sul, Lote 10, AP 704 // CEP 71.939-000 - Aguas Claras, Brasilia DF, Brasil</li>
                    <li><a href="mailto:contact@barbara-thibault.fr">Contact us via email</a></li>
                </ul>
            </p>
            <hr>
        </noscript>
        
        <!-- Header of the website -->
        <header-component></header-component>
        
        <?php
        if(!isset($_COOKIE['CONNECTED_ONCE']))
        {
            echo 'welcome';
        }
        else {
            echo $_COOKIE['CONNECTED_ONCE'];
        }
        ?>

        <h1><span id="daysLeft">daysLeft</span> jours restants</h1>

        <div id="homeBody">
            <img src="rsc/images/home/home.jpg" alt="Welcome picture on Thibault and Barbara wedding's site"/>
        </div>


        <!-- Footer of the website -->
        <footer-component></footer-component>
    </body>
</html>
