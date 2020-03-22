<?php

$title = "Tableau de Bord";
ob_start();

?>
<main>
	<?php
	if($whoIsConnected == 'admin')
	{
		?>
		<h2>TABLEAU DE BORD</h2>
        <nav id="dashBoard">
            <ul>
                <a href="index.php?action=newChapter"><li>Ajouter un chapitre</li></a>
                <a href="index.php?action=editRemChapters"><li>Modifier ou Supprimer un chapitre</li></a>
                <a href="index.php?action=reportedComments"><li>Modérer les commentaires</li></a>
            </ul>
        </nav>

		<?php
	}
	else
	{
		?>

		<p class="noComments">Vous n'avez pas les droits nécessaires pour accéder à cette page !</p>

		<?php
	}
	?>
</main>

<footer>
</footer>

<?php

$content = ob_get_clean();

require('template.php');
?>