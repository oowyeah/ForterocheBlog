<?php

$title = "Acceuil - J-F Blog";
ob_start();

?>
<main>
	<div id="hero">
		<h2>BILLET SIMPLE POUR L'ALASKA</h2>
		<div class="button"><a href="index.php?action=chaptersList">Commencer la lecture</a></div>
	</div>
	<div id="welcome">
		<p>Bienvenue sur mon blog dédié à mon nouveau roman <span>Billet simple pour l'Alaska</span>.</p>
		<p>Les chapitres seront publiés les uns aprés les autres en fonction de mon inspiration.</p>
		<p>Vous pouvez participer au développement de mon roman en commentant mes publications, pour celà je vous invite à creer un compte.</p>
		<p>Je vous souhaite une bonne lecture !</p>
	</div>
</main>

<footer>
</footer>

<?php

$content = ob_get_clean();

require('template.php');
?>