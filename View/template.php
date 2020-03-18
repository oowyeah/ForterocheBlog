<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="https://fonts.googleapis.com/css?family=Karla:700|Martel&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/css/style.css" />
        <?php
        if(isset($headContent)) {
        	echo $headContent;
        } 
        ?>
    </head>
        
    <body>
        <header>
            <h1>FORTEROCHE BLOG</h1>
            <nav>
                <ul>
                    <li><a href="index.php">ACCEUIL</a></li>
                    <li><a href="index.php?action=chaptersList">CHAPITRES</a></li>
                    <li>CONTACT</li>
                    <?php
                    if(isset($whoIsConnected))
                    {
                        if($whoIsConnected == 'admin') {
                            ?>
                            <li><a href="index.php?action=dashBoard">TABLEAU DE BORD</a></li>
                            <?php
                        } 
                    }
                    if(isset($whoIsConnected))
                    {
                        if(!$whoIsConnected) {
                            ?>
                            <li><a href="index.php?action=signInPage">CONNEXION</a></li>
                            <?php
                        }
                        else
                        {
                            ?>
                            <li><a href="index.php?action=signOut">DECONNEXION</a></li>
                            <?php                        
                        }  
                    }
             

                    ?>
                </ul>
            </nav>
        
        </header>

        <?php

        if(isset($message))
        {
            ?>
            <div id="message"><p><?= $message ?></p></div>
            <?php    
        } 
        ?>

        <?= $content ?>
    </body>
</html>