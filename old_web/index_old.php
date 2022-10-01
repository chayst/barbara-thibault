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
    <body>
        
        <?php
        if(!isset($_COOKIE['CONNECTED_ONCE']))
        {
            echo 'welcome';
        }
        else {
            echo $_COOKIE['CONNECTED_ONCE'];
        }
        ?>
    </body>
</html>
