<!-- FILEPATH: /home/etuinfo/piemallet/Documents/S2/S2.03/sae-203-reseau/index.html -->

<!DOCTYPE html>
<html>
<head>
    <title>User Agent Example</title>
</head>
<body>
    <h1>
        <?php
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            echo "User Agent: " . $userAgent;
        ?>
    </h1>
    <h1>
        <?php
        //Obtenez la date et l'heure actuelles
        $date = date('Y-m-d H:i:s');
        // Affichez la date et l'heure
            echo "\nHeure actuelle : " . $date;
        ?>
    </h1>
    <h1>
        <?php
        //Obtenez l'adresse IP de l'utilisateur
        $ip = $_SERVER['REMOTE_ADDR'];
        // Affichez l'adresse IP
            echo "\nAdresse IP : " . $ip;
        ?>
    </h1>
    <h1>
        <?php
        //Obtenez le nom de l'hôte de l'utilisateur
        $host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        // Affichez le nom de l'hôte
            echo "\nNom de l'hôte : " . $host;
        ?>
    </h1>
</body>
</html>
