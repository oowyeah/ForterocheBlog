<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link rel="stylesheet" href="public/css/style.css" />
        <?php
        if(isset($headContent)) {
        	echo $headContent;
        } 
        ?>
    </head>
        
    <body>
        <header>
            <h1>Blog de Jean Forteroche - Ecrivain</h1>
            <nav>
                <ul>
                    <li>Acceuil</li>
                    <li>Chapitres</li>
                    <li>Contact</li>
                    <?php
                    if(isset($whoIsConnected))
                    {
                        if($whoIsConnected == 'admin') {
                            ?>
                            <li><a href="index.php?action=dashBoard">Tableau de bord</a></li>
                            <?php
                        } 
                    }
                    if(isset($whoIsConnected))
                    {
                        if(!$whoIsConnected) {
                            ?>
                            <li><a href="index.php?action=signInPage">Connexion</a></li>
                            <?php
                        }
                        else
                        {
                            ?>
                            <li><a href="index.php?action=signOut">Déconnexion</a></li>
                            <?php                        
                        }  
                    }
             

                    ?>
                </ul>
            </nav>
        <?php
        if(isset($message))
        {
            ?>
            <div id="message"><p><?= $message ?></p></div>
            <?php    
        } 
        ?>
        </header>

        <?= $content ?>
    </body>
</html>