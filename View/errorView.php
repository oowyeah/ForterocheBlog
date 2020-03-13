<?php
$title = "Erreur !";
ob_start();

?>

<div id="error">
Erreur : <?= $error ?>
</div>

<?php

$content = ob_get_clean();

require('template.php');