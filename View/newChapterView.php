<?php

$title = "Ajouter un chapitre";

ob_start();
?>
<script src="tinymce/tinymce.min.js" referrerpolicy="origin"></script>
<script>
	tinymce.init({
    	selector: '#mytextarea',
    	language: 'fr_FR',
    	content_style: 'body { font-family: Martel, sans-serif; }'
    });
</script>

<?php

$headContent = ob_get_clean();


ob_start();

?>
<main>
	<?php
	if($whoIsConnected == 'admin')
	{
		?>
		<h2>Rédigez votre histoire</h2>

		<form id="chapterForm" method="post" action="index.php?action=addChapter">
			<p>
				<label for="title">Titre de l'épisode : </label>
				<input required type="text" name="title" id="title" />
			</p>
			<textarea id="mytextarea" name="content"></textarea>

			<input type="submit" value="Envoyer" />
		</form>

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