<?php

$title = "Acceuil - J-F Blog";
ob_start();

?>
<main>
</main>

<footer>
</footer>

<?php

$content = ob_get_clean();

require('template.php');
?>